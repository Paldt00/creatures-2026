<?php

use App\Http\Controllers\FishController;
use App\Http\Controllers\PublicAuthController;
use App\Http\Controllers\RegionController;
use App\Models\Region;
use App\Models\Web_Settings;
use Illuminate\Support\Facades\Route;

// HALAMAN UTAMA
Route::get('/', function () {
    $webSetting = Web_Settings::latest('id')->first();
    $regions = Region::latest('id')->get();

    return view('welcome', compact('webSetting', 'regions'));
})->name('home');

// AUTH PUBLIC USER
Route::get('/login', [PublicAuthController::class, 'showLogin'])
    ->name('public.login.form');

Route::post('/login', [PublicAuthController::class, 'login'])
    ->name('public.login');

Route::get('/register', [PublicAuthController::class, 'showRegister'])
    ->name('public.register.form');

Route::post('/register', [PublicAuthController::class, 'register'])
    ->name('public.register');

Route::post('/logout', [PublicAuthController::class, 'logout'])
    ->name('public.logout');

// HALAMAN DETAIL REGION / WILAYAH
Route::get('/region/{slug}', [RegionController::class, 'show'])
    ->name('region.show');

// HALAMAN DETAIL IKAN / CREATURE
Route::get('/fish/{slug}', [FishController::class, 'show'])
    ->name('fish.show');
