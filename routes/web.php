<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/register', function () {
    return view('pages.register');
});

Route::get('/admin', function () {
    return view('pages.admin.main');
});

Route::get('/user-dashboard', function () {
    return view('pages.user.main');
});
