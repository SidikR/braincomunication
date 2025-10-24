<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroCarousel extends Model
{
    use HasFactory;
    protected $table = 'hero_carousel';
    protected $fillable = ['image', 'heading', 'paragraph', 'alt_image'];


    public static function getHeroById($id)
    {
        return static::find($id);
    }
}
