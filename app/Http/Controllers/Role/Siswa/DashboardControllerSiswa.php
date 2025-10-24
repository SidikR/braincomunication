<?php

namespace App\Http\Controllers\Role\Siswa;

use App\Models\User;
use App\Models\Pesan;
use App\Models\Berita;
use App\Models\Bidang;
use App\Models\Gallery;
use App\Models\Layanan;
use App\Models\Pejabat;
use App\Models\NilaiSiswa;
use App\Models\GaleriVideo;
use Illuminate\Http\Request;
use App\Models\JadwalBelajar;
use App\Models\PresensiSiswa;
use App\Models\KategoriBerita;
use App\Models\KategoriGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardControllerSiswa extends Controller
{
    public function index()
    {
        $siswa = Auth::user();

        // Ambil semua jadwal yang diikuti siswa
        $jadwalIds = $siswa->schedulesAsStudent()->pluck('jadwal_belajars.id');

        // Statistik utama
        $totalJadwal = $jadwalIds->count();
        $jadwalAktif = JadwalBelajar::whereIn('id', $jadwalIds)->where('status', 'active')->count();

        $rataNilai = NilaiSiswa::where('user_id', $siswa->id)->avg('nilai');

        $totalPresensi = PresensiSiswa::whereIn('jadwal_belajar_id', $jadwalIds)
            ->where('user_id', $siswa->id)
            ->count();

        $totalHadir = PresensiSiswa::whereIn('jadwal_belajar_id', $jadwalIds)
            ->where('user_id', $siswa->id)
            ->where('kehadiran', 'hadir')
            ->count();

        $persentaseKehadiran = $totalPresensi > 0 ? round(($totalHadir / $totalPresensi) * 100, 1) : 0;

        // Grafik nilai per mata pelajaran
        $nilaiPerMapel = NilaiSiswa::where('user_id', $siswa->id)
            ->with('jadwalBelajar.mataPelajaran')
            ->get()
            ->groupBy(fn($n) => $n->jadwalBelajar->mataPelajaran->nama ?? 'Tidak diketahui')
            ->map(fn($group) => round($group->avg('nilai'), 2));

        // Jadwal terbaru
        $jadwalTerbaru = JadwalBelajar::whereIn('id', $jadwalIds)
            ->latest()
            ->take(5)
            ->get();

        return view('role.siswa.dashboard.index', compact(
            'totalJadwal',
            'jadwalAktif',
            'rataNilai',
            'persentaseKehadiran',
            'nilaiPerMapel',
            'jadwalTerbaru'
        ));
    }
}
