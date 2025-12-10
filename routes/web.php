<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/categories/index', [CategoriesController::class, 'index'])->name('categories.index');


Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');

Route::POST('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');

Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');