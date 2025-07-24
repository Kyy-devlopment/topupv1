<?php

use Illuminate\Support\Facades\Route;
use App\Models\Banner;

Route::get('/', function () {
    $banners = Banner::where('is_active', true)->latest()->get();
    return view('index', compact('banners'));
});
