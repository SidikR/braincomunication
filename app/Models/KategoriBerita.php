<?php

namespace App\Models;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriBerita extends Model
{
    use HasFactory;
    protected $table = 'categories_news';
    protected $fillable = ['name', 'description', 'slug'];

    public function berita()
    {
        return $this->hasMany(Berita::class, 'category_id')->where('published', true);
    }

    public static function getKategoriBerita($slug)
    {
        return static::where('slug', $slug)
            ->firstOrFail();
    }
}
