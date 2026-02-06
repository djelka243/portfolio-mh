<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;



Route::get('dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('produits', ProduitController::class);
Route::post('produits/{produit}/images', [ProduitController::class, 'storeImage'])->name('produits.images.store');
Route::delete('images/{image}', [ProduitController::class, 'destroyImage'])->name('images.destroy');
Route::post('produits/sync', [ProduitController::class, 'SyncFromApi'])->name('produits.sync');
Route::resource('categories', CategorieController::class);
Route::post('categories/sync', [CategorieController::class, 'SyncFromApi'])->name('categories.sync');
Route::get('setting', [AdminController::class, 'setting'])->name('setting');






require __DIR__.'/settings.php';
require __DIR__.'/users.php';
