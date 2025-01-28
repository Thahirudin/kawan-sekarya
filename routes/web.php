<?php

use Illuminate\Support\Facades\Route;

Route::get('/{view}', function ($view) {
    if (view()->exists($view)) {
        return view($view);
    }
    abort(404); // Tampilkan error 404 jika view tidak ditemukan
});

