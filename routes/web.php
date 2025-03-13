<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ReservasiController;
use App\Http\Middleware\AdministratorMiddleware;
use App\Http\Middleware\PelangganMiddleware;
use Illuminate\Support\Facades\Route;








// Route::get('/', function(){
//     return view('index');
// });

// Route::get('/{view}', function ($view) {
//     if (view()->exists($view)) {
//         return view($view);
//     }
//     abort(404); // Tampilkan error 404 jika view tidak ditemukan
// });

// Route::get('/{folder}/{view}', function ($folder, $view) {
//     $path = $folder . '.' . $view; // Konversi folder/view ke format admin.dashboard
//     if (view()->exists($path)) {
//         return view($path);
//     }
//     abort(404); // Jika view tidak ditemukan
// });

Route::middleware([AdministratorMiddleware::class])->prefix('administrator')->group(function () {
    Route::get('/dashboard', [PageController::class, 'administratorDashboard'])->name('adminDashboard');
    Route::get('/data-pegawai', [PageController::class, 'administratorDataPegawai'])->name('adminaDataPegawai');
    Route::get('/data-event', [PageController::class, 'administratorDataEvent'])->name('adminDataEvent');
    Route::get('/checkout-event', [PageController::class, 'administratorCheckoutEvent'])->name('adminCheckoutEvent');
    Route::get('/tambah-event', function () {return view('admin.tambah-event');})->name('admin.tambah-event');
    Route::post('/store-event', [EventController::class, 'adminStoreEvent'])->name('admin.store-event');
    Route::get('/event/edit/{id}', [EventController::class, 'administratorEdit'])->name('admin.edit-event');
Route::post('/event/update/{id}', [EventController::class, 'administratorUpdate'])->name('admin.update-event');

});
Route::middleware([PelangganMiddleware::class])->group(function () {
    Route::post('/daftar-event', [CheckoutController::class, 'store'])->name('daftar-event');
    Route::get('/invoice-checkout/{id}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::get('/paid-checkout', [CheckoutController::class, 'updateStatus'])->name('checkout.success');
    Route::get('/failed-checkout', [CheckoutController::class, 'failedStatus'])->name('checkout.failed');
    Route::put('/cancelled-checkout/{id}', [CheckoutController::class, 'cancelStatus'])->name('checkout.cancel');
    Route::get('/checkout-history', [PageController::class, 'dataCheckout'])->name('checkout.history');
    Route::get('/reservasi-history', [PageController::class, 'reservasiHistrory'])->name('reservasi.history');
    Route::post('/store-reservasi', [ReservasiController::class, 'storeReservasi'])->name('store-reservasi');
    Route::get('/invoice-reservasi/{id}', [ReservasiController::class, 'show'])->name('reservasi.show');
    Route::get('/reservasi-booking/{reservasi}', [ReservasiController::class, 'booking'])->name('reservasi.booking');
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});
Route::post('/login', [PegawaiController::class, 'login'])->name('post-login');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/logout', [PegawaiController::class, 'logout'])->name('logout');
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/event/{slug}', [PageController::class, 'eventDetail'])->name('event.detail');
Route::get('/reservasi', [PageController::class, 'reservasi'])->name('reservasi');
Route::get('/jadwal-reservasi/{id}', [PageController::class, 'reservasiJadwal'])->name('reservasi-jadwal');
Route::get('/tambah-reservasi/{id}', [PageController::class, 'tambahReservasi'])->name('tambah-reservasi');

