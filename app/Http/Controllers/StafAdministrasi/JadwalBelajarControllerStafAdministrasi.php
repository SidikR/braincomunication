<?php

namespace App\Http\Controllers\StafAdministrasi;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\JadwalBelajar;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class JadwalBelajarControllerStafAdministrasi extends Controller
{
    private function validateData(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'teacher_ids' => 'nullable',
            // 'teacher_ids.*' => 'exists:users,id',
            'student_ids' => 'nullable',
            // 'student_ids.*' => 'exists:users,id',
            'start_time' => 'required|date',
            'status' => 'nullable',
            'end_time' => 'required|date|after:start_time',
        ], [
            'title.required' => 'Judul harus diisi.',
            'title.max' => 'Judul tidak boleh lebih dari 255 karakter.',
            'mata_pelajaran_id.required' => 'Mata Pelajaran tidak boleh kosong',
            // 'teacher_ids.required' => 'Pengajar harus dipilih.',
            // 'teacher_ids.*.exists' => 'Pengajar yang dipilih tidak valid.',
            // 'student_ids.required' => 'Murid harus dipilih.',
            // 'student_ids.*.exists' => 'Murid yang dipilih tidak valid.',
            'start_time.required' => 'Waktu mulai harus diisi.',
            'start_time.date' => 'Waktu mulai tidak valid.',
            'end_time.required' => 'Waktu selesai harus diisi.',
            'end_time.date' => 'Waktu selesai tidak valid.',
            'end_time.after' => 'Waktu selesai harus setelah waktu mulai.',
        ]);
    }

    public function index()
    {
        $jadwal_belajar = JadwalBelajar::all();
        $data = [
            'header_name' => "Daftar Jam Belajar",
            'page_name' => "Jam Belajar"
        ];
        return view('staf-administrasi-page.pages.jadwal_belajar.index', compact('jadwal_belajar', 'data'));
    }

    public function create()
    {
        $data = [
            'header_name' => "Tambah Jam Belajar",
            'page_name' => "Jam Belajar"
        ];
        $teachers = User::teachers()->get();
        $students = User::students()->get();
        $mata_pelajarans = MataPelajaran::all();
        return view('staf-administrasi-page.pages.jadwal_belajar.create', compact('teachers', 'students', 'data', 'mata_pelajarans'));
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

            // Sinkronisasi guru (teacher_ids)
            if (!empty($validatedData['teacher_ids'])) {
                $jadwalBelajar->users()->syncWithoutDetaching($validatedData['teacher_ids']);
            }

            // Sinkronisasi siswa (student_ids)
            if (!empty($validatedData['student_ids'])) {
                $jadwalBelajar->users()->syncWithoutDetaching($validatedData['student_ids']);
            }


            Session::flash('success', 'Data jadwal belajar berhasil ditambahkan');
            return redirect()->route('dashboard.staf_administrasi.jadwal_belajar.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        }
    }

    public function show($id)
    {
        try {
            $jadwal_belajar = JadwalBelajar::findOrFail($id);
            $teachers = $jadwal_belajar->users()->where('role', 'staf_pengajar')->get();
            $students = $jadwal_belajar->users()->where('role','siswa')->get();
            $data = [
                'header_name' => "Data Jadwal Belajar",
                'page_name' => "Detail Jadwal Belajar " . $jadwal_belajar->title
            ];
            return view('staf-administrasi-page.pages.jadwal_belajar.read', compact('jadwal_belajar', 'data', 'teachers', 'students'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data jadwal pembelajaran. ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $jadwal_belajar = JadwalBelajar::findOrFail($id);
            $teachers = User::teachers()->get();
            $students = User::students()->get();
            $selectedTeachers = $jadwal_belajar->users()->where('role', 'staf_pengajar')->get();
            $selectedStudents = $jadwal_belajar->users()->where('role', 'siswa')->get();
            $mata_pelajarans = MataPelajaran::all();

            $data = [
                'header_name' => "Jadwal Belajar",
                'page_name' => "Edit Data Jadwal Belajar " . $jadwal_belajar->title
            ];
            return view('staf-administrasi-page.pages.jadwal_belajar.edit', compact('jadwal_belajar', 'data', 'teachers', 'students', 'selectedTeachers', 'mata_pelajarans', 'selectedStudents'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data jadwal pembelajaran. ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $jadwal_belajar = JadwalBelajar::findOrFail($id);
            $validatedData = $this->validateData($request);

            $jadwal_belajar->update([
                'title' => $validatedData['title'],
                'keterangan' => $validatedData['keterangan'],
                'start_time' => $validatedData['start_time'],
                'end_time' => $validatedData['end_time'],
                'status' => $validatedData['status'],
            ]);

            // Sinkronisasi guru (teacher_ids)
            if (!empty($validatedData['teacher_ids'])) {
                $jadwal_belajar->users()->syncWithoutDetaching($validatedData['teacher_ids']);
            }

            // Sinkronisasi siswa (student_ids)
            if (!empty($validatedData['student_ids'])) {
                $jadwal_belajar->users()->syncWithoutDetaching($validatedData['student_ids']);
            }

            return redirect()->route('dashboard.staf_administrasi.jadwal_belajar.show', ['jadwal_belajar' => $jadwal_belajar->id])
                ->with('success', 'Data Jadwal Belajar (' . $jadwal_belajar->title . ') berhasil diubah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        }
    }

    public function destroy($id)
    {
        try {
            $jadwal_belajar = JadwalBelajar::findOrFail($id);
            $jadwal_belajar->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Jadwal Belajar berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data jadwal pembelajaran: ' . $e->getMessage()
            ]);
        }
    }
}
