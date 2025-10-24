<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    protected $table = "divisions";
    protected $fillable = ['name', 'description', 'image', 'alt_image', 'slug', 'content'];

    public static function getDivisionBySlug($slug)
    {
        return static::where('slug', $slug)
            ->firstOrFail();
    }
}
