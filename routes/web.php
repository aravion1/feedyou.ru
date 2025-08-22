<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/products/1');
});

Route::get('/products/search/{page}', [\App\Http\Controllers\ProductController::class, 'search']);
Route::get('/products/{page}', [\App\Http\Controllers\ProductController::class, 'listPage'])->name('products');
//Route::get()
