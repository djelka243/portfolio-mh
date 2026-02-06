<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produit extends Model
{
    protected $fillable = ['id', 'name', 'description', 'price', 'categorie_id', 'taille', 'reduction', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produit) {
            $produit->slug = static::generateUniqueSlug($produit->name);
        });

        static::updating(function ($produit) {
            if ($produit->isDirty('name')) {
                $newSlug = static::generateUniqueSlug($produit->name, $produit->id);

                if ($produit->slug !== $newSlug) {
                    $produit->slug = $newSlug;
                }
            }
        });
    }


    protected static function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $original = $slug;
        $counter = 1;

        while (static::where('slug', $slug)
            ->when($ignoreId, fn($query) => $query->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $original . '-' . $counter;
            $counter++;
        }

        return $slug;
    }


    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function images()
    {
        return $this->hasMany(ImageProduit::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
