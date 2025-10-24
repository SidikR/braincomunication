<?php

namespace App\Http\Controllers;

use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        $meta = [
            'app_name' => getInfo()->title,
            'title' => 'Tentang',
            'description' => $about->description,
            'keywords' => 'About ' . $about->title,
            'author' => null,
            'thumbnail' => null,
            'published_at' => null,
            'modified_at' => null
        ];

        return view('pages.about.index', compact('about', 'meta'));
    }
}
