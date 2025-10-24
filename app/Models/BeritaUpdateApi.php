<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaUpdateApi extends Model
{
    use HasFactory;
    protected $table = 'berita_update_api';
    protected $fillable = ['news_id'];

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'id');
    }

    public static function getBeritaUpdated()
    {
        // Mengambil ID berita yang diupdate dari tabel berita_update_api
        $berita_updated_ids = BeritaUpdateApi::orderBy('updated_at', 'desc')
            ->pluck('news_id')->toArray();

        // Mengambil berita yang sesuai dengan ID yang diupdate
        $berita_updated = Berita::with(['kategori', 'writer', 'editor', 'reporter'])
            ->whereIn('id', $berita_updated_ids)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        // Mengubah URL gambar untuk setiap berita yang diperbarui
        $berita_updated->getCollection()->transform(function ($berita) {
            $baseUrl = config('app.url');
            $berita->image_url = "{$baseUrl}/$berita->image";
            unset($berita->image);
            return $berita;
        });

        return $berita_updated;
    }
}
