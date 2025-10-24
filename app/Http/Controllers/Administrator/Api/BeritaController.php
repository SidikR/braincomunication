<?php

namespace App\Http\Controllers\administrator\Api;

use App\Models\Berita;
use App\Models\Redaktur;
use App\Models\HeroCarousel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\KategoriBerita;
use App\Http\Controllers\Controller;
use App\Models\BeritaUpdateApi;

class BeritaController extends Controller
{

    public function index()
    {
        // Mendapatkan berita terbaru
        $berita_terbaru = Berita::getBeritaTerbaruApi();

        // Mendapatkan berita yang telah diupdate dari model Berita
        $berita_updated = BeritaUpdateApi::getBeritaUpdated();

        // Jika tidak ada berita terbaru atau berita yang telah diupdate
        if (!$berita_terbaru && empty($berita_updated)) {
            return $this->respondWithError('Tidak ada data berita', null, Response::HTTP_NOT_FOUND);
        }

        // Menyusun data untuk dikirim
        $response = [
            'berita_terbaru' => $berita_terbaru,
            'berita_updated' => $berita_updated,
        ];

        return $this->respondWithSuccess('Data berita berhasil dimuat.', $response);
    }

    public function show($slug)
    {

        try {
            $response = Berita::getBeritaByIdApi($slug);
            return $this->respondWithSuccess('Data berita berhasil dimuat.', $response);
        } catch (\Exception $e) {
            return $this->respondWithError('Berita tidak ditemukan ', null, Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id)
    {
        try {
            // Cari entri berita yang diupdate berdasarkan ID berita
            $beritaUpdateApi = BeritaUpdateApi::where('news_id', $id)->first();

            // Jika entri ditemukan, hapus entri tersebut
            if ($beritaUpdateApi) {
                $beritaUpdateApi->delete();
                return $this->respondWithSuccess('Berita berhasil dihapus dari array berita updated.');
            } else {
                // Jika entri tidak ditemukan, beri respon bahwa berita tidak ditemukan di array berita yang diupdate
                return $this->respondWithError('Berita tidak ditemukan di array berita updated.', null, Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return $this->respondWithError('Terjadi kesalahan saat menghapus berita dari array berita updated.', null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
