<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\JadwalBelajar;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function exportPdf()
    {
        $siswa = Auth::user();

        // Ambil jadwal yang diikuti siswa
        $jadwal = $siswa->schedulesAsStudent()
            ->with(['nilaiSiswa', 'kehadiranSiswa'])
            ->get();

        $pdf = Pdf::loadView('dashboard.siswa.report-pdf', [
            'siswa' => $siswa,
            'jadwal' => $jadwal,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('laporan_perkembangan_' . $siswa->name . '.pdf');
    }
}
