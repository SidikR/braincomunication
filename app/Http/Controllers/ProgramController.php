<?php

namespace App\Http\Controllers;

use App\Models\HeroCarouselPromo;
use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class ProgramController extends Controller
{
    public function index()
    {
        $program = Program::all();
        $hero_promo = HeroCarouselPromo::getHeroPromo();
        // dd($program);
        $meta = [
            'app_name' => getInfo()->title,
            'title' => 'Program',
            'description' => 'Jelajahi berbagai program yang dikelola oleh ' . getInfo()->title . ' Dapatkan informasi terperinci tentang layanan, kegiatan, dan program unggulan yang dilakukan dalam program teknologi informasi, komunikasi, e-government, serta pengembangan infrastruktur digital. Mari bersama-sama memajukan sektor teknologi dan informasi untuk kemajuan Lampung Selatan',
            'keywords' => 'program ' . getInfo()->title . ', teknologi informasi, komunikasi, e-government, infrastruktur digital, layanan publik, kegiatan, program, Lampung Selatan',
            'author' => null,
            'thumbnail' => null,
            'published_at' => null,
            'modified_at' => null
        ];
        return view('pages.program.index', compact('program', 'meta', 'hero_promo'));
    }

    public function detail($slug)
    {
        $program = Program::getProgramById($slug);
        $hero_promo = HeroCarouselPromo::getHeroPromo();
        $meta = [
            'app_name' => getInfo()->title,
            'title' => $program->name,
            'description' => $program->description,
            'keywords' => $program->name,
            'author' => null,
            'thumbnail' => asset($program->image),
            'published_at' => $program->published_at,
            'modified_at' => $program->updated_at
        ];
        return view('pages.program.read', compact('program', 'meta', 'hero_promo'));
    }
}
