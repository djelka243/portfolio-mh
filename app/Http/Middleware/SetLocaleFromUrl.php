<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL; // Import important
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromUrl
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);
    $availableLocales = config('app.available_locales', ['fr', 'en', 'ln']);

    if (in_array($locale, $availableLocales)) {
        App::setLocale($locale);
        Session::put('locale', $locale);
        URL::defaults(['locale' => $locale]);

        // --- ASTUCE ICI ---
        // On retire "locale" des paramètres de la route pour que le contrôleur 
        // ne reçoive que les autres (comme {slug})
        $request->route()->forgetParameter('locale');
        
    } else {
        $locale = Session::get('locale', config('app.locale'));
        App::setLocale($locale);
        URL::defaults(['locale' => $locale]);
    }

        return $next($request);
    }
}