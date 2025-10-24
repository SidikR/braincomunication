<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'news';
    protected $fillable = ['title', 'description', 'content', 'writer_id', 'editor_id', 'reporter_id', 'category_id', 'tag', 'slug', 'published', 'published_at', 'description_thumbnail', 'count_of_viewers', 'image', 'alt_image'];

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'category_id');
    }

    public function writer()
    {
        return $this->belongsTo(Redaktur::class, 'writer_id');
    }

    public function editor()
    {
        return $this->belongsTo(Redaktur::class, 'editor_id');
    }

    public function reporter()
    {
        return $this->belongsTo(Redaktur::class, 'reporter_id');
    }

    public static function getBeritaByYear()
    {
        return static::where('published', true)
            ->selectRaw('YEAR(published_at) as year, COUNT(*) as count')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
    }

    public static function getAllYears()
    {
        return static::where('published', true)
            ->selectRaw('YEAR(published_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
    }



    public static function getDataBeritaByYear($tahun)
    {
        return static::with(['kategori', 'writer', 'editor', 'reporter'])
            ->where('published', true)
            ->whereYear('published_at', $tahun)
            ->orderByDesc('published_at')
            ->paginate(10);
    }


    public static function getBeritaTerpopuler()
    {
        return static::with(['kategori', 'writer', 'editor', 'reporter'])
            ->where('published', true)
            ->orderByDesc('count_of_viewers')
            ->orderByDesc('published_at')
            ->paginate(10);
    }

    public static function getKegiatanSeru()
    {
        return static::with(['kategori', 'writer', 'editor', 'reporter'])
            ->where('published', true)
            ->whereHas('kategori', function ($query) {
                $query->where('name', 'Kegiatan Seru');
            })
            ->orderByDesc('count_of_viewers')
            ->orderByDesc('published_at')
            ->paginate(10);
    }

    public static function getBeritaBySlug($slug)
    {
        return static::with(['kategori', 'writer', 'editor', 'reporter'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public static function getBeritaByIdApi($slug)
    {
        $berita = static::with(['kategori', 'writer', 'editor', 'reporter'])
            ->where('slug', $slug)
            ->firstOrFail();

        $baseUrl = config('app.url');
        $berita->image_url = "{$baseUrl}/$berita->image";
        unset($berita->image);

        $berita->url_berita = "{$baseUrl}/berita/{$slug}";

        return $berita;
    }


    public static function getBeritaByCategory($category_id)
    {
        return static::with(['kategori', 'writer', 'editor', 'reporter'])
            ->where('published', true)
            ->where('category_id', $category_id)
            ->orderBy('published_at', 'desc')
            ->paginate(6);
    }

    public static function searchNews($keyword)
    {
        return static::with(['kategori', 'writer', 'editor', 'reporter'])
            ->where('published', true)
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%")
                    ->orWhere('content', 'like', "%$keyword%")
                    ->orWhere('tag', 'like', "%$keyword%");
            })
            ->orderByDesc('published_at'); // Mengurutkan berdasarkan tanggal publikasi yang terbaru
    }


    public static function getBeritaTerbaru()
    {
        return static::with(['kategori', 'writer', 'editor', 'reporter'])
            ->where('published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(5);
    }

    public static function getBeritaTerbaruApi()
    {
        $berita_terbaru = static::with(['kategori'])
            ->select('id', 'title', 'category_id', 'slug', 'published_at')
            ->where('published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        $berita_terbaru->getCollection()->transform(function ($berita) {
            $berita->source_data = getInfo()->title;
            return $berita;
        });

        return $berita_terbaru;
    }

    public static function getMonthAndYear()
    {
        $tahunAwalQuery = static::selectRaw('YEAR(MIN(published_at)) as tahun_awal')->where('published', true);
        $tahunTerakhirQuery = static::selectRaw('YEAR(MAX(published_at)) as tahun_terakhir')->where('published', true);

        $tahunAwal = $tahunAwalQuery->pluck('tahun_awal')->first();
        $tahunTerakhir = $tahunTerakhirQuery->pluck('tahun_terakhir')->first();

        // Pengecekan apakah ada tahun awal dan akhir yang valid
        if (!$tahunAwal || !$tahunTerakhir) {
            return []; // Tidak ada tahun yang valid, kembalikan array kosong
        }

        $bulanTahun = [];

        for ($tahun = $tahunTerakhir; $tahun >= $tahunAwal; $tahun--) {
            // Tentukan bulan pertama dan terakhir dalam tahun saat ini
            $bulanAwal = ($tahun == $tahunAwal) ? (int)date('m', strtotime($tahunAwal . '-01-01')) : 1;
            $bulanAkhir = ($tahun == $tahunTerakhir) ? (int)date('m') : 12;

            // Iterasi melalui setiap bulan dalam tahun saat ini
            for ($bulan = $bulanAwal; $bulan <= $bulanAkhir; $bulan++) {
                $bulanTahun[] = ['bulan' => $bulan, 'tahun' => $tahun];
            }
        }

        return $bulanTahun;
    }



    public static function getBeritaByMonthAndYear($bulanTahun)
    {
        // Pisahkan bulan dan tahun dari parameter
        list($bulan, $tahun) = explode('-', $bulanTahun);

        // Ambil berita berdasarkan bulan dan tahun
        $berita = static::where('published', true)
            ->whereYear('published_at', $tahun)
            ->whereMonth('published_at', $bulan)
            ->paginate(10);

        return $berita;
    }

    public static function getAllUniqueTagsPagging()
    {
        // Ambil semua nilai tag dari semua baris data berita
        $allTags = static::where('published', true)->pluck('tag')->all();


        // Inisialisasi array untuk menyimpan semua nilai tag
        $tagsArray = [];

        // Loop melalui setiap baris data tag
        foreach ($allTags as $tag) {
            // Normalisasi nilai tag (hapus spasi tambahan dan pecah string berdasarkan koma)
            $normalizedTags = explode(',', trim($tag));

            // Gabungkan nilai tag yang sudah dinormalisasi ke dalam array
            $tagsArray = array_merge($tagsArray, $normalizedTags);
        }

        // Ambil tag yang unik
        $uniqueTags = array_unique($tagsArray);

        // Lakukan paginasi menggunakan LengthAwarePaginator
        $page = request()->get('page', 1); // Ambil nomor halaman dari permintaan, defaultnya adalah halaman 1
        $perPage = 50; // Jumlah item per halaman
        $offset = ($page * $perPage) - $perPage;
        $paginatedItems = array_slice($uniqueTags, $offset, $perPage, true);

        $totalUniqueTags = count($uniqueTags);

        $tagsPaginated = new LengthAwarePaginator(
            $paginatedItems,
            $totalUniqueTags,
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return $tagsPaginated;
    }


    public static function getAllUniqueTags()
    {
        // Ambil semua nilai tag dari semua baris data berita
        $allTags = static::pluck('tag')->toArray();

        // Inisialisasi array untuk menyimpan semua nilai tag
        $uniqueTags = [];

        // Loop melalui setiap baris data tag
        foreach ($allTags as $tag) {
            // Normalisasi nilai tag (hapus spasi tambahan dan pecah string berdasarkan koma)
            $normalizedTags = explode(',', str_replace(', ', ',', trim($tag)));

            // Gabungkan nilai tag yang sudah dinormalisasi ke dalam array unik
            $uniqueTags = array_merge($uniqueTags, $normalizedTags);
        }

        // Ambil tag yang unik
        $uniqueTags = array_values(array_unique($uniqueTags));

        return $uniqueTags;
    }
}
