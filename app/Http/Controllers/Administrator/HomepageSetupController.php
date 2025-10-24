<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\HeroCarousel;
use App\Models\HeroCarouselPromo;
use App\Models\Photo;
use Illuminate\Http\Request;

class HomepageSetupController extends Controller
{
    public function index()
    {
        $hero_carousel = HeroCarousel::all();
        $hero_carousel_promo = HeroCarouselPromo::all();
        $data = [
            'header_name' => "Setting Hompage Hero",
            'page_name' => "Setting Hompage Hero"
        ];
        return view('administrator-page.pages.homepage-setup.index', compact('data', 'hero_carousel', 'hero_carousel_promo'));
    }

    public function heroPromo()
    {
        $hero_carousel_promo = HeroCarouselPromo::all();
        $data = [
            'header_name' => "Setting Hero Promo",
            'page_name' => "Setting Hero Promo"
        ];
        return view('administrator-page.pages.homepage-setup.hero-promo', compact('data', 'hero_carousel_promo'));
    }
}
