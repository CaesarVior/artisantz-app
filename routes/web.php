<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Akses Utama Web Front-End)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home-index');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Public Event
Route::get('/events', [EventController::class, 'publicIndex'])->name('events.index');

/*
|--------------------------------------------------------------------------
| Auth Routes Group (Login & Logout)
|--------------------------------------------------------------------------
*/
$authRoutes = function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
};

/*
|--------------------------------------------------------------------------
| Admin Protected Routes Group (Tanpa Prefix 'admin' di dalam closure)
|--------------------------------------------------------------------------
*/
$adminRoutes = function () {
    // Events -> URL: /event, /event/create, dst.
    Route::get('/event', [EventController::class, 'index'])->name('admin-events');
    Route::get('/event/create', [EventController::class, 'create'])->name('admin-events-create');
    Route::post('/event', [EventController::class, 'store'])->name('admin-events-store');
    Route::get('/event/{id}/edit', [EventController::class, 'edit'])->name('admin-events-edit');
    Route::put('/event/{id}', [EventController::class, 'update'])->name('admin-events-update');
    Route::delete('/event/{id}', [EventController::class, 'destroy'])->name('admin-events-destroy');

    // Users -> URL: /users, /users/create, dst.
    Route::get('/users', [UserController::class, 'index'])->name('admin-users-index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin-users-create');
    Route::post('/users', [UserController::class, 'store'])->name('admin-users-store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin-users-edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin-users-update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin-users-destroy');

    // Roles -> URL: /roles, /roles/create, dst.
    Route::get('/roles', [RoleController::class, 'index'])->name('admin-roles-index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('admin-roles-create');
    Route::post('/roles', [RoleController::class, 'store'])->name('admin-roles-store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('admin-roles-edit');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('admin-roles-update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('admin-roles-destroy');
};

/*
|--------------------------------------------------------------------------
| Environment-Based Domain/Prefix Loading
|--------------------------------------------------------------------------
*/
if (app()->environment('local')) {
    Route::prefix('admin')->group(function () use ($authRoutes, $adminRoutes) {
        $authRoutes();

        Route::middleware(['login'])->group($adminRoutes);
    });
} else {
    Route::domain('admin-artisantz.nivor.id')->group(function () use ($authRoutes, $adminRoutes) {
        Route::get('/', function () {
            return redirect()->route('admin-events');
        });

        $authRoutes();
        Route::middleware(['login'])->group($adminRoutes);
    });
}

require __DIR__.'/auth.php';
