<?php

namespace App\Http\Controllers\Administrator\Api;

use App\Models\HeroCarousel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\HeroCarouselPromo;

class HeroController extends Controller
{
    public function getHero($id)
    {
        $hero_carousel = HeroCarousel::getHeroById($id);
        if (!$hero_carousel) {
            return $this->respondWithError('Tidak ada data image', null, Response::HTTP_NOT_FOUND);
        }
        return $this->respondWithSuccess('Data image hero berhasil dimuat.', $hero_carousel);
    }

    public function getHeroPromo($id)
    {
        $hero_carousel = HeroCarouselPromo::getHeroById($id);
        if (!$hero_carousel) {
            return $this->respondWithError('Tidak ada data image', null, Response::HTTP_NOT_FOUND);
        }
        return $this->respondWithSuccess('Data image hero berhasil dimuat.', $hero_carousel);
    }
}
