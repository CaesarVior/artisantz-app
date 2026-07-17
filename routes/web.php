<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
});

Route::get('/gallery', [GalleryController::class, 'index']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/event', function () {
    return view('event');
});
Route::get('/login', function () {
    return view('login');
});

Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/roles', function () {
    return view('admin.roles');
});


require __DIR__.'/auth.php';
