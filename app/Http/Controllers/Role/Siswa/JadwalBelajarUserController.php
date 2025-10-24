<?php

namespace App\Http\Controllers\Role\Siswa;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\JadwalBelajar;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class JadwalBelajarUserController extends Controller
{
    private function validateData(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ], [
            'title.required' => 'Judul harus diisi.',
            'title.max' => 'Judul tidak boleh lebih dari 255 karakter.',
            'mata_pelajaran_id.required' => 'Mata Pelajaran tidak boleh kosong',
            'start_time.required' => 'Waktu mulai harus diisi.',
            'start_time.date' => 'Waktu mulai tidak valid.',
            'end_time.required' => 'Waktu selesai harus diisi.',
            'end_time.date' => 'Waktu selesai tidak valid.',
            'end_time.after' => 'Waktu selesai harus setelah waktu mulai.',
        ]);
    }

    // public function index()
    // {
    //     $jadwal_belajar = JadwalBelajar::all();
    //     $data = [
    //         'header_name' => "Daftar Jam Belajar",
    //         'page_name' => "Jam Belajar"
    //     ];
    //     return view('role.siswa.jadwal_belajar.index', compact('jadwal_belajar', 'data'));
    // }

    public function create()
    {
        $data = [
            'header_name' => "Ajukan Jam Belajar",
            'page_name' => "Jam Belajar"
        ];
        $mata_pelajarans = MataPelajaran::all();
        return view('role.siswa.jadwal_belajar.create', compact('data', 'mata_pelajarans'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateData($request);

            $jadwalBelajar = JadwalBelajar::create([
                'title' => $validatedData['title'],
                'keterangan' => $validatedData['keterangan'],
                'mata_pelajaran_id' => $validatedData['mata_pelajaran_id'],
                'start_time' => $validatedData['start_time'],
                'end_time' => $validatedData['end_time'],
                'status' => 'pending',
            ]);

            $jadwalBelajar->users()->sync(Auth::user()->id);

            Session::flash('success', 'Data jadwal belajar berhasil ditambahkan');
            return redirect()->back();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        }
    }
}
