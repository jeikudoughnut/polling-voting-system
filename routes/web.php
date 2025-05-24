<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PollController;
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
        // Main admin dashboard routes (backward compatibility)
        Route::get('/admin-dashboard', function () {
            return view('pages.admin.main');
        })->name('admin.dashboard');
        
        Route::get('/admin', function () {
            return view('pages.admin.main');
        });

        // Debug route to test admin access
        Route::get('/admin/test', function () {
            return response()->json([
                'message' => 'Admin access working!',
                'user' => Auth::user()->name,
                'user_type' => Auth::user()->user_type,
                'routes_available' => [
                    'admin_dashboard' => route('admin.dashboard'),
                    'poll_index' => route('admin.polls.index'),
                    'poll_create' => route('admin.polls.create'),
                ]
            ]);
        });

        // Poll management routes with admin prefix
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('polls', PollController::class);
            Route::patch('polls/{poll}/status', [PollController::class, 'updateStatus'])->name('polls.status');
            Route::get('polls-data', [PollController::class, 'getPollsByStatus'])->name('polls.data');
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
