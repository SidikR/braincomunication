<?php

namespace App\Models;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    use HasFactory;
    protected $table = "services";
    protected $fillable = ['name', 'description', 'image', 'alt_image', 'slug', 'content'];

    public static function getServiceById($slug)
    {
        return static::where('slug', $slug)
            ->firstOrFail();
    }
}
