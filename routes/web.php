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

/**
 * Warga
 */
Route::prefix('warga')->group(function() {
    Route::get('/', function() {
        return view('admin-dashboard.warga.index');
    });
    Route::get('/tambah-warga', function() {
        return view('admin-dashboard.warga.tambah-warga');
    });
    Route::get('/lihat-detil-warga', function() {
        return view('admin-dashboard.warga.lihat-detil-warga');
    });
});

/**
 * Peta
 */
Route::prefix('peta')->group(function() {
    Route::get('/cari-alamat', function() {
        return view('admin-dashboard.warga.cari-alamat');
    });
});

/**
 * Peta - Tanpa Login
 */
Route::get('/cari-alamat', function() {
    return view('front-layout.cari-alamat');
});