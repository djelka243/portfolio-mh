<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        $availableLocales = config('app.available_locales', ['fr', 'en', 'ln']);

        if (in_array($locale, $availableLocales)) {
            Session::put('locale', $locale);
            
            $previousUrl = url()->previous(); 
            
            $path = parse_url($previousUrl, PHP_URL_PATH);
            
            $segments = explode('/', trim($path, '/'));
            
            if (isset($segments[0]) && in_array($segments[0], $availableLocales)) {
                $segments[0] = $locale;
            } else {
                array_unshift($segments, $locale);
            }
            
            $newPath = '/' . implode('/', $segments);
            
            return redirect($newPath);
        }
        
        return redirect()->back();
    }
}