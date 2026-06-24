<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    
    protected $table = 'manutencoes';

    protected $fillable = [
        'aparelho_id',
        'usuario_id',
        'descricao_problema',
        'status',
        'data_entrada',
    ];

    protected $casts = [
        'data_entrada' => 'datetime',
    ];

    
    public function aparelho()
    {
        return $this->belongsTo(Aparelho::class, 'aparelho_id');
    }

    
    public function tecnico()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
