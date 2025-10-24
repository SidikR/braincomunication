<?php

namespace App\Http\Controllers\Role\StafPengajar;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PresensiSiswa;
use App\Models\NilaiSiswa;
use App\Models\JadwalBelajar;

class DashboardControllerStafPengajar extends Controller
{
    public function index()
    {
        $teacher = Auth::user();

        // Ambil jadwal yang diampu oleh pengajar ini + siswa-nya saja
        $jadwal = $teacher->schedulesAsTeacher()
            ->with(['users' => function ($query) {
                $query->where('role', 'siswa');
            }])
            ->get();

        // Total kelas yang diampu
        $totalKelas = $jadwal->count();

        // Total siswa unik dari seluruh kelas yang diajar
        $totalSiswa = $jadwal->flatMap(fn($kelas) => $kelas->users)
            ->unique('id')
            ->count();

        // ID semua jadwal yang diajar
        $jadwalIds = $jadwal->pluck('id');

        // Rata-rata kehadiran siswa (anggap kolom kehadiran berisi 1/0)
        $rataKehadiran = PresensiSiswa::whereIn('jadwal_belajar_id', $jadwalIds)->avg('kehadiran') ?? 0;

        // Rata-rata nilai siswa di semua jadwal
        $rataNilai = NilaiSiswa::whereIn('jadwal_belajar_id', $jadwalIds)->avg('nilai') ?? 0;

        // 5 jadwal terdekat
        $jadwalTerdekat = JadwalBelajar::whereIn('id', $jadwalIds)
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->take(5)
            ->get();

        return view('role.staf_pengajar.dashboard.index', compact(
            'totalKelas',
            'totalSiswa',
            'rataKehadiran',
            'rataNilai',
            'jadwalTerdekat'
        ));
    }
}
