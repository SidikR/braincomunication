<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Bidang;
use App\Models\GaleriVideo;
use App\Models\Gallery;
use App\Models\JadwalBelajar;
use App\Models\KategoriBerita;
use App\Models\KategoriGallery;
use App\Models\Layanan;
use App\Models\MataPelajaran;
use App\Models\Pejabat;
use App\Models\Pesan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $layanan_count = Layanan::count();
        $pejabat_count = Pejabat::count();
        $bidang_count = Bidang::count();
        $pesan_count = Pesan::count();
        $jumlah_pesan_baru = Pesan::where('dilihat', false)->count();
        $jumlah_pesan_dibaca = Pesan::where('dilihat', true)->count();
        $galeri_foto_count = Gallery::count();
        $galeri_video_count = GaleriVideo::count();
        $kategori_galeri_count = KategoriGallery::count();
        $berita_count = Berita::count();
        $kategori_berita_count = KategoriBerita::count();
        $berita_publish_count = Berita::where('published', true)->count();
        $berita_unpublish_count = Berita::where('published', false)->count();

        $total_user = User::count();
        $siswa_count = User::where('role', 'siswa')->count();
        $staf_pengajar_count = User::where('role', 'staf_pengajar')->count();
        $staf_administrasi_count = User::where('role', 'staf_administrasi')->count();
        $jadwal_count = JadwalBelajar::count();
        $mata_pelajaran_count = MataPelajaran::count();

        $pesan_terbaru = Pesan::latest()->take(5)->get();

        return view('administrator-page.pages.dashboard.index', compact(
            'layanan_count', 'pejabat_count', 'bidang_count', 'pesan_count',
            'galeri_foto_count', 'galeri_video_count', 'kategori_galeri_count',
            'berita_count', 'kategori_berita_count', 'berita_publish_count',
            'jumlah_pesan_baru', 'jumlah_pesan_dibaca', 'berita_unpublish_count',
            'total_user', 'siswa_count', 'staf_pengajar_count', 'staf_administrasi_count',
            'jadwal_count', 'mata_pelajaran_count', 'pesan_terbaru'
        ));
    }
}