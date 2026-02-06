<?php

use App\Http\Controllers\CommandeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;


Route::get('/language/{locale}', [LanguageController::class, 'switch'])
    ->name('language.switch')
    ->where(['locale' => 'fr|en|ln']); // Sécurité pour n'accepter que tes langues

// 2. Redirection racine vers la langue par défaut
Route::get('/', function () {
    $locale = session('locale', config('app.locale'));
    return redirect("/{$locale}");
});
Route::prefix('{locale}')->where(['locale' => 'fr|en|ln'])->group(function () {

        Route::get('/', [UserController::class, 'accueil'])->name('home');
        Route::get('/collections/{slug}/load-more', [UserController::class, 'loadMore'])->name('collections.loadMore');
        Route::get('/about', [UserController::class, 'about'])->name('about');
        Route::get('/collections', [UserController::class, 'collections'])->name('collections.index');
        Route::get('/accessoires', [UserController::class, 'accessoires'])->name('accessoires.index');
        Route::get('/collections/{slug}', [UserController::class, 'showCollection'])->name('collections.show');
        Route::get('wishlist', [UserController::class, 'wishlist'])->name('wishlist');
        Route::get('produit/detail/{slug}', [UserController::class, 'produitDetail'])->name('produits.detail');
        Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
        Route::get('/politique-cookies', [UserController::class, 'politiqueCookies'])->name('politique.cookies');
        Route::get('/mentions-legales', [UserController::class, 'mentionsLegales'])->name('mentions.legales');
        Route::get('/faq', [UserController::class, 'faq'])->name('faq');

});
