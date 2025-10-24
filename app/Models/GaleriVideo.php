<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriVideo extends Model
{
    use HasFactory;
    protected $table = 'galeri_video';
    protected $fillable = ['ulid', 'script', 'category_id', 'title', 'description'];

    public function category()
    {
        return $this->belongsTo(KategoriGallery::class, 'category_id');
    }

    public static function getGalery()
    {
        return static::with(['category'])
            ->get();
    }

    public static function getGalleryByUlid($ulid)
    {
        return static::with(['category'])
            ->where('ulid', $ulid)
            ->firstOrFail();
    }
}
