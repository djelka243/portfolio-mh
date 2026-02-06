<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\ImageProduit;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::paginate(15);
        $categories = Categorie::select('id', 'name')->get();
        return view('produit', compact('produits', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'price' => 'required|numeric',
            'categorie_id' => 'required|integer|exists:categories,id',
        ]);


        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'categorie_id' => $request['categorie_id'],
        ];

        $produit = Produit::create($data);

        if ($request->hasFile('image')) {
            $originalName = str_replace(' ', '_', $request->name);
            $timestamp = now()->format('Ymd_His');
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $originalName . '_' . $timestamp . '.' . $extension;

            $path = $request->file('image')->storeAs('produitimages', $fileName, 'public');
            
            ImageProduit::create([
                'produit_id' => $produit->id,
                'url' => $path,
                'description' => 'Image principale',
            ]);
        }

        return redirect()->back()->with('success', 'Produit ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produit = Produit::with('images', 'categorie')->findOrFail($id);
        $categories = Categorie::select('id', 'name')->get();
        return view('produitshow', compact('produit', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Store image for product
     */
    public function storeImage(Request $request, string $produitId)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'string|max:255',
        ]);

        $produit = Produit::findOrFail($produitId);
        
        if ($request->hasFile('image')) {
            $originalName = str_replace(' ', '_', $produit->name);
            $timestamp = now()->format('Ymd_His');
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $originalName . '_' . $timestamp . '.' . $extension;

            $path = $request->file('image')->storeAs('produitimages', $fileName, 'public');
            
            ImageProduit::create([
                'produit_id' => $produit->id,
                'url' => $path,
                'description' => $request->description ?? 'Image ajoutée',
            ]);
        }

        return redirect()->back()->with('success', 'Image ajoutée avec succès');
    }

    /**
     * Delete image
     */
    public function destroyImage(string $imageId)
    {
        $image = ImageProduit::findOrFail($imageId);
        $produitId = $image->produit_id;
        
        // Supprimer le fichier
        if (file_exists(storage_path('app/public/' . $image->url))) {
            unlink(storage_path('app/public/' . $image->url));
        }
        
        $image->delete();
        return redirect()->back()->with('success', 'Image supprimée avec succès');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produit = Produit::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'taille' => 'string|nullable|max:255',
            'reduction' => 'string|nullable|max:255',
            'categorie_id' => 'required|integer|exists:categories,id',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'categorie_id' => $request->categorie_id,
            'taille' => $request->taille,
            'reduction' => $request->reduction,
        ];


        if ($request->hasFile('image')) {
            $originalName = str_replace(' ', '_', $request->name);
            $timestamp = now()->format('Ymd_His');
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $originalName . '_' . $timestamp . '.' . $extension;

            $path = $request->file('image')->storeAs('produitimages', $fileName, 'public');
            $data['image'] = $path;
        }

        $produit->update($data);

        return redirect()->back()->with('success', 'Produit mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return redirect()->back()->with('success', 'Produit supprimé avec succès');
    }

    public function SyncFromApi()
    {
        try {
            $response = Http::get(config('services.api_mh.base_url') . '/produits');

            if ($response->failed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Échec de la synchronisation avec l\'API'
                ], 400);
            }

            $produitsData = $response->json();
            $synced = 0;
            $updated = 0;

            foreach ($produitsData as $produitData) {
                $produit = Produit::updateOrCreate(
                    ['id' => $produitData['id']],
                    [
                        'id' => $produitData['id'],
                        'name' => $produitData['name'],
                        'description' => $produitData['description'] ?? null,
                        'price' => $produitData['price'],
                        'categorie_id' => $produitData['category']['id'],
                    ]
                );

                if (!empty($produitData['image'])) {
                    ImageProduit::updateOrCreate(
                        [
                            'produit_id' => $produit->id,
                            'url' => $produitData['image'],
                        ],
                        [
                            'description' => 'Image API',
                        ]
                    );
                }

                $produit->wasRecentlyCreated ? $synced++ : $updated++;
            }

            return response()->json([
                'success' => true,
                'message' => "Synchronisation réussie : {$synced} produits créés, {$updated} mis à jour"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la synchronisation : ' . $e->getMessage()
            ], 500);
        }
    }
}
