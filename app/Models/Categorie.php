<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;
use Illuminate\Support\Str;

class Categorie extends Model
{
    protected $fillable = ['name', 'description', 'image', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($categorie) {
            if (empty($categorie->slug)) {
                $baseSlug = Str::slug($categorie->name);

                $count = static::where('slug', 'LIKE', $baseSlug . '%')->count();

                if ($count > 0) {
                    $categorie->slug = $baseSlug . '-' . ($count + 1);
                } else {
                    $categorie->slug = $baseSlug;
                }
            }
        });

        static::updating(function ($categorie) {
            if ($categorie->isDirty('name') && empty($categorie->slug)) {
                $baseSlug = Str::slug($categorie->name);

                $count = static::where('slug', 'LIKE', $baseSlug . '%')
                    ->where('id', '!=', $categorie->id)
                    ->count();

                if ($count > 0) {
                    $categorie->slug = $baseSlug . '-' . ($count + 1);
                } else {
                    $categorie->slug = $baseSlug;
                }
            }
        });
    }
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
