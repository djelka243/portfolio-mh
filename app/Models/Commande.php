<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'ville',
        'code_postal',
        'commentaire',
        'total',
        'produits',
        'statut',
        'numero_commande'
    ];

    protected $casts = [
        'produits' => 'array',
        'total' => 'decimal:2'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($commande) {
            $commande->numero_commande = 'CMD-' . strtoupper(uniqid());
        });
    }
}
