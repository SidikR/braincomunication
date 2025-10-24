<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Berita;
use Illuminate\Http\Request;
use App\Models\KategoriBerita;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BeritaController extends Controller
{

    public function index()
    {
        $berita_populer = Berita::getBeritaTerpopuler();
        $berita_kegiatan_seru = Berita::getKegiatanSeru();
        $berita_terbaru = Berita::getBeritaTerbaru();

        $meta = [
            'app_name' => getInfo()->title,
            'title' => 'Berita',
            'description' => 'Temukan berita terkini dan informasi terupdate seputar Lampung Selatan. Dapatkan liputan lengkap tentang berbagai kegiatan komunitas, layanan publik, dan inisiatif digital yang memajukan daerah ini. Mari bergabung dalam transformasi digital untuk menciptakan masyarakat yang terhubung dan berdaya saing tinggi',
            'keywords' => 'berita Lampung Selatan, informasi terkini, kegiatan komunitas, layanan publik, inisiatif digital, transformasi digital, masyarakat terhubung, masyarakat berdaya saing',
            'author' => null,
            'thumbnail' => null,
            'published_at' => null,
            'modified_at' => null
        ];

        $heading = [
            'h2' => "Berita",
            'p' => "Berikut ini berita terkini dan terpecaya yang ada di " . getInfo()->title
        ];

        return view('pages.news.index', compact('berita_populer', 'berita_kegiatan_seru', 'berita_terbaru',  'meta', 'heading'));
    }

    public function detail($slug)
    {
        try {
            $berita = Berita::getBeritaBySlug($slug);

            // if (!$berita) {
            //     return response()->view('errors.404', [], 404);
            // }

            $meta = [
                'app_name' => "Dinas Komunikasi dan Informatika Lampung Selatan",
                'title' => $berita->title,
                'description' => $berita->description,
                'keywords' => $berita->tag,
                'author' => $berita->writer->name,
                'thumbnail' => asset($berita->image),
                'published_at' => $berita->published_at,
                'modified_at' => $berita->updated_at
            ];

            $heading = [
                'h2' => "Detail Berita",
                'p' => $berita->title
            ];

            $berita_terbaru = Berita::getBeritaTerbaru();

            $berita->increment('count_of_viewers');

            // if (!$berita_terbaru) {
            //     return response()->view('errors.500', [], 500);
            // }


            return view('pages.news.read', compact('berita', 'berita_terbaru',  'meta', 'heading'));
        } catch (\Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }

    public function category($category_slug)
    {
        try {
            $kategori = KategoriBerita::where('slug', $category_slug)->first();

            // if (!$kategori) {
            //     return response()->view('errors.404', [], 404);
            // }

            $beritas = Berita::getBeritaByCategory($kategori->id);

            // if (!$beritas) {
            //     return response()->view('errors.404', [], 404);
            // }

            $category_name = $kategori->name;

            $berita_terbaru = Berita::getBeritaTerbaru();


            // if (!$berita_terbaru) {
            //     return response()->view('errors.404', [], 404);
            // }



            $meta = [
                'app_name' => getInfo()->title,
                'title' => 'Kategori Berita ' . $category_name,
                'description' => 'Temukan berita terkini dan informasi terupdate seputar Lampung Selatan. Dapatkan liputan lengkap tentang berbagai kegiatan komunitas, layanan publik, dan inisiatif digital yang memajukan daerah ini. Mari bergabung dalam transformasi digital untuk menciptakan masyarakat yang terhubung dan berdaya saing tinggi',
                'keywords' => 'berita Lampung Selatan, informasi terkini, kegiatan komunitas, layanan publik, inisiatif digital, transformasi digital, masyarakat terhubung, masyarakat berdaya saing',
                'author' => null,
                'thumbnail' => null,
                'published_at' => null,
                'modified_at' => null
            ];

            $heading = [
                'h2' => "Berita Dengan Kategori " . $category_name,
                'p' => "Temukan berita terkini dan terpecaya di " . getInfo()->title
            ];

            // Menyertakan nama kategori dalam array yang dikompak
            return view('pages.news.category', compact('beritas', 'berita_terbaru', 'category_name',  'heading', 'meta'));
        } catch (\Throwable $th) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function arsipBerita(Request $request, $bulanTahun)
    {
        try {
            // Memisahkan nilai bulan dan tahun dari string bulanTahun
            list($bulan, $tahun) = explode('-', $bulanTahun);

            // Mengonversi nama bulan dari bahasa Inggris ke bahasa Indonesia
            $namaBulan = strftime('%B', mktime(0, 0, 0, $bulan, 1));

            setlocale(LC_TIME, 'id_ID'); // Menetapkan lokal menjadi Indonesia

            $beritas = Berita::getBeritaByMonthAndYear($bulanTahun);

            // if (!$beritas) {
            //     return response()->view('errors.404', [], 404);
            // }

            // Menggunakan nama bulan yang sudah diubah format
            $bulan = $namaBulan . ' ' . $tahun;

            $berita_terbaru = Berita::getBeritaTerbaru();


            // if (!$berita_terbaru) {
            //     return response()->view('errors.404', [], 404);
            // }

            $meta = [
                'app_name' => getInfo()->title,
                'title' => 'Arsip Berita ' . $bulan,
                'description' => 'Temukan berita terkini dan informasi terupdate seputar Lampung Selatan. Dapatkan liputan lengkap tentang berbagai kegiatan komunitas, layanan publik, dan inisiatif digital yang memajukan daerah ini. Mari bergabung dalam transformasi digital untuk menciptakan masyarakat yang terhubung dan berdaya saing tinggi',
                'keywords' => 'berita Lampung Selatan, informasi terkini, kegiatan komunitas, layanan publik, inisiatif digital, transformasi digital, masyarakat terhubung, masyarakat berdaya saing',
                'author' => null,
                'thumbnail' => null,
                'published_at' => null,
                'modified_at' => null
            ];

            $heading = [
                'h2' => "Arsip berita " . $bulan,
                'p' => "Temukan berita terkini dan terpecaya di " . getInfo()->title
            ];

            // Menyertakan nama kategori dalam array yang dikompak
            return view('pages.news.arsip', compact('beritas', 'berita_terbaru', 'bulan',  'heading', 'meta'));
        } catch (\Throwable $th) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function year($year)
    {
        try {
            $beritas = Berita::getDataBeritaByYear($year);

            // if (!$beritas) {
            //     return response()->view('errors.404', [], 404);
            // }

            $year = $year;

            $berita_terbaru = Berita::getBeritaTerbaru();


            // if (!$berita_terbaru) {
            //     return response()->view('errors.404', [], 404);
            // }



            $meta = [
                'app_name' => getInfo()->title,
                'title' => 'Berita ' . $year,
                'description' => 'Temukan berita terkini dan informasi terupdate seputar Lampung Selatan. Dapatkan liputan lengkap tentang berbagai kegiatan komunitas, layanan publik, dan inisiatif digital yang memajukan daerah ini. Mari bergabung dalam transformasi digital untuk menciptakan masyarakat yang terhubung dan berdaya saing tinggi',
                'keywords' => 'berita Lampung Selatan, informasi terkini, kegiatan komunitas, layanan publik, inisiatif digital, transformasi digital, masyarakat terhubung, masyarakat berdaya saing',
                'author' => null,
                'thumbnail' => null,
                'published_at' => null,
                'modified_at' => null
            ];

            $heading = [
                'h2' => "Berita Pada Tahun " . $year,
                'p' => "Temukan berita terkini dan terpecaya di " . getInfo()->title
            ];

            // Menyertakan nama kategori dalam array yang dikompak
            return view('pages.news.year', compact('beritas', 'berita_terbaru', 'year',  'heading', 'meta'));
        } catch (\Throwable $th) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (!$keyword || $keyword == ' ') {
            return view('pages.news.search', [
                'keyword' => $keyword,
                'berita' => collect(),
                'categories' => KategoriBerita::withCount('berita')->get(),
                'berita_terbaru' => Berita::getBeritaTerbaru()
            ]);
        }

        $beritas = Berita::searchNews($keyword)->paginate(10)->appends(['keyword' => $keyword]); // <-- Menambahkan keyword ke pagination
        $berita_terbaru = Berita::getBeritaTerbaru();


        $meta = [
            'app_name' => getInfo()->title,
            'title' => 'Search Berita',
            'description' => 'Temukan berita terkini dan informasi terupdate seputar Lampung Selatan. Dapatkan liputan lengkap tentang berbagai kegiatan komunitas, layanan publik, dan inisiatif digital yang memajukan daerah ini. Mari bergabung dalam transformasi digital untuk menciptakan masyarakat yang terhubung dan berdaya saing tinggi',
            'keywords' => 'berita Lampung Selatan, informasi terkini, kegiatan komunitas, layanan publik, inisiatif digital, transformasi digital, masyarakat terhubung, masyarakat berdaya saing',
            'author' => null,
            'thumbnail' => null,
            'published_at' => null,
            'modified_at' => null
        ];

        $heading = [
            'h2' => "Pencarian Berita " . '"' . $keyword . '"',
            'p' => "Temukan berita terkini dan terpecaya di " . getInfo()->title
        ];

        return view('pages.news.search', compact('beritas', 'keyword', 'berita_terbaru',  'heading', 'meta'));
    }

    public function tag(Request $request)
    {
        $tag = $request->input('tag');

        if (!$tag || $tag == ' ') {
            return view('pages.news.tag', [
                'tag' => $tag,
                'berita' => collect(),
                'categories' => KategoriBerita::withCount('berita')->get(),
                'berita_terbaru' => Berita::getBeritaTerbaru()
            ]);
        }

        $beritas = Berita::searchNews($tag)->paginate(10)->appends(['tag' => $tag]);
        $berita_terbaru = Berita::getBeritaTerbaru();



        // if (!$berita_terbaru) {
        //     return response()->view('errors.404', [], 404);
        // }

        $meta = [
            'app_name' => getInfo()->title,
            'title' => 'Tag Berita ' . $tag,
            'description' => 'Temukan berita terkini dan informasi terupdate seputar Lampung Selatan. Dapatkan liputan lengkap tentang berbagai kegiatan komunitas, layanan publik, dan inisiatif digital yang memajukan daerah ini. Mari bergabung dalam transformasi digital untuk menciptakan masyarakat yang terhubung dan berdaya saing tinggi',
            'keywords' => 'berita Lampung Selatan, informasi terkini, kegiatan komunitas, layanan publik, inisiatif digital, transformasi digital, masyarakat terhubung, masyarakat berdaya saing',
            'author' => null,
            'thumbnail' => null,
            'published_at' => null,
            'modified_at' => null
        ];

        $heading = [
            'h2' => "Berita Dengan Tag " . '"' . $tag . '"',
            'p' => "Temukan berita terkini dan terpecaya di " . getInfo()->title
        ];

        return view('pages.news.tag', compact('beritas', 'tag', 'berita_terbaru',  'heading', 'meta'));
    }

    public function getAllUniqueTags()
    {
        $tags = Berita::getAllUniqueTagsPagging();
        return response()->json([
            'data' => $tags->items(),
            'links' => $tags->links()->toHtml(),
        ]);
    }
}
