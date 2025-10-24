<?php

namespace App\Http\Controllers;

use App\Models\Penghargaan;
use App\Models\ProfilKami;
use App\Models\Sejarah;
use App\Models\StrukturOrganisasi;
use App\Models\UnitUsaha;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index()
    {
        $profilKami = ProfilKami::first();
        $sejarah = Sejarah::first();
        $strukturOrganisasi = StrukturOrganisasi::first();
        $unitUsaha = UnitUsaha::first();
        $penghargaan = Penghargaan::first();
        $meta = [
            'app_name' => getInfo()->title,
            'title' => 'Tentang',
            'description' => $profilKami->description,
            'keywords' => 'About ' . $profilKami->title,
            'author' => null,
            'thumbnail' => null,
            'published_at' => null,
            'modified_at' => null
        ];

        return view('pages.tentang-kami.index', compact('profilKami', 'meta', 'sejarah', 'strukturOrganisasi', 'unitUsaha', 'penghargaan'));
    }

}
