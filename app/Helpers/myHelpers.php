<?php

use App\Models\Info;
use App\Models\Berita;
use App\Models\Bidang;
use App\Models\Layanan;
use App\Models\Program;
use App\Models\KategoriBerita;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BeritaController;

if (!function_exists('GetNavbar')) {
    function getLayanan()
    {
        // Layanan::all();
        return Layanan::take(5)->pluck('name', 'slug');
    }
    function getProgram()
    {
        // Layanan::all();
        return Program::take(5)->pluck('title', 'slug');
    }

    function getBidang()
    {
        return Bidang::take(5)->pluck('name', 'slug');
    }

    function getInfo()
    {
        return Info::first();
    }

    function getTags()
    {
        return app('App\Http\Controllers\BeritaController')->getAllUniqueTags()->original;
    }

    function getTagsNoPagging()
    {
        $tags = Berita::getAllUniqueTags(); // Mendapatkan array tag
        $escapedTags = array_map('htmlspecialchars', $tags); // Melakukan htmlspecialchars() pada setiap elemen array

        return $escapedTags; // Mengembalikan array tag yang telah di-escape
    }

    function isKeywordActive($keywords)
    {
        $currentUrl = request()->url();
        foreach ($keywords as $keyword) {
            if (strpos($currentUrl, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    function getYearNews()
    {
        return Berita::getAllYears();
    }

    function getCountBeritaByYear()
    {
        return Berita::getBeritaByYear();
    }

    function getMonthAndYear()
    {
        return Berita::getMonthAndYear();
    }

    function getCategories()
    {
        return KategoriBerita::withCount('berita')->get();
    }

    function getBeritaTerbaru()
    {
        return Berita::getBeritaTerbaru();
    }

    function roleName()
    {
        return Auth::user()->role;
    }
}
