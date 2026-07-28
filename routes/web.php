<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
});

Route::get('/gallery', [GalleryController::class, 'index']);

// Route::get('/admin', [AdminController::class, 'index']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login']);

if (
    app()->environment('local') ||
    request()->getHost() === 'admin-artisantz.nivor.id'
) {
    Route::view('/login', 'auth.login')->name('login');
}

$adminRoutes = function () {
    Route::view('/', 'admin.pages.events.index')->name('admin-dashboard');
    Route::view('/event', 'admin.pages.events.index')->name('admin-events');
    Route::view('/event/create', 'admin.pages.events.create')->name('admin-events-create');
    Route::get('/event/update/{event_id}', fn ($event_id) => view('admin.pages.events.update', ['event_id' => $event_id]))->name('admin-events-update');

    Route::view('/users', 'admin.pages.users.index')->name('admin-users');
    Route::view('/users/create', 'admin.pages.users.create')->name('admin-users-create');
    Route::get('/users/update/{user_id}', fn ($user_id) => view('admin.pages.users.update', ['user_id' => $user_id]))->name('admin-users-update');

    Route::view('/roles', 'admin.pages.roles.index')->name('admin-roles');
    Route::view('/roles/create', 'admin.pages.roles.create')->name('admin-roles-create');
    Route::get('/roles/update/{role_id}', fn ($role_id) => view('admin.pages.roles.update', ['role_id' => $role_id]))->name('admin-roles-update');

    Route::view('/register', 'auth.register')->name('register');
};

// if (app()->environment('local')) {
//     Route::prefix('admin')->middleware(['login'])->group($adminRoutes);
// } else {
//     Route::domain('admin-adiloka-language.nivor.id')->group(function () use ($adminRoutes) {
//         Route::get('/', function () {
//             return redirect('/login');
//         });
//         Route::prefix('admin')->middleware(['login'])->group($adminRoutes);
//     });
// }

if (app()->environment('local')) {
    Route::prefix('admin')->group($adminRoutes);
} else {
    Route::domain('admin-adiloka-language.nivor.id')->group(function () use ($adminRoutes) {
        Route::get('/', function () {
            return redirect('/login');
        });
        Route::prefix('admin')->group($adminRoutes);
    });
}

require __DIR__.'/auth.php';

// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
// Route::post('/register', [AuthController::class, 'register']);

// Route::get('/event', [EventController::class, 'index'])->name('events.index');
// Route::get('/event/{event}', [EventController::class, 'show'])->name('events.show');

// Route::middleware('auth')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
//     Route::resource('events', EventController::class)->except(['index', 'show']);
// });
