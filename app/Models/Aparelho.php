<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aparelho extends Model
{
    protected $fillable = [
        'modelo',
        'tipo',
        'numero_serie',
        'status',
    ];

    
    public function manutencoes()
    {
        return $this->hasMany(Manutencao::class, 'aparelho_id');
    }
}
