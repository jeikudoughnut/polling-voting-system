<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/register', [UserController::class, 'showRegister'])->name('register');
    Route::post('/register', [UserController::class, 'register']);
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Admin routes - use the full class name instead of the alias
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/admin-dashboard', function () {
            return view('pages.admin.main');
        })->name('admin.dashboard');
        
        Route::get('/admin', function () {
            return view('pages.admin.main');
        });
    });

    // User routes
    Route::get('/user-dashboard', function () {
        return view('pages.user.main');
    })->name('user.dashboard');
    
    // Debug route to check user authentication status
    Route::get('/check-user', function () {
        return response()->json([
            'is_authenticated' => \Illuminate\Support\Facades\Auth::check(),
            'user' => \Illuminate\Support\Facades\Auth::user(),
            'user_type' => \Illuminate\Support\Facades\Auth::user()->user_type,
            'is_admin' => \Illuminate\Support\Facades\Auth::user()->user_type === 'admin'
        ]);
    });
});

Route::get('/', function () {
    return view('pages.home');
});
