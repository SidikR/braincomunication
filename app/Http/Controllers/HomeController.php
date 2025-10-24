<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Berita;
use App\Models\Bidang;
use App\Models\Fasilitas;
use App\Models\Gallery;
use App\Models\Layanan;
use App\Models\Pejabat;
use App\Models\HeroCarousel;
use App\Models\KategoriGallery;
use App\Models\Kenapa;
use App\Models\Program;
use App\Models\Testimoni;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $hero_carousel = HeroCarousel::all();
        $layanan = Layanan::take(3)->get();
        $berita = Berita::getBeritaTerbaru();
        $galeri = Gallery::take(8)->get();
        $kategori_galeri = KategoriGallery::all();
        $pejabat = Pejabat::take(1)->get();
        $bidang = Bidang::take(2)->get();
        $about = About::first();
        $fasilitas = Fasilitas::all();
        $kenapas = Kenapa::all();
        $programs = Program::take(3)->get();
        $testimoni = Testimoni::all();
        return view('index', compact('hero_carousel', 'layanan', 'berita', 'galeri', 'kategori_galeri', 'pejabat', 'bidang', 'about', 'fasilitas','kenapas','programs','testimoni' ));
    }
}
