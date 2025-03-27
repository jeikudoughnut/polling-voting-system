<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/register', function () {
    return view('pages.register');
});

Route::get('/admin/main', function () {
    return view('admin/pages/main');
});

Route::get('/user-dashboard', function () {
    return view('pages.user.dashboard');
});