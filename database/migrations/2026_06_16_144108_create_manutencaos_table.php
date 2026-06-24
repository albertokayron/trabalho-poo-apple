<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('manutencoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aparelho_id')->constrained('aparelhos')->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->text('descricao_problema');
            $table->string('status'); 
            $table->dateTime('data_entrada');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('manutencoes');
    }
};
