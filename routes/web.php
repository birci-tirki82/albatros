<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\JournalController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PublisherController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WriterController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\DetailController;
use App\Http\Controllers\Frontend\FavoriteController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;





Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('user-login', [HomeController::class, 'loginFront'])->name('user-login');
Route::get('user-register', [HomeController::class, 'registerFront'])->name('user-register');

Route::get('hesabim', [AccountController::class, 'account'])->name('hesabim');
Route::post('profil-guncelle', [AccountController::class, 'userUpdate'])->name('profil-guncelle');

Route::get('siparis-gecmisi', [AccountController::class, 'orderHistory'])->name('siparis-gecmisi');

Route::resource('adres', AddressController::class);

//Route::get('adreslerim', [AccountController::class, 'address'])->name('adreslerim');
//Route::get('adres-ekle', [AccountController::class, 'addAddress'])->name('adres-ekle');
//Route::post('adres-ekle', [AccountController::class, 'storeAddress'])->name('adres-ekle');
//Route::get('adres-sil/{id}', [AccountController::class, 'removeAddress'])->name('adres-sil');

Route::get('sepet', [CartController::class, 'cart'])->name('sepet');
Route::get('sepete-ekle/{id}', [CartController::class, 'add'])->name('sepete-ekle');
Route::get('arttir/{id}', [CartController::class, 'plus'])->name('arttir');
Route::get('azalt/{id}', [CartController::class, 'minus'])->name('azalt');
Route::get('sil/{id}', [CartController::class, 'remove'])->name('sil');

Route::get('favori', [FavoriteController::class, 'favorite'])->name('favori');
Route::get('favorilere-ekle/{id}', [FavoriteController::class, 'add'])->name('favorilere-ekle');
Route::get('favoriden-sil/{id}', [FavoriteController::class, 'remove'])->name('favoriden-sil');

Route::get('odeme', [CartController::class, 'checkout'])->name('odeme');
Route::post('siparisi-tamamla', [PaymentController::class, 'payment'])->name('siparisi-tamamla');

Route::get('sartlar-kosullar', [PaymentController::class, 'sartlarKosullar'])->name('sartlar-kosullar');


Route::get('geri-don', function () {
    return redirect()->to('odeme');
})->name('back');


//Route::get('kitaplar', [ProductsController::class, 'products'])->name('kitaplar');
//Route::get('dergiler', [ProductsController::class, 'products'])->name('dergiler');


//Route::get('/admin', function () {
//    return Inertia::render('Backend/HomeView');
//})->middleware(['auth', 'admin', 'verified'])->name('admin');


Route::middleware(['auth', 'admin', 'verified'])->prefix('admin')->group(function () {

    Route::get('admin', [BackendController::class, 'index'])->name('admin');

    Route::resource('category', CategoryController::class);
    Route::resource('writer', WriterController::class);
    Route::resource('book', BookController::class);
    Route::resource('journal', JournalController::class);
    Route::resource('publisher', PublisherController::class);
    Route::resource('user', UserController::class);



    Route::get('siparisler', [OrderController::class, 'index'])->name('siparisler');
    Route::get('siparis-detayi/{id}', [OrderController::class, 'edit'])->name('siparis-detayi');

    Route::get('sifre-degistir', [UserController::class, 'sifreDegistir'])->name('sifre-degistir');

});


//Route::get('kategori/{tur}/{id}', [ProductsController::class, 'categoryProducts'])->name('kategori');
Route::get('kategori/{cat}', [ProductsController::class, 'categoryProducts'])->name('kategori');
//Route::get('{type}/{slug}/{id}', [DetailController::class, 'index'])->name('kitap||dergi');
Route::get('{slug}/{id}', [DetailController::class, 'index'])->name('urun');
//Route::get('{type}/{slug}/{id}', [DetailController::class, 'index'])->name('dergi');



require __DIR__.'/auth.php';
