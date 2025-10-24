<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'thumbnail', 'konten', 'slug'];

    public static function getProgramById($slug)
    {
        return static::where('slug', $slug)
            ->firstOrFail();
    }
}
