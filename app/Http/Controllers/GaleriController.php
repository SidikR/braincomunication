<?php

namespace App\Http\Controllers;

use App\Models\GaleriVideo;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\KategoriGallery;

class GaleriController extends Controller
{
    public function index()
    {

        $galeri = Gallery::all();
        $galeri_video = GaleriVideo::all();
        $kategori_galeri = KategoriGallery::all();
        $meta = [
            'app_name' => getInfo()->title,
            'title' => 'Galeri',
            'description' => 'Jelajahi galeri foto dan video yang menampilkan berbagai kegiatan dan acara yang diselenggarakan oleh ' . getInfo()->title . ' Lampung Selatan. Dapatkan gambaran visual tentang inisiatif digital, layanan publik, serta kegiatan komunitas yang telah dilakukan oleh dinas kami. Mari bersama-sama memajukan Lampung Selatan melalui transformasi digital yang inklusif dan berkelanjutan',
            'keywords' => 'galeri foto, galeri video, ' . getInfo()->title . ' Lampung Selatan, inisiatif digital, layanan publik, kegiatan komunitas, transformasi digital, inklusif, berkelanjutan',
            'author' => null,
            'thumbnail' => null,
            'published_at' => null,
            'modified_at' => null
        ];
        return view('pages.galeri.index', compact('galeri', 'kategori_galeri', 'galeri_video', 'meta'));
    }
}
