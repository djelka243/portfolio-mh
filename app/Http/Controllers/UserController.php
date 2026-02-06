<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Categorie;
use App\Models\Produit;

class UserController extends Controller
{



    public function accueil()
    {

        $categories = Categorie::paginate(3);
        $produits = Produit::paginate(8);

        return view('users.accueil', compact('categories', 'produits'));
    }
    public function loadMore(Request $request, $slug)
    {
        try {
            // Trouver la catégorie par slug
            $categorie = Categorie::where('slug', $slug)->firstOrFail();

            $offset = (int) $request->input('offset', 0);
            $limit = 8;

            $produits = Produit::where('categorie_id', $categorie->id)
                ->with('images')
                ->skip($offset)
                ->take($limit)
                ->get();

            $totalProduits = Produit::where('categorie_id', $categorie->id)->count();
            $hasMore = ($offset + $limit) < $totalProduits;

            return response()->json([
                'success' => true,
                'produits' => $produits->map(function ($produit) {
                    return [
                        'id' => $produit->id,
                        'name' => $produit->name,
                        'slug' => $produit->slug,
                        'price' => (float) $produit->price,
                        'reduction' => $produit->reduction,
                        'image' => $produit->images->first()?->url ?? 'placeholder.jpg',
                        'url' => route('produits.detail', $produit->slug)

                    ];
                }),
                'hasMore' => $hasMore,
                'newOffset' => $offset + $limit
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function showCollection($slug)
    {
        // Chercher par slug au lieu de l'ID
        $categorie = Categorie::where('slug', $slug)
            ->with(['produits.images'])
            ->firstOrFail();
        return view('users.collection-show', compact('categorie'));
    }
  
    public function about()
    {
        $response = Http::get(config('services.api_mh.base_url') . '/infos');

        if ($response->failed()) {
            abort(500, 'Erreur API');
        }
        $infos = $response->json('data');
        return view('users.about', compact('infos'));
    }
    public function collections()
    {
        $categories = Categorie::whereHas('produits')
            ->withCount('produits')
            ->get();

        foreach ($categories as $categorie) {
            $categorie->load(['produits' => function ($query) {
                $query->with('images')->limit(8);
            }]);
        }
        return view('users.collections', compact('categories'));
    }
    public function accessoires()
    {
        $accessoires = Produit::whereHas('categorie', function ($query) {
            $query->where('name', 'accessoires');
        })->paginate(8);

        return view('users.accessoires', compact('accessoires'));
    }

    public function produitDetail($slug)
    {


        $produit = Produit::where('slug', $slug)
            ->with(['images', 'categorie'])
            ->firstOrFail();
        return view('users.produit-detail', compact('produit'));
    }
    public function wishlist()
    {
        return view('wishlist');
    }

    public function politiqueCookies()
    {
        return view('users.cookies-policy');
    }
    public function mentionsLegales()
    {
        return view('users.mentions-legales');
    }
    public function faq()
    {
        return view('users.faq');
    }
}
