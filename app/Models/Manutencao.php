<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    // Especifica o nome correto da tabela no banco de dados (o Laravel por padrão buscaria 'manutencaos')
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

    /**
     * Relacionamento: a manutenção pertence a um aparelho.
     */
    public function aparelho()
    {
        return $this->belongsTo(Aparelho::class, 'aparelho_id');
    }

    /**
     * Relacionamento: a manutenção pertence a um técnico/funcionário (usuário).
     */
    public function tecnico()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
