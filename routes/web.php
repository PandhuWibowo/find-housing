<?php

use Illuminate\Support\Facades\Route;

/**
 * Sign In
 */
Route::get('/signin', function () {
    return view('front-layout.signin');
});

/**
 * Users
 */
Route::prefix('users')->group(function() {
    Route::get('/', function() {
        return view('admin-dashboard.users.index');
    });
});