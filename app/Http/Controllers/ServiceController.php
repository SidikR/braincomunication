<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        $meta = [
            'app_name' => getInfo()->title,
            'title' => 'Layanan',
            'description' => 'Dapatkan informasi lengkap tentang layanan yang disediakan oleh ' . getInfo()->title . ' di Lampung Selatan. Temukan berbagai layanan terkait teknologi informasi, komunikasi, dan digitalisasi yang tersedia untuk memajukan pelayanan publik dan meningkatkan konektivitas di daerah ini',
            'keywords' => 'layanan ' . getInfo()->title . ', teknologi informasi, komunikasi digital, layanan publik, Lampung Selatan, digitalisasi, konektivitas, pelayanan terkini',
            'author' => null,
            'thumbnail' => null,
            'published_at' => null,
            'modified_at' => null
        ];
        return view('pages.service.index', compact('layanan', 'meta'));
    }

    public function detail($slug)
    {
        $layanan = Layanan::getServiceById($slug);

        $data = [
            'header_name' => "Data Layanan",
            'page_name' => "Detail Layanan " . $layanan->name
        ];

        $meta = [
            'app_name' => getInfo()->title,
            'title' => $layanan->name,
            'description' => $layanan->description,
            'keywords' => $layanan->name,
            'author' => null,
            'thumbnail' => asset($layanan->image),
            'published_at' => $layanan->published_at,
            'modified_at' => $layanan->updated_at
        ];

        return view('pages.service.read', compact('layanan', 'data', 'meta'));
    }
}
