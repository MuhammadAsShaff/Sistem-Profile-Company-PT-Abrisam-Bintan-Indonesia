<?php
use App\Exports\InventoryExport;
use Maatwebsite\Excel\Facades\Excel;
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
use App\Http\Controllers\BlogLandingPage;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\BaganOrganisasiController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PesanProdukController;
use App\Http\Controllers\TentangKamiLandingPage;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SavePreviousUrl;
use App\Http\Middleware\PreventBackHistory;


// Route untuk Landing Page
Route::prefix('/')->group(function () {
    Route::get('/', [LandingPageController::class, 'index'])
        ->name('landingPage.layoutLandingPage');

    Route::get('kontak', [LandingPageController::class, 'tampilKontak'])
        ->name('tampilKontak');

    Route::get('produk', [ProdukLandingPage::class, 'index'])
        ->name('tampilProduk');

    Route::get('/produk/filter', [ProdukLandingPage::class, 'filterByKategori'])->name('produk.filter');

    Route::get('blog', [BlogLandingPage::class, 'index'])
        ->name('tampilBlog');
    Route::get('/blog/search', [BlogLandingPage::class, 'search'])->name('blog.search');

    Route::get('/blog/{slug}', [BlogLandingPage::class, 'isiBlog'])->name('isiBlog');

    Route::get('TentangKami', [LandingPageController::class, 'tampilTentangKami'])
        ->name('tampilTentangKami');

    Route::get('FaQ', [LandingPageController::class, 'tampilFaQ'])
        ->name('tampilFaQ');

    Route::post('produk/pilih', [PesanProdukController::class, 'pilihProduk'])->name('produk.pilih');
    Route::post('showLocation', [PesanProdukController::class, 'showLocation'])->name('showLocation');
    // Menambahkan route untuk halaman pesan produk
    Route::get('pesanProduk', [PesanProdukController::class, 'pesanProduk'])->name('pesanProduk');

    Route::post('/save-location-session', [PesanProdukController::class, 'saveLocationSession']);

    Route::get('isiDataDiri', [PesanProdukController::class, 'isiDataDiri'])->name('isiDataDiri');

    Route::post('simpanAlamat', [PesanProdukController::class, 'simpanAlamat'])->name('simpanAlamat');


    Route::get('selesai', [PesanProdukController::class, 'selesai'])->name('selesai');
});


// Route untuk login dan logout admin
Route::prefix('admin')->group(function () {
    Route::match(['get', 'post'], 'login', [LoginController::class, 'login'])
        ->name('admin.login')
        ->middleware(PreventBackHistory::class); // Middleware untuk mencegah kembali ke halaman login jika sudah login

    Route::post('logout', [LoginController::class, 'logout'])
        ->name('admin.logout')
        ->middleware(PreventBackHistory::class);
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
    Route::prefix('faq')->group(function () {
        Route::get('/', [FaQController::class, 'index'])
            ->name('dashboard.FaQ.FaQ')
            ->middleware(SavePreviousUrl::class);
        Route::post('/store', [FaQController::class, 'store'])->name('faq.store');
        Route::put('/update/{id_faq}', [FaQController::class, 'update'])->name('faq.update');
        Route::delete('/delete/{id_faq}', [FaQController::class, 'destroy'])->name('faq.delete');
        Route::get('/{id_faq}', [FaQController::class, 'show'])->name('faq.show');
    });


    // Route untuk Blog
    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])
            ->name('dashboard.blog.blog')
            ->middleware(SavePreviousUrl::class);
        Route::get('/insert', [BlogController::class, 'insert'])->name('blog.insert');
        Route::post('/store', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/edit/{id_blog}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('/update/{id_blog}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/delete/{id_blog}', [BlogController::class, 'destroy'])->name('blog.delete');
    });


    // Route untuk produk
    Route::prefix('produk')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])
            ->name('dashboard.dataProduk.dataProduk')
            ->middleware(SavePreviousUrl::class);
        Route::post('/store', [ProdukController::class, 'store'])->name('produk.store');
        Route::put('/update/{id_produk}', [ProdukController::class, 'update'])->name('produk.update');
        Route::post('/update-benefit', [ProdukController::class, 'updateBenefit'])->name('produk.updateBenefit');
        Route::delete('/delete/{id_produk}', [ProdukController::class, 'destroy'])->name('produk.delete');
    });

    Route::prefix('TentangKami')->group(function () {
        Route::get('/', [BaganOrganisasiController::class, 'index'])->name('dashboard.tentangKami.layoutTentangKami');
        Route::post('/store', [BaganOrganisasiController::class, 'store'])->name('bagan.store');
        Route::put('/update/{id}', [BaganOrganisasiController::class, 'update'])->name('bagan.update');
        Route::delete('/destroy/{id}', [BaganOrganisasiController::class, 'destroy'])->name('bagan.destroy');
        Route::post('tentangKami/store', [TentangKamiController::class, 'store'])->name('tentangKami.store');
        Route::put('tentangKami/update/{id}', [TentangKamiController::class, 'update'])->name('tentangKami.update');
        Route::delete('tentangKami/delete/{id}', [TentangKamiController::class, 'destroy'])->name('tentangKami.delete');
    });

    //Route Kegiatan
    Route::prefix('tentang-kami/kegiatan')->group(function () {
        Route::post('/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
        Route::put('/update/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
        Route::delete('/delete/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.delete');
    });


    // Route untuk promo
    Route::prefix('promo')->middleware(SavePreviousUrl::class)->group(function () {
        Route::get('/', [PromoController::class, 'index'])->name('dashboard.Promo.Promo');
        Route::post('/store', [PromoController::class, 'store'])->name('promo.store');
        Route::put('/update/{id_promo}', [PromoController::class, 'update'])->name('promo.update');
        Route::delete('/delete/{id_promo}', [PromoController::class, 'destroy'])->name('promo.delete');
    });


    // Route untuk paket
    Route::prefix('paket')->group(function () {
        Route::get('/{id_paket}', [PaketController::class, 'showProdukByPaket'])->name('paket.showProdukByPaket');
        Route::get('/', [PaketController::class, 'index'])
            ->name('dashboard.dataPaket.dataPaket')
            ->middleware(SavePreviousUrl::class);
        Route::post('/store', [PaketController::class, 'store'])->name('paket.store');
        Route::put('/update/{id_paket}', [PaketController::class, 'update'])->name('paket.update');
        Route::delete('/delete/{id_paket}', [PaketController::class, 'destroy'])->name('paket.delete');
    });


    // Route untuk kategori
    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])
            ->name('dashboard.dataKategori.dataKategori')
            ->middleware(SavePreviousUrl::class);
        Route::post('/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::put('/update/{id_kategori}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/delete/{id_kategori}', [KategoriController::class, 'destroy'])->name('kategori.delete');
        Route::get('/{id_kategori}', [KategoriController::class, 'showProdukByKategori'])
            ->name('kategori.showProdukByKategori');
    });




    // Route untuk data user (admin management)
    Route::prefix('datauser')->middleware(SavePreviousUrl::class)->group(function () {
        Route::get('/', [DataUser::class, 'index'])
            ->name('dashboard.dataUser.datauser');

        Route::prefix('admin')->middleware('auth:admin')->group(function () {
            Route::post('/store', [DataUser::class, 'store'])->name('admin.store');
            Route::put('/update/{id}', [DataUser::class, 'update'])->name('admin.update');
            Route::delete('/delete/{id}', [DataUser::class, 'destroy'])->name('admin.delete');
        });
    });

    // Route untuk inventory masuk 
    Route::prefix('inventory')->middleware(SavePreviousUrl::class)->group(function () {
        Route::get('/masuk', [InventoryController::class, 'showInventoryMasuk'])
            ->name('inventoryMasuk');
        Route::get('/keluar', [InventoryController::class, 'showInventoryKeluar'])
            ->name('inventoryKeluar');
        Route::post('/store', [InventoryController::class, 'insertInventoryMasuk'])->name('inventoryMasuk.store');
        Route::post('/stock/store', [InventoryController::class, 'storeStock'])->name('stock.store');
        Route::get('/inventory/{id_inventoryMasuk}/stocks', [InventoryController::class, 'getStocks'])->name('inventory.stocks');
        Route::post('/stock/pindahkan/massal', [InventoryController::class, 'pindahkanProdukMassal'])->name('stock.pindahkan.massal');
        Route::put('/dashboard/inventory/update-inventory-masuk/{id}', [InventoryController::class, 'updateInventoryMasuk'])->name('inventoryMasuk.update');
        Route::delete('/inventory/delete/{id}', [InventoryController::class, 'deleteInventory'])->name('inventory.delete');
        Route::delete('/inventory-keluar/{id}', [InventoryController::class, 'deleteInventoryKeluar'])->name('inventoryKeluar.delete');
        Route::put('/dashboard/inventory/update-inventory-keluar/{id}', [InventoryController::class, 'updateInventoryKeluar'])->name('inventoryKeluar.update');
        Route::post('/stock-pindahkan-keluar', [InventoryController::class, 'pindahkanProdukKeluar'])->name('stock.pindahkan.keluar');
        Route::get('/export-inventory-masuk', function () {
            return Excel::download(new InventoryExport('Masuk'), 'inventory_masuk.xlsx');
        })->name('export.inventoryMasuk');
        Route::get('/export-inventory-keluar', function () {
            return Excel::download(new InventoryExport('Keluar'), 'inventory_keluar.xlsx');
        })->name('export.inventoryKeluar');
    });


    // Route untuk update profile admin
    Route::put('/admin/profile/update/{id}', [DataUser::class, 'updateProfile'])
        ->name('admin.profile.update')
        ->middleware('auth:admin');
});
