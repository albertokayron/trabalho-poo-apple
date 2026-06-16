<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Aparelho;
use App\Models\Manutencao;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Cadastrando Funcionários (Usuários) da Apple
        $steve = User::create([
            'name' => 'Steve Jobs',
            'email' => 'steve@apple.com',
            'cargo' => 'Co-Fundador',
            'password' => Hash::make('password123'),
        ]);

        $tim = User::create([
            'name' => 'Tim Cook',
            'email' => 'tim@apple.com',
            'cargo' => 'Diretor Executivo (CEO)',
            'password' => Hash::make('password123'),
        ]);

        $craig = User::create([
            'name' => 'Craig Federighi',
            'email' => 'craig@apple.com',
            'cargo' => 'VP de Engenharia de Software',
            'password' => Hash::make('password123'),
        ]);

        $genius = User::create([
            'name' => 'Ana Silva',
            'email' => 'ana@apple.com',
            'cargo' => 'Técnico Genius',
            'password' => Hash::make('password123'),
        ]);

        // 2. Cadastrando Aparelhos (Produtos Apple)
        $iphone = Aparelho::create([
            'modelo' => 'iPhone 15 Pro Max (256GB)',
            'tipo' => 'iPhone',
            'numero_serie' => 'SN-IPH15PM-001',
            'status' => 'Disponível',
        ]);

        $macbook = Aparelho::create([
            'modelo' => 'MacBook Pro M3 Max (16")',
            'tipo' => 'Mac',
            'numero_serie' => 'SN-MBPM3M-002',
            'status' => 'Em Manutenção',
        ]);

        $ipad = Aparelho::create([
            'modelo' => 'iPad Pro M4 (13")',
            'tipo' => 'iPad',
            'numero_serie' => 'SN-IPADPRO-003',
            'status' => 'Em Uso',
        ]);

        $watch = Aparelho::create([
            'modelo' => 'Apple Watch Ultra 2',
            'tipo' => 'Outros',
            'numero_serie' => 'SN-AWULTRA-004',
            'status' => 'Em Manutenção',
        ]);

        // 3. Cadastrando Registros de Manutenções
        Manutencao::create([
            'aparelho_id' => $macbook->id,
            'usuario_id' => $genius->id,
            'descricao_problema' => 'Tela piscando intermitentemente e aquecimento excessivo ao processar vídeo no Final Cut Pro.',
            'status' => 'Em Análise',
            'data_entrada' => now()->subDays(2),
        ]);

        Manutencao::create([
            'aparelho_id' => $watch->id,
            'usuario_id' => $genius->id,
            'descricao_problema' => 'Bateria descarregando completamente em menos de 4 horas de uso normal. Aparelho desliga com 20% de carga.',
            'status' => 'Pendente',
            'data_entrada' => now(),
        ]);
    }
}
