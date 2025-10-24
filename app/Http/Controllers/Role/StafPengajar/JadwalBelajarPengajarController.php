<?php

namespace App\Http\Controllers\Role\StafPengajar;

use App\Models\User;
use Barryvdh\DomPDF\PDF;
use App\Models\NilaiSiswa;
use Illuminate\Http\Request;
use App\Models\JadwalBelajar;
use App\Models\MataPelajaran;
use App\Models\PresensiSiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class JadwalBelajarPengajarController extends Controller
{
    public function index()
    {
        $jadwal_belajar = JadwalBelajar::whereHas('users', function ($query) {
            $query->where('users.id', auth()->id());
        })->get();

        $data = [
            'header_name' => "Daftar Jam Belajar",
            'page_name' => "Jam Belajar"
        ];
        return view('role.staf_pengajar.jadwal_belajar.index', compact('jadwal_belajar', 'data'));
    }

    public function laporan($jadwalBelajarId)
    {
        $data = [
            'header_name' => "Tambah Laporan",
            'page_name' => "Daftar Laporan"
        ];

        $jadwalBelajar = JadwalBelajar::findOrFail($jadwalBelajarId);
        $teachers = $jadwalBelajar->users()->where('role', 'staf_pengajar')->get();
        $students = $jadwalBelajar->users()->where('role', 'siswa')->get();
        $rekapNilai = NilaiSiswa::where('jadwal_belajar_id', $jadwalBelajarId)
            ->with('user')
            ->get();
        $rekapKehadirans = PresensiSiswa::where('jadwal_belajar_id', $jadwalBelajarId)
        ->with('user')
        ->get();

        return view('role.staf_pengajar.jadwal_belajar.laporan', compact('students','teachers', 'data', 'jadwalBelajar', 'rekapNilai', 'rekapKehadirans', 'jadwalBelajarId'));
    }

    public function penilaian($jadwalBelajarId)
    {
        $data = [
            'header_name' => "Tambah Penilaian",
            'page_name' => "Daftar Penilaian"
        ];

        $jadwalBelajar = JadwalBelajar::findOrFail($jadwalBelajarId);
        $students = $jadwalBelajar->users()->where('role', 'siswa')->get();

        $rekapNilai = NilaiSiswa::where('jadwal_belajar_id', $jadwalBelajarId)
            ->with('user')
            ->get();

        return view('role.staf_pengajar.jadwal_belajar.penilaian', compact('students', 'data', 'jadwalBelajarId', 'rekapNilai'));
    }

    public function kehadiran($jadwalBelajarId)
    {
        $data = [
            'header_name' => "Tambah Kehadiran",
            'page_name' => "Daftar Kehadiran"
        ];

        $jadwalBelajar = JadwalBelajar::findOrFail($jadwalBelajarId);
        $students = $jadwalBelajar->users()->where('role', 'siswa')->get();

        $rekapKehadirans = PresensiSiswa::where('jadwal_belajar_id', $jadwalBelajarId)
            ->with('user')
            ->get();

        // dd($rekapNilai);
        return view('role.staf_pengajar.jadwal_belajar.kehadiran', compact('students', 'data', 'jadwalBelajarId', 'rekapKehadirans'));
    }

    public function store(Request $request, $jadwalBelajarId)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        $nilaiSiswa = NilaiSiswa::updateOrCreate(
            [
                'jadwal_belajar_id' => $jadwalBelajarId,
                'user_id' => $validatedData['user_id']
            ],
            [
                'nilai' => $validatedData['nilai']
            ]
        );

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Nilai berhasil ditambahkan',
                'nilai' => $nilaiSiswa->nilai
            ]);
        }

        return redirect()->route('jadwal.show', $jadwalBelajarId)->with('success', 'Nilai berhasil ditambahkan');
    }

    public function generateLaporanPDF($jadwalBelajarId, PDF $pdf)
    {
        $jadwalBelajar = JadwalBelajar::findOrFail($jadwalBelajarId);
        $nilaiSiswa = NilaiSiswa::where('jadwal_belajar_id', $jadwalBelajarId)->get();
        $presensiSiswa = PresensiSiswa::where('jadwal_belajar_id', $jadwalBelajarId)->get();
        $teachers = $jadwalBelajar->users()->where('role', 'staf_pengajar')->get();
        $students = $jadwalBelajar->users()->where('role', 'siswa')->get();

        // return view('role.staf_pengajar.jadwal_belajar.laporan', compact('jadwalBelajar', 'nilaiSiswa', 'presensiSiswa'));
        $pdf = $pdf->loadView('role.staf_pengajar.jadwal_belajar.pdf', compact('jadwalBelajar', 'nilaiSiswa', 'presensiSiswa', 'teachers', 'students'));
        return $pdf->download('laporan_pengajar_' . $jadwalBelajarId . '.pdf');
    }

    public function storeKehadiran(Request $request, $jadwalBelajarId)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'kehadiran' => 'required|in:sakit,izin,alpa,hadir', // Adjusted to match the enum values
        ]);

        // Update or create the attendance record
        $presensiSiswa = PresensiSiswa::updateOrCreate(
            [
                'jadwal_belajar_id' => $jadwalBelajarId,
                'user_id' => $validatedData['user_id']
            ],
            [
                'kehadiran' => $validatedData['kehadiran']
            ]
        );

        // Return the appropriate response based on the request type
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Kehadiran berhasil ditambahkan',
                'kehadiran' => $presensiSiswa->kehadiran
            ]);
        }

        return redirect()->route('jadwal.show', $jadwalBelajarId)->with('success', 'Kehadiran berhasil ditambahkan');
    }

    public function show($id)
    {
        try {
            $jadwal_belajar = JadwalBelajar::findOrFail($id);
            $teachers = $jadwal_belajar->users()->where('role', 'staf_pengajar')->get();
            $students = $jadwal_belajar->users()->where('role', 'siswa')->get();
            $data = [
                'header_name' => "Data Jadwal Belajar",
                'page_name' => "Detail Jadwal Belajar " . $jadwal_belajar->title
            ];
            return view('staf-administrasi-page.pages.jadwal_belajar.read', compact('jadwal_belajar', 'data', 'teachers', 'students'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data jadwal pembelajaran. ' . $e->getMessage());
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
            ]);

            $jadwal_belajar->users()->sync(array_merge($validatedData['teacher_ids'], $validatedData['student_ids']));

            return redirect()->route('dashboard.staf_administrasi.jadwal_belajar.show', ['jadwal_belajar' => $jadwal_belajar->id])
                ->with('success', 'Data Jadwal Belajar (' . $jadwal_belajar->title . ') berhasil diubah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        }
    }

    public function updateKeterangan(Request $request, $jadwalBelajarId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'keterangan' => 'required|string', // Ensure this is a string
        ]);

        // Find the `JadwalBelajar` instance
        $jadwalBelajar = JadwalBelajar::findOrFail($jadwalBelajarId);

        // Update the `keterangan` field
        $jadwalBelajar->update([
            'keterangan' => $validatedData['keterangan']
        ]);

        // Return the appropriate response based on request type
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Keterangan berhasil diperbarui',
                'keterangan' => $validatedData['keterangan']
            ]);
        }

        return redirect()->route('dashboard.staf_administrasi.jadwal_belajar.show', $jadwalBelajarId)
            ->with('success', 'Keterangan berhasil diperbarui');
    }

}
