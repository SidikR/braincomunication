<?php

use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KenapaController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\UnitUsahaController;
use App\Http\Controllers\ProfilKamiController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\PesanControllerClient;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\Siswa\ReportController;
use App\Http\Controllers\Administrator\HeroController;
use App\Http\Controllers\Administrator\InfoController;
use App\Http\Controllers\Administrator\UserController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\Administrator\AboutController;
use App\Http\Controllers\Administrator\PesanController;
use App\Http\Controllers\Administrator\PhotoController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Administrator\BeritaController;
use App\Http\Controllers\Administrator\BidangController;
use App\Http\Controllers\Administrator\GalleryController;
use App\Http\Controllers\Administrator\LayananController;
use App\Http\Controllers\Administrator\PejabatController;
use App\Http\Controllers\Administrator\ProfileController;
use App\Http\Controllers\Administrator\RedakturController;
use App\Http\Controllers\Administrator\RoleUserController;
use App\Http\Controllers\Administrator\TokenApiController;
use App\Http\Controllers\Administrator\DashboardController;
use App\Http\Controllers\Role\Siswa\LaporanSiswaController;
use App\Http\Controllers\Role\Siswa\JadwalBelajarController;
use App\Http\Controllers\Administrator\FileManagerController;
use App\Http\Controllers\Administrator\GaleriVideoController;
use App\Http\Controllers\Role\Siswa\DashboardControllerSiswa;
use App\Http\Controllers\Role\StafPengajar\LaporanController;
use App\Http\Controllers\StafAdministrasi\UserControllerSiswa;
use App\Http\Controllers\Administrator\HomepageSetupController;
use App\Http\Controllers\Administrator\PejabatDetailController;
use App\Http\Controllers\Administrator\KategoriBeritaController;
use App\Http\Controllers\Role\Siswa\JadwalBelajarUserController;
use App\Http\Controllers\Administrator\KategoriGalleryController;
use App\Http\Controllers\AboutController as AboutControllerClient;
use App\Http\Controllers\StafAdministrasi\MataPelajaranController;
use App\Http\Controllers\Administrator\HeroCarouselPromoController;
use App\Http\Controllers\BeritaController as BeritaControllerClient;
use App\Http\Controllers\BidangController as BidangControllerClient;
use App\Http\Controllers\PejabatController as PejabatControllerClient;
use App\Http\Controllers\StafAdministrasi\UserControllerStafAdministrasi;
use App\Http\Controllers\Role\StafPengajar\DashboardControllerStafPengajar;
use App\Http\Controllers\Role\StafPengajar\JadwalBelajarPengajarController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\StafAdministrasi\DashboardControllerStafAdministrasi;
use App\Http\Controllers\StafAdministrasi\JadwalBelajarControllerStafAdministrasi;
use App\Http\Controllers\StafAdministrasi\MateriPembelajaranControllerStafAdministrasi;
use App\Http\Controllers\Administrator\ProgramController as AdministratorProgramController;
use App\Http\Controllers\Administrator\TestimoniController as AdministratorTestimoniController;
use App\Http\Controllers\Administrator\ProfilKamiController as AdministratorProfilKamiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/layanan', [ServiceController::class, 'index'])->name('layanan.index');
Route::get('/layanan/{slug}', [ServiceController::class, 'detail'])->name('layanan.detail');
Route::get('/program', [ProgramController::class, 'index'])->name('program.index');
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
Route::get('/program/{slug}', [ProgramController::class, 'detail'])->name('program.detail');
Route::get('/pejabat', [PejabatControllerClient::class, 'index'])->name('pejabat.index');

Route::get('/berita', [BeritaControllerClient::class, 'index'])->name('berita.index');
Route::get('/berita/kategori/{categori}', [BeritaControllerClient::class, 'category'])->name('berita.category');
Route::get('/berita/search', [BeritaControllerClient::class, 'search'])->name('berita.search');
Route::get('/berita/tag', [BeritaControllerClient::class, 'tag'])->name('berita.tag');
Route::get('/berita/year={year}', [BeritaControllerClient::class, 'year'])->name('berita.year');
Route::get('/berita/arsip/{bulanTahun}', [BeritaControllerClient::class, 'arsipBerita'])->name('berita.arsip');
Route::get('/berita/{slug}', [BeritaControllerClient::class, 'detail'])->name('berita.detail');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/about', [AboutControllerClient::class, 'index'])->name('about.index');
Route::get('/tentang_kami', [TentangKamiController::class, 'index'])->name('tentang_kami.index');

Route::post('pesan', [PesanControllerClient::class, 'store'])->name('pesan.store');

Route::get('/bidang', [BidangControllerClient::class, 'index'])->name('bidang.index');
Route::get('bidang/{slug}', [BidangControllerClient::class, 'detail'])->name('bidang.detail');
Route::get('/tags', [BeritaControllerClient::class, 'getAllUniqueTags'])->name('tags');

Route::prefix('dashboard')->middleware(['auth', 'verified'])->name('dashboard.')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/profile', [ProfileUserController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileUserController::class, 'update'])->name('profile.update');

    Route::middleware(['match.role'])->group(function () {

        Route::prefix('administrator')->name('administrator.')->group(function () {
            Route::get('/tentang_kami/profil_kami', [AdministratorProfilKamiController::class, 'index'])->name('tentang_kami.profil_kami.index');
            Route::put('/tentang_kami/profil_kami', [AdministratorProfilKamiController::class, 'update'])->name('tentang_kami.profil_kami.update');
            Route::get('/tentang_kami/sejarah', [SejarahController::class, 'index'])->name('tentang_kami.sejarah.index');
            Route::put('/tentang_kami/sejarah', [SejarahController::class, 'update'])->name('tentang_kami.sejarah.update');
            Route::get('/tentang_kami/struktur_organisasi', [StrukturOrganisasiController::class, 'index'])->name('tentang_kami.struktur_organisasi.index');
            Route::put('/tentang_kami/struktur_organisasi', [StrukturOrganisasiController::class, 'update'])->name('tentang_kami.struktur_organisasi.update');
            Route::get('/tentang_kami/unit_usaha', [UnitUsahaController::class, 'index'])->name('tentang_kami.unit_usaha.index');
            Route::put('/tentang_kami/unit_usaha', [UnitUsahaController::class, 'update'])->name('tentang_kami.unit_usaha.update');
            Route::get('/tentang_kami/penghargaan', [PenghargaanController::class, 'index'])->name('tentang_kami.penghargaan.index');
            Route::put('/tentang_kami/penghargaan', [PenghargaanController::class, 'update'])->name('tentang_kami.penghargaan.update');

            Route::get('/', [DashboardController::class, 'index'])->name('index');
            Route::get('/homepage-setup', [HomepageSetupController::class, 'index'])->name('homepage-setup');
            Route::get('/hero-promo', [HomepageSetupController::class, 'heroPromo'])->name('hero-promo');
            Route::post('/hero', [HeroController::class, 'store'])->name('hero.store');
            Route::post('/hero/{id}', [HeroController::class, 'update'])->name('hero.update');
            Route::delete('/hero/{id}', [HeroController::class, 'delete'])->name('hero.delete');

            Route::post('/hero_promo', [HeroCarouselPromoController::class, 'store'])->name('hero_promo.store');
            Route::post('/hero_promo/{id}', [HeroCarouselPromoController::class, 'update'])->name('hero_promo.update');
            Route::delete('/hero_promo/{id}', [HeroCarouselPromoController::class, 'delete'])->name('hero_promo.delete');

            Route::resource('layanan', LayananController::class);
            Route::resource('berita', BeritaController::class);
            Route::resource('user', UserController::class);
            Route::get('/user/update_password/{id}', [UserController::class, 'updatePassword'])->name('user.update_password');
            Route::put('/user/update_password/{id}', [UserController::class, 'updatePasswordValue'])->name('user.update_password_value');
            Route::put('/user/status_akun/{id}', [UserController::class, 'statusAkun'])->name('user.status_akun');

            Route::resource('profile', ProfileController::class);
            Route::get('/profile/update_password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.update_password');
            Route::put('/profile/update_password/{id}', [ProfileController::class, 'updatePasswordValue'])->name('profile.update_password_value');

            Route::resource('role_user', RoleUserController::class);
            Route::get('/berita/preview/{slug}', [BeritaController::class, 'preview'])->name('berita.preview');
            Route::put('/berita/publish/{slug}', [BeritaController::class, 'publish'])->name('berita.publish');
            Route::put('/berita/unpublish/{slug}', [BeritaController::class, 'unpublish'])->name('berita.unpublish');
            Route::get('/trash/berita', [BeritaController::class, 'trash'])->name('berita.trash');
            Route::put('/berita/restore/{slug}', [BeritaController::class, 'restoreFromTrash'])->name('berita.restore');
            Route::delete('/berita/permanent-delete/{slug}', [BeritaController::class, 'deletePermanently'])->name('berita.permanent-delete');

            Route::resource('kategori', KategoriBeritaController::class);
            Route::resource('redaktur', RedakturController::class);
            Route::resource('galeri', GalleryController::class)->parameters([
                'galeri' => 'ulid'
            ]);
            Route::resource('galeri-video', GaleriVideoController::class);
            Route::resource('kategori-galeri', KategoriGalleryController::class);
            Route::resource('pejabat', PejabatController::class);
            Route::resource('program', AdministratorProgramController::class);
            Route::resource('fasilitas', FasilitasController::class);
            Route::resource('kenapa', KenapaController::class);
            Route::resource('testimoni', AdministratorTestimoniController::class);
            Route::get('/pejabat-content/{id}', [PejabatDetailController::class, 'edit'])->name('pejabat-content.edit');
            Route::put('/pejabat-content/{id}', [PejabatDetailController::class, 'update'])->name('pejabat-content.update');
            Route::resource('bidang', BidangController::class);
            Route::resource('about', AboutController::class);
            Route::resource('info', InfoController::class);
            Route::resource('pesan', PesanController::class);
            Route::get('file-manager', [FileManagerController::class, 'index'])->name('file-manager.index');
            Route::resource('token-generator', TokenApiController::class);
        });
        Route::prefix('staf_administrasi')->name('staf_administrasi.')->group(function () {
            Route::get('/', [DashboardControllerStafAdministrasi::class, 'index'])->name('index');
            Route::get('/laporan-mengajar/export', [DashboardControllerStafAdministrasi::class, 'export'])->name('laporan.export');
            Route::resource('staf_pengajar', UserControllerStafAdministrasi::class);
            Route::get('/staf_pengajar/update_password/{id}', [UserControllerStafAdministrasi::class, 'updatePassword'])->name('staf_pengajar.update_password');
            Route::put('/staf_pengajar/update_password/{id}', [UserControllerStafAdministrasi::class, 'updatePasswordValue'])->name('staf_pengajar.update_password_value');
            Route::put('/staf_pengajar/status_akun/{id}', [UserControllerStafAdministrasi::class, 'statusAkun'])->name('staf_pengajar.status_akun');


            Route::resource('siswa', UserControllerSiswa::class);
            Route::get('/siswa/update_password/{id}', [UserControllerSiswa::class, 'updatePassword'])->name('siswa.update_password');
            Route::put('/siswa/update_password/{id}', [UserControllerSiswa::class, 'updatePasswordValue'])->name('siswa.update_password_value');
            Route::put('/siswa/status_akun/{id}', [UserControllerSiswa::class, 'statusAkun'])->name('siswa.status_akun');







            Route::resource('mata_pelajaran', MataPelajaranController::class);
            Route::resource('materi_pembelajaran', MateriPembelajaranControllerStafAdministrasi::class);

            Route::resource('jadwal_belajar', JadwalBelajarControllerStafAdministrasi::class);
            Route::get('/jadwal_belajar/teacher', [JadwalBelajarControllerStafAdministrasi::class, 'listTeacherSchedule'])->name('jadwal_belajar.pengajar.index');
            // Route::get('/jadwal_belajar/pengajar/{id}', [JadwalBelajarControllerStafAdministrasi::class, 'showTeacherSchedule'])->name('jadwal_belajar.pengajar.list');
            Route::get('/jadwal_belajar/siswa', [JadwalBelajarControllerStafAdministrasi::class, 'listStudentSchedule'])->name('jadwal_belajar.siswa.list');
            // Route::get('/jadwal_belajar/siswa/{id}', [JadwalBelajarControllerStafAdministrasi::class, 'showStudentSchedule'])->name('jadwal_belajar.siswa.list');

            Route::resource('profile', ProfileController::class);
            Route::get('/profile/update_password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.update_password');
            Route::put('/profile/update_password/{id}', [ProfileController::class, 'updatePasswordValue'])->name('profile.update_password_value');
        });
        Route::prefix('staf_pengajar')->name('staf_pengajar.')->group(function () {
            Route::get('/', [DashboardControllerStafPengajar::class, 'index'])->name('index');

            Route::get('jadwal_belajar', [JadwalBelajarPengajarController::class, 'index'])->name('jadwal_belajar.index');
            Route::get('jadwal_belajar/penilaian/{jadwalBelajarId}', [JadwalBelajarPengajarController::class, 'penilaian'])->name('jadwal_belajar.penilaian');
            Route::post('jadwal_belajar/nilai/{jadwalBelajarId}', [JadwalBelajarPengajarController::class, 'store'])->name('jadwal_belajar.store');
            Route::post('jadwal_belajar/updateKeterangan/{jadwalBelajarId}', [JadwalBelajarPengajarController::class, 'updateKeterangan'])->name('jadwal_belajar.updateKeterangan');

            Route::get('jadwal_belajar/kehadiran/{jadwalBelajarId}', [JadwalBelajarPengajarController::class, 'kehadiran'])->name('jadwal_belajar.kehadiran');
            Route::post('jadwal_belajar/kehadiran/{jadwalBelajarId}', [JadwalBelajarPengajarController::class, 'storeKehadiran'])->name('jadwal_belajar.kehadiran.store');

            Route::get('jadwal_belajar/laporan/{jadwalBelajarId}', [JadwalBelajarPengajarController::class, 'laporan'])->name('jadwal_belajar.laporan');
            Route::get('jadwal_belajar/pdf/{jadwalBelajarId}', [JadwalBelajarPengajarController::class, 'generateLaporanPDF'])->name('jadwal_belajar.pdf');

            Route::get('laporan/export-bulanan', [LaporanController::class, 'exportBulanan'])
                ->name('laporan.export_bulanan');


            Route::resource('profile', ProfileController::class);
            Route::get('/profile/update_password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.update_password');
            Route::put('/profile/update_password/{id}', [ProfileController::class, 'updatePasswordValue'])->name('profile.update_password_value');
        });
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [UserDashboardController::class, 'index'])->name('index');
        });
        Route::prefix('siswa')->name('siswa.')->group(function () {
            Route::get('/', [DashboardControllerSiswa::class, 'index'])->name('index');
            Route::get('/laporan/export', [ReportController::class, 'exportPdf'])
                ->name('laporan.export');

            Route::get('laporan/export-bulanan', [LaporanSiswaController::class, 'exportBulanan'])
                ->name('laporan.export_bulanan');

            Route::resource('jadwal_belajar', JadwalBelajarUserController::class);

            Route::get('jadwal_belajar', [JadwalBelajarController::class, 'index'])->name('jadwal_belajar.index');
            // Route::get('jadwal_belajar/penilaian/{jadwalBelajarId}', [JadwalBelajarController::class, 'penilaian'])->name('jadwal_belajar.penilaian');

            Route::post('jadwal_belajar/nilai/{jadwalBelajarId}', [JadwalBelajarController::class, 'store'])->name('jadwal_belajar.nilai.store');
            Route::post('jadwal_belajar/updateKeterangan/{jadwalBelajarId}', [JadwalBelajarController::class, 'updateKeterangan'])->name('jadwal_belajar.updateKeterangan');

            // Route::get('jadwal_belajar/kehadiran/{jadwalBelajarId}', [JadwalBelajarController::class, 'kehadiran'])->name('jadwal_belajar.kehadiran');

            Route::post('jadwal_belajar/kehadiran/{jadwalBelajarId}', [JadwalBelajarController::class, 'storeKehadiran'])->name('jadwal_belajar.kehadiran.store');

            Route::get('jadwal_belajar/laporan/{jadwalBelajarId}', [JadwalBelajarController::class, 'laporan'])->name('jadwal_belajar.laporan');
            Route::get('jadwal_belajar/detail/{jadwalBelajarId}', [JadwalBelajarController::class, 'detail'])->name('jadwal_belajar.detail');

            Route::get('jadwal_belajar/pdf/{jadwalBelajarId}', [JadwalBelajarController::class, 'generateLaporanPDF'])->name('jadwal_belajar.pdf');

            Route::resource('profile', ProfileController::class);
            Route::get('/profile/update_password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.update_password');
            Route::put('/profile/update_password/{id}', [ProfileController::class, 'updatePasswordValue'])->name('profile.update_password_value');
        });
    });
});

require __DIR__ . '/auth.php';
