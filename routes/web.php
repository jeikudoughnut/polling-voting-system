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
            Route::get('dashboard-data', [PollController::class, 'adminDashboard'])->name('dashboard.data');
            
            // User management routes
            Route::get('users', [UserController::class, 'getUsers'])->name('users.index');
            Route::post('users', [UserController::class, 'createUser'])->name('users.store');
            Route::put('users/{user}', [UserController::class, 'updateUser'])->name('users.update');
            Route::delete('users/{user}', [UserController::class, 'deleteUser'])->name('users.destroy');
            Route::get('users/stats', [UserController::class, 'getUserStats'])->name('users.stats');
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

    // User poll routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('polls', [PollController::class, 'userIndex'])->name('polls.index');
        Route::get('polls/{poll}', [PollController::class, 'userShow'])->name('polls.show');
        Route::post('polls/{poll}/vote', [PollController::class, 'vote'])->name('polls.vote');
        Route::get('my-votes', [PollController::class, 'myVotes'])->name('polls.my-votes');
        Route::get('my-polls', [PollController::class, 'myPolls'])->name('polls.my-polls');
        Route::post('polls', [PollController::class, 'userStore'])->name('polls.store');
        Route::get('dashboard-data', [PollController::class, 'userDashboard'])->name('dashboard.data');
        
        // Results routes
        Route::get('results', [PollController::class, 'getUserResults'])->name('results');
        Route::get('polls/{poll}/results', [PollController::class, 'getPollResults'])->name('polls.results');
        Route::patch('polls/{poll}/close', [PollController::class, 'closePoll'])->name('polls.close');
        Route::get('polls/{poll}/export/csv', [PollController::class, 'exportCSV'])->name('polls.export.csv');
        Route::get('polls/{poll}/export/pdf', [PollController::class, 'exportPDF'])->name('polls.export.pdf');
    });
});

Route::get('/', function () {
    return view('pages.home');
});
