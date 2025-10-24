<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use App\Models\PejabatContent;

class PejabatController extends Controller
{
    public function index()
    {
        $pejabat = Pejabat::paginate(3);
        $konten = PejabatContent::all();
        $meta = [
            'app_name' => getInfo()->title,
            'title' => 'Pejabat',
            'description' => 'Temukan informasi tentang pejabat dan staf terkemuka di ' . getInfo()->title . ' Lampung Selatan. Profil lengkap para pejabat, visi, misi, dan kontribusi mereka dalam mengembangkan layanan publik dan infrastruktur teknologi informasi di daerah ini',
            'keywords' => 'pejabat ' . getInfo()->title . ' Lampung Selatan, profil pejabat, staf ' . getInfo()->title . ', visi misi, layanan publik, infrastruktur teknologi informasi, pengembangan daerah, inovasi teknologi, kepemimpinan',
            'author' => null,
            'thumbnail' => null,
            'published_at' => null,
            'modified_at' => null
        ];
        return view('pages.pejabat.index', compact('pejabat', 'konten', 'meta'));
    }
}
