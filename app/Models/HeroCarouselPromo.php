<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroCarouselPromo extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'heading', 'paragraph', 'alt_image', 'jenis'];


    public static function getHeroById($id)
    {
        return static::find($id);
    }

    public static function getHeroPromo()
    {
        return static::where('jenis', 'promo')
            ->orderBy('created_at', 'desc')  // Sort by creation date (optional)
            ->get();  // Retrieve the results
    }

    public static function getHeroTestimoni()
    {
        return static::where('jenis', 'testimoni')
            ->orderBy('created_at', 'desc')  // Sort by creation date (optional)
            ->get();  // Retrieve the results
    }

}
