<?php

namespace App\Http\Controllers\Role\Siswa;

use App\Models\NilaiSiswa;
use Illuminate\Http\Request;
use App\Models\PresensiSiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanSiswaController extends Controller
{
    public function exportBulanan(Request $request)
    {
        $siswa = Auth::user();
        $bulan = $request->input('bulan', now()->format('m'));
        $tahun = $request->input('tahun', now()->format('Y'));

        // Ambil jadwal yang diikuti siswa pada bulan dan tahun tertentu
        $jadwal = $siswa->schedulesAsStudent()
            ->whereMonth('start_time', $bulan)
            ->whereYear('start_time', $tahun)
            ->with(['users', 'teachers'])
            ->get();

        // Hitung statistik sederhana
        $totalKelas = $jadwal->count();
        $totalHadir = \App\Models\PresensiSiswa::where('user_id', $siswa->id)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->where('kehadiran', 'hadir')
            ->count();
        $totalTidakHadir = \App\Models\PresensiSiswa::where('user_id', $siswa->id)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->where('kehadiran', '!=', 'hadir')
            ->count();

        $rataNilai = \App\Models\NilaiSiswa::where('user_id', $siswa->id)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->avg('nilai');

        // Generate PDF dari view
        $pdf = Pdf::loadView('role.siswa.laporan.bulanan', compact(
            'siswa',
            'bulan',
            'tahun',
            'jadwal',
            'totalKelas',
            'totalHadir',
            'totalTidakHadir',
            'rataNilai'
        ))->setPaper('A4', 'portrait');

        return $pdf->stream('laporan_bulanan_' . $siswa->name . '_' . $bulan . '_' . $tahun . '.pdf');
    }
}
