<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::paginate(10);
        return view('categorie', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            
        ]);

        
        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            
        ];

        Categorie::create($data);

        return redirect()->back()->with('success', 'Categorie ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $categorie = Categorie::findOrFail($id);
        return view('categorieshow', compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categorie = Categorie::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

         if ($request->hasFile('image')) {
            $originalName = str_replace(' ', '_', $categorie->name);
            $timestamp = now()->format('Ymd_His');
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $originalName . '_' . $timestamp . '.' . $extension;

            $path = $request->file('image')->storeAs('categorieimages', $fileName, 'public');
            $data['image'] = $path;
         }

        $categorie->update($data);

        return redirect()->back()->with('success', 'Catégorie mise à jour avec succès');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect()->back()->with('success', 'Catégorie supprimée avec succès');
    }

    public function SyncFromApi()
    {
        $response = Http::get(config('services.api_mh.base_url') . '/categoriess');

        // Log the raw response for debugging
  
        if ($response->failed()) {
            return redirect()->back()->with('error', 'Échec de la synchronisation avec l\'API');
        }

        $categoriesData = $response->json('data');

        foreach ($categoriesData as $categoryData) {
            Categorie::updateOrCreate(
                ['id' => $categoryData['id']],
                [
                    'id' => $categoryData['id'],
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'] ?? 'null',
                ]
            );
        }

        return redirect()->back()->with('success', 'Catégories synchronisées avec succès depuis l\'API');
    }
}

