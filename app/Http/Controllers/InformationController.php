<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Models\InformationFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class InformationController extends Controller
{
    public function index()
    {
        $data = [
            'header_name' => "Informasi",
            'page_name' => "Informasi"
        ];
        $informations = Information::with(['sender', 'recipients', 'files'])
            ->latest()->get();
        return view('staf-administrasi-page.pages.informations.index', compact('informations', 'data'));
    }

    public function create()
    {
        $teachers = User::where('role', 'staf_pengajar')->get();
        $students = User::where('role', 'siswa')->get();
        return view('staf-administrasi-page.pages.informations.create', compact('teachers', 'students'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('=== Mulai Simpan Informasi ===', ['user_id' => auth()->id()]);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'recipients' => 'nullable|array',
                'files.*' => 'file|max:10240', // 10MB per file
            ]);

            DB::beginTransaction();

            Log::info('Validasi sukses', $validated);

            // Buat data utama informasi
            $information = Information::create([
                'sender_id' => auth()->id(),
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
            ]);

            Log::info('Informasi dibuat', ['information_id' => $information->id]);

            /** ------------------------------------------
             * 📬 Tentukan daftar penerima
             * ------------------------------------------ */
            $recipientIds = collect();

            if (!empty($validated['recipients'])) {
                $recipients = $validated['recipients'];
                Log::info('Daftar penerima awal', ['recipients' => $recipients]);

                // Jika ada "all_teachers"
                if (in_array('all_teachers', $recipients)) {
                    $teachers = User::where('role', 'staf_pengajar')->pluck('id');
                    $recipientIds = $recipientIds->merge($teachers);
                    Log::info('Menambahkan semua guru', ['count' => $teachers->count()]);
                }

                // Jika ada "all_students"
                if (in_array('all_students', $recipients)) {
                    $students = User::where('role', 'siswa')->pluck('id');
                    $recipientIds = $recipientIds->merge($students);
                    Log::info('Menambahkan semua siswa', ['count' => $students->count()]);
                }

                // Tambahkan penerima spesifik
                $specificIds = array_filter($recipients, fn($r) => !in_array($r, ['all_teachers', 'all_students']));
                $recipientIds = $recipientIds->merge($specificIds);
            } else {
                // Jika kosong => kirim ke semua guru & siswa
                $recipientIds = User::whereIn('role', ['staf_pengajar', 'siswa'])->pluck('id');
                Log::info('Kirim ke semua guru & siswa', ['total' => $recipientIds->count()]);
            }

            $recipientIds = $recipientIds->unique();
            Log::info('Final daftar penerima', ['recipient_ids' => $recipientIds->values()->toArray()]);

            // Simpan penerima
            $information->recipients()->attach($recipientIds);
            Log::info('Penerima berhasil disimpan ke pivot');

            /** ------------------------------------------
             * 📎 Upload lampiran
             * ------------------------------------------ */
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('informations', 'public');

                    InformationFile::create([
                        'information_id' => $information->id,
                        'file_path' => $path,
                        'file_name' => $file->getClientOriginalName(),
                    ]);

                    Log::info('File diupload', ['file_name' => $file->getClientOriginalName(), 'path' => $path]);
                }
            }

            DB::commit();

            Log::info('=== Informasi berhasil disimpan ===', ['information_id' => $information->id]);

            return redirect()
                ->route('dashboard.staf_administrasi.information.index')
                ->with('success', 'Informasi berhasil dikirim!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan informasi', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan informasi: ' . $e->getMessage());
        }
    }
}
