<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galleries';
    // protected $primaryKey = 'ulid';
    protected $fillable = ['ulid', 'image', 'alt_image', 'category_id', 'title', 'description'];
    // protected $guarded = ['ulid'];

    public function category()
    {
        return $this->belongsTo(KategoriGallery::class, 'category_id');
    }

    public static function getGalery()
    {
        return static::with(['category'])->get();
    }

    public static function getGalleryByUlid($ulid)
    {
        return static::with(['category'])
            ->where('ulid', $ulid)
            ->firstOrFail();
    }
}
