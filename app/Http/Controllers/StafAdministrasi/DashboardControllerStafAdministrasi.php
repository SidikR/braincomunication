<?php

namespace App\Http\Controllers\StafAdministrasi;

use Carbon\Carbon;
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
use App\Models\PresensiSiswa;
use App\Models\KategoriBerita;
use App\Models\KategoriGallery;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\HasilAkhirExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DashboardControllerStafAdministrasi extends Controller
{
    public function index(Request $request)
    {
        $admin = Auth::user();

        // Hitung total guru dan siswa
        $totalGuru = User::where('role', 'staf_pengajar')->count();
        $totalSiswa = User::where('role', 'siswa')->count();

        // Total berita dan layanan aktif
        $totalBerita = Berita::count();
        $totalLayanan = Layanan::count();

        // Total galeri dan video
        $totalFoto = Gallery::count();
        $totalVideo = GaleriVideo::count();

        // Hitung rata-rata kehadiran siswa dan guru
        $rataKehadiranSiswa = PresensiSiswa::avg('kehadiran');

        // Rata-rata nilai seluruh siswa
        $rataNilaiSiswa = NilaiSiswa::avg('nilai');

        // Ambil 5 berita terbaru
        $beritaTerbaru = Berita::latest()->take(5)->get();

        // Ambil 5 pesan terakhir
        $pesanTerbaru = Pesan::latest()->take(5)->get();

        $bulan = $request->input('bulan', now()->format('m'));
        $tahun = $request->input('tahun', now()->format('Y'));

        // Ambil semua pengajar aktif
        $teachers = \App\Models\User::where('role', 'staf_pengajar')
            ->with(['schedulesAsTeacher' => function ($query) use ($bulan, $tahun) {
                $query->whereMonth('start_time', $bulan)
                    ->whereYear('start_time', $tahun);
            }])
            ->get();

        return view('staf-administrasi-page.pages.dashboard.index', compact(
            'totalGuru',
            'totalSiswa',
            'totalBerita',
            'totalLayanan',
            'totalFoto',
            'totalVideo',
            'rataKehadiranSiswa',
            'rataNilaiSiswa',
            'beritaTerbaru',
            'pesanTerbaru',
            'bulan',
            'tahun',
            'teachers'
        ));
    }

    public function export(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('m'));
        $tahun = $request->input('tahun', now()->format('Y'));

        // Ambil semua pengajar dengan jadwal di bulan tersebut
        $teachers = \App\Models\User::where('role', 'staf_pengajar')
            ->with(['schedulesAsTeacher' => function ($query) use ($bulan, $tahun) {
                $query->whereMonth('start_time', $bulan)
                    ->whereYear('start_time', $tahun);
            }])
            ->get();

        $pdf = PDF::loadView('staf-administrasi-page.pages.laporan', compact('teachers', 'bulan', 'tahun'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("Laporan_Mengajar_{$bulan}_{$tahun}.pdf");
    }

    public function exportHasilAkhir(Request $request)
    {
        // Validasi KKM wajib
        $request->validate([
            'kkm' => 'required|numeric|min:0|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $kkm = $request->input('kkm');

        // Jika tanggal kosong, export semua
        return Excel::download(
            new HasilAkhirExport($start, $end, $kkm),
            $start && $end
                ? "hasil_akhir_{$start}_to_{$end}.xlsx"
                : 'hasil_akhir_semua.xlsx'
        );
    }
}
