<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'client_id', 'numero', 'date', 'montant', 'statut',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

