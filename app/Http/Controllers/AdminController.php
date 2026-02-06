<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;

class AdminController extends Controller
{

    public function dashboard()
    {
        $produits = Produit::count();
        $categories = Categorie::count();
        return view('dashboard', compact('produits', 'categories'));
    }



    public function setting()
    {
        return view('setting');
    }
    
}
