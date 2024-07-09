<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('layout.layout');
});

Route::get('/category',[CategoryController::class, 'index'])->name('category.index');
Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
Route::post('/category/update/{id}',[CategoryController::class, 'update'])->name('category.update');
route::delete('/category/destroy/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
