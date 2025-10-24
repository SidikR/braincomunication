<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Layanan;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    public function index()
    {
        $bidang = Bidang::all();
        // dd($bidang);
        $meta = [
            'app_name' => getInfo()->title,
            'title' => 'Bidang',
            'description' => 'Jelajahi berbagai bidang yang dikelola oleh ' . getInfo()->title . ' Dapatkan informasi terperinci tentang layanan, kegiatan, dan program unggulan yang dilakukan dalam bidang teknologi informasi, komunikasi, e-government, serta pengembangan infrastruktur digital. Mari bersama-sama memajukan sektor teknologi dan informasi untuk kemajuan Lampung Selatan',
            'keywords' => 'bidang ' . getInfo()->title . ', teknologi informasi, komunikasi, e-government, infrastruktur digital, layanan publik, kegiatan, program, Lampung Selatan',
            'author' => null,
            'thumbnail' => null,
            'published_at' => null,
            'modified_at' => null
        ];
        return view('pages.bidang.index', compact('bidang', 'meta'));
    }

    public function detail($slug)
    {
        $bidang = Bidang::getDivisionBySlug($slug);
        $meta = [
            'app_name' => getInfo()->title,
            'title' => $bidang->name,
            'description' => $bidang->description,
            'keywords' => $bidang->name,
            'author' => null,
            'thumbnail' => asset($bidang->image),
            'published_at' => $bidang->published_at,
            'modified_at' => $bidang->updated_at
        ];
        return view('pages.bidang.read', compact('bidang', 'meta'));
    }
}
