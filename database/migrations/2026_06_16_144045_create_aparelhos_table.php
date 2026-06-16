<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aparelhos', function (Blueprint $table) {
            $table->id();
            $table->string('modelo');
            $table->string('tipo'); // Ex: iPhone, Mac, iPad
            $table->string('numero_serie')->unique();
            $table->string('status'); // Ex: Disponível, Em Uso, Em Manutenção
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aparelhos');
    }
};
