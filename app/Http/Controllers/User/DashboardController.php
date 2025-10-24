<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Bidang;
use App\Models\GaleriVideo;
use App\Models\Gallery;
use App\Models\KategoriBerita;
use App\Models\KategoriGallery;
use App\Models\Layanan;
use App\Models\Pejabat;
use App\Models\Pesan;

class DashboardController extends Controller
{
    public function index()
    {
        return view('role.user.dashboard.index');
    }
}
