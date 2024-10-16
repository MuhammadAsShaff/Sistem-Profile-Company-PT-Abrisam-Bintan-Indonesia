<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DataUser;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\Pelanggan;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukLandingPage;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FaQController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SavePreviousUrl;
use App\Http\Middleware\PreventBackHistory; // Middleware untuk mencegah back


// Route untuk Landing Page
Route::prefix('/')->group(function () {
    Route::get('/', [LandingPageController::class, 'index'])
        ->name('landingPage.layoutLandingPage');

    Route::get('kontak', [LandingPageController::class, 'tampilKontak'])
        ->name('tampilKontak');

    Route::get('produk', [ProdukLandingPage::class, 'index'])
        ->name('tampilProduk');


    Route::get('FaQ', [LandingPageController::class, 'tampilFaQ'])
        ->name('tampilFaQ');

});


// Route untuk login dan logout admin
Route::prefix('admin')->group(function () {
    Route::match(['get', 'post'], 'login', [LoginController::class, 'login'])
        ->name('admin.login')
        ->middleware(PreventBackHistory::class); // Middleware untuk mencegah kembali ke halaman login jika sudah login

    Route::post('logout', [LoginController::class, 'logout'])
        ->name('admin.logout')
        ->middleware(PreventBackHistory::class); // Middleware untuk mencegah kembali ke halaman logout jika sudah logout
});

// Route untuk reset password
Route::get('forgot-password', [ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('reset-password-success', [ResetPasswordController::class, 'showSuccessPage'])->name('password.success');


// Route untuk dashboard admin (dilindungi oleh middleware auth:admin)
Route::prefix('dashboard')->middleware(['auth:admin', PreventBackHistory::class])->group(function () {
    // Dashboard utama
    Route::get('/', [Dashboard::class, 'index'])
        ->name('dashboard.dashboard.index')
        ->middleware(SavePreviousUrl::class); // Pasang middleware untuk simpan URL

    // Route untuk data pelanggan
    Route::get('dataPelanggan', [Pelanggan::class, 'index'])
        ->name('dashboard.dataPelanggan.dataPelanggan')
        ->middleware(SavePreviousUrl::class);

    // Route untuk FaQ
    Route::get('FAQ', [FaQController::class, 'index'])
        ->name('dashboard.FaQ.FaQ')
        ->middleware(SavePreviousUrl::class);
    Route::post('/faq/store', [FaQController::class, 'store'])->name('faq.store'); // Menyimpan FaQ baru
    Route::put('/faq/update/{id_faq}', [FaQController::class, 'update'])->name('faq.update'); // Mengupdate FaQ berdasarkan ID
    Route::delete('/faq/delete/{id_faq}', [FaQController::class, 'destroy'])->name('faq.delete'); // Menghapus FaQ berdasarkan ID
    Route::get('/faq/{id_faq}', [FaQController::class, 'show'])->name('faq.show'); // Menampilkan detail FaQ

    // Route untuk Blog
    Route::get('blog', [BlogController::class, 'index'])
        ->name('dashboard.blog.blog')
        ->middleware(SavePreviousUrl::class);
    Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store'); // Menyimpan Blog baru
    Route::put('/blog/update/{id_blog}', [BlogController::class, 'update'])->name('blog.update'); // Mengupdate Blog berdasarkan ID
    Route::delete('/blog/delete/{id_blog}', [BlogController::class, 'destroy'])->name('blog.delete'); // Menghapus Blog berdasarkan ID
    Route::get('/blog/{id_blog}', [BlogController::class, 'show'])->name('blog.show'); // Menampilkan detail Blog

    // Route untuk produk
    Route::get('/produk', [ProdukController::class, 'index'])
        ->name('dashboard.dataProduk.dataProduk')
        ->middleware(SavePreviousUrl::class);
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/produk/update/{id_produk}', [ProdukController::class, 'update'])->name('produk.update');
    Route::post('/produk/update-benefit', [ProdukController::class, 'updateBenefit']);
    Route::delete('/produk/delete/{id_produk}', [ProdukController::class, 'destroy'])->name('produk.delete');


    // Route untuk promo
    Route::get('promo', [PromoController::class, 'index'])
        ->name('dashboard.Promo.Promo')
        ->middleware(SavePreviousUrl::class);
    Route::post('/promo/store', [PromoController::class, 'store'])->name('promo.store');
    Route::put('/promo/update/{id_promo}', [PromoController::class, 'update'])->name('promo.update');
    Route::delete('/promo/delete/{id_promo}', [PromoController::class, 'destroy'])->name('promo.delete');

    // Route untuk paket
    Route::get('paket/{id_paket}/produk', [PaketController::class, 'showProdukByPaket'])->name('paket.showProdukByPaket');
    Route::get('dataPaket', [PaketController::class, 'index'])
        ->name('dashboard.dataPaket.dataPaket')
        ->middleware(SavePreviousUrl::class);
    Route::post('/paket/store', [PaketController::class, 'store'])->name('paket.store');
    Route::put('/paket/update/{id_paket}', [PaketController::class, 'update'])->name('paket.update');
    Route::delete('/paket/delete/{id_paket}', [PaketController::class, 'destroy'])->name('paket.delete');

    // Route untuk kategori
    Route::get('dataKategori', [KategoriController::class, 'index'])
        ->name('dashboard.dataKategori.dataKategori')
        ->middleware(SavePreviousUrl::class);
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/kategori/update/{id_kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/delete/{id_kategori}', [KategoriController::class, 'destroy'])->name('kategori.delete');
    Route::get('/kategori/{id_kategori}/produk', [KategoriController::class, 'showProdukByKategori'])
        ->name('kategori.showProdukByKategori');

    // Route untuk data user (admin management)
    Route::get('datauser', [DataUser::class, 'index'])
        ->name('dashboard.dataUser.datauser')
        ->middleware(SavePreviousUrl::class);
    Route::post('/admin/store', [DataUser::class, 'store'])->name('admin.store');
    Route::put('/admin/update/{id}', [DataUser::class, 'update'])
        ->name('admin.update')
        ->middleware('auth:admin');
    Route::delete('/admin/delete/{id}', [DataUser::class, 'destroy'])->name('admin.delete');

    // Route untuk update profile admin
    Route::put('/admin/profile/update/{id}', [DataUser::class, 'updateProfile'])
        ->name('admin.profile.update')
        ->middleware('auth:admin');
});
