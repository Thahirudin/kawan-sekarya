<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ReservasiController;
use App\Http\Middleware\AdministratorMiddleware;
use App\Http\Middleware\PelangganMiddleware;
use Illuminate\Http\Request;
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
    Route::get('/tambah-event', function () {
        return view('admin.tambah-event');
    })->name('admin.tambah-event');
    Route::post('/store-event', [EventController::class, 'adminStoreEvent'])->name('admin.store-event');
    Route::get('/event/edit/{id}', [EventController::class, 'administratorEdit'])->name('admin.edit-event');
    Route::put('/event/update/{id}', [EventController::class, 'administratorUpdate'])->name('admin.update-event');
    Route::delete('/event/delete/{id}', [EventController::class, 'administratorDestroy'])->name('admin.delete-event');
    Route::post('store-pegawai', [PegawaiController::class, 'store'])->name('admin.store-pegawai');
    Route::put('update-pegawai/{id}', [PegawaiController::class, 'update'])->name('admin.update-pegawai');
    Route::delete('delete/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('admin.delete-pegawai');
    Route::get('/data-reservasi', [PageController::class, 'administratorDataReservasi'])->name('admin.data-reservasi');

});
Route::middleware([PelangganMiddleware::class])->group(function () {
    Route::post('/daftar-event', [CheckoutController::class, 'store'])->name('daftar-event');
    Route::get('/invoice-checkout/{id}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::get('/paid-checkout', [CheckoutController::class, 'updateStatus'])->name('checkout.status');
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
    Route::put('/update-profil', [PelangganController::class, 'update'])->name('update-profil');
});
Route::post('/login', [PegawaiController::class, 'login'])->name('post-login');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/daftar', function () {
    return view('register');
})->name('daftar');
Route::post('/store-pelanggan', [PelangganController::class, 'store'])->name('store-pelanggan');
Route::post('/logout', [PegawaiController::class, 'logout'])->name('logout');
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/event/{slug}', [PageController::class, 'eventDetail'])->name('event.detail');
Route::get('/reservasi', [PageController::class, 'reservasi'])->name('reservasi');
Route::get('/jadwal-reservasi/{id}', [PageController::class, 'reservasiJadwal'])->name('reservasi-jadwal');
Route::get('/tambah-reservasi/{id}', [PageController::class, 'tambahReservasi'])->name('tambah-reservasi');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about-us');
Route::get('/events', [PageController::class, 'event'])->name('event');
Route::post('/upload-image', function (Request $request) {
    $request->validate([
        'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $file = $request->file('upload');
    $filename = time() . '-' . $file->getClientOriginalName();
    $file->move(public_path('uploads/event'), $filename); // Simpan di public/uploads/event

    return response()->json([
        'url' => asset('uploads/event/' . $filename) // Kirim URL ke CKEditor
    ]);
});
