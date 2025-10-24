<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Models\HeroCarouselPromo;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimoniStakeholder = Testimoni::where('jenis', 'stakeholder')->get();
        $testimoniSahabat = Testimoni::where('jenis', 'sahabat')->get();
        $hero_testimoni = HeroCarouselPromo::getHeroTestimoni();
        // dd($testimoni);
        $meta = [
            'app_name' => getInfo()->title,
            'title' => 'Program',
            'description' => 'Jelajahi berbagai testimoni yang dikelola oleh ' . getInfo()->title . ' Dapatkan informasi terperinci tentang layanan, kegiatan, dan testimoni unggulan yang dilakukan dalam testimoni teknologi informasi, komunikasi, e-government, serta pengembangan infrastruktur digital. Mari bersama-sama memajukan sektor teknologi dan informasi untuk kemajuan Lampung Selatan',
            'keywords' => 'testimoni ' . getInfo()->title . ', teknologi informasi, komunikasi, e-government, infrastruktur digital, layanan publik, kegiatan, testimoni, Lampung Selatan',
            'author' => null,
            'thumbnail' => null,
            'published_at' => null,
            'modified_at' => null
        ];
        return view('pages.testimoni.index', compact('testimoniStakeholder', 'meta', 'testimoniSahabat', 'hero_testimoni'));
    }
}
