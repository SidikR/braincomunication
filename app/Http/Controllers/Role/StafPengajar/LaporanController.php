<?php

namespace App\Http\Controllers\Role\StafPengajar;

use App\Http\Controllers\Controller;
use App\Models\PresensiSiswa;
use App\Models\NilaiSiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF; // pastikan sudah install barryvdh/laravel-dompdf

class LaporanController extends Controller
{
    public function exportBulanan(Request $request)
    {
        $teacher = Auth::user();
        $bulan = $request->input('bulan', now()->format('m'));
        $tahun = $request->input('tahun', now()->format('Y'));

        // Ambil semua jadwal milik pengajar
        $jadwal = $teacher->schedulesAsTeacher()
            ->with('users')
            ->whereMonth('start_time', $bulan)
            ->whereYear('start_time', $tahun)
            ->get();

        // Buat laporan per kelas
        $laporan = $jadwal->map(function ($kelas) use ($bulan, $tahun) {
            $presensi = PresensiSiswa::where('jadwal_belajar_id', $kelas->id)
                ->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun);

            $nilai = NilaiSiswa::where('jadwal_belajar_id', $kelas->id)
                ->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun);

            $jumlahPertemuan = $presensi->count();
            $rataKehadiran = $presensi->avg('kehadiran') ?? 0;
            $rataNilai = $nilai->avg('nilai') ?? 0;

            return [
                'kelas' => $kelas->title,
                'jumlah_siswa' => $kelas->users->count(),
                'jumlah_pertemuan' => $jumlahPertemuan,
                'rata_kehadiran' => round($rataKehadiran, 2),
                'rata_nilai' => round($rataNilai, 2),
            ];
        });

        $pdf = PDF::loadView('role.staf_pengajar.laporan.bulanan', [
            'teacher' => $teacher,
            'laporan' => $laporan,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Bulanan_' . $teacher->name . "_{$bulan}_{$tahun}.pdf");
    }
}
