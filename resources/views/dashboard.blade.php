@extends('layouts.app')

@section('content')
<div class="space-y-8">
    
    <!-- Cabeçalho de Boas-vindas -->
    <div class="md:flex md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-apple-black">Dashboard</h1>
            <p class="text-sm text-apple-gray mt-1">Bem-vindo ao painel interno de gerenciamento e suporte técnico.</p>
        </div>
        
        <!-- Ações Rápidas -->
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{ route('manutencoes.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-wider text-white bg-apple-black rounded-full hover:bg-black transition-all duration-200 shadow-sm hover:shadow-md">
                + Nova Manutenção
            </a>
            <a href="{{ route('aparelhos.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-wider text-apple-black bg-white border border-gray-300 rounded-full hover:bg-gray-50 transition-all duration-200 shadow-sm">
                + Novo Aparelho
            </a>
        </div>
    </div>

    <!-- Grid de Cartões de Estatísticas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Card Funcionários -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold tracking-wider text-apple-gray uppercase">Funcionários</span>
                <h3 class="text-3xl font-bold text-apple-black mt-2">{{ $totalFuncionarios }}</h3>
                <a href="{{ route('usuarios.index') }}" class="text-xs font-medium text-apple-blue hover:underline mt-2 inline-block">Ver todos os técnicos &rarr;</a>
            </div>
            <div class="p-3 bg-gray-100 rounded-xl text-apple-black">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>

        <!-- Card Aparelhos -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold tracking-wider text-apple-gray uppercase">Aparelhos</span>
                <h3 class="text-3xl font-bold text-apple-black mt-2">{{ $totalAparelhos }}</h3>
                <a href="{{ route('aparelhos.index') }}" class="text-xs font-medium text-apple-blue hover:underline mt-2 inline-block">Ver inventário completo &rarr;</a>
            </div>
            <div class="p-3 bg-gray-100 rounded-xl text-apple-black">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

        <!-- Card Manutenções Ativas -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold tracking-wider text-apple-gray uppercase">Total de Reparos</span>
                <h3 class="text-3xl font-bold text-apple-black mt-2">{{ $totalManutencoes }}</h3>
                <a href="{{ route('manutencoes.index') }}" class="text-xs font-medium text-apple-blue hover:underline mt-2 inline-block">Ver fila de reparos &rarr;</a>
            </div>
            <div class="p-3 bg-gray-100 rounded-xl text-apple-black">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
        </div>

    </div>

    <!-- Estatísticas de Reparo Detalhadas -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
        <h2 class="text-lg font-semibold text-apple-black mb-4">Status dos Reparos</h2>
        <div class="grid grid-cols-3 gap-4 text-center">
            
            <div class="p-4 bg-amber-50 rounded-xl border border-amber-100">
                <span class="text-xs font-medium text-amber-800">Pendentes</span>
                <p class="text-2xl font-bold text-amber-900 mt-1">{{ $manutencoesPendentes }}</p>
            </div>

            <div class="p-4 bg-sky-50 rounded-xl border border-sky-100">
                <span class="text-xs font-medium text-sky-800">Em Análise</span>
                <p class="text-2xl font-bold text-sky-900 mt-1">{{ $manutencoesEmAnalise }}</p>
            </div>

            <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                <span class="text-xs font-medium text-emerald-800">Concluídos</span>
                <p class="text-2xl font-bold text-emerald-900 mt-1">{{ $manutencoesConcluidas }}</p>
            </div>

        </div>
    </div>

    <!-- Lista de Manutenções Recentes -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-apple-black">Reparos Recentes na Fila</h3>
            <p class="text-xs text-apple-gray mt-1">Últimas solicitações de manutenção cadastradas no sistema.</p>
        </div>
        
        <div class="divide-y divide-gray-100">
            @forelse($recentesManutencoes as $manutencao)
                <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between hover:bg-gray-50 transition-colors duration-200">
                    <div class="space-y-1">
                        <div class="flex items-center space-x-3">
                            <span class="text-sm font-semibold text-apple-black">{{ $manutencao->aparelho->modelo }}</span>
                            <span class="text-xs text-apple-gray">({{ $manutencao->aparelho->tipo }})</span>
                        </div>
                        <p class="text-xs text-apple-gray max-w-2xl line-clamp-1">{{ $manutencao->descricao_problema }}</p>
                        <div class="flex items-center space-x-2 text-xs text-apple-gray">
                            <span>Técnico: <strong class="text-apple-black font-medium">{{ $manutencao->tecnico->name }}</strong></span>
                            <span>&bull;</span>
                            <span>Entrada: {{ $manutencao->data_entrada->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 md:mt-0 flex items-center justify-between md:space-x-6">
                        <!-- Badge de Status -->
                        @if ($manutencao->status === 'Pendente')
                            <span class="px-2.5 py-1 text-xs font-semibold text-amber-700 bg-amber-50 rounded-full border border-amber-100">Pendente</span>
                        @elseif ($manutencao->status === 'Em Análise')
                            <span class="px-2.5 py-1 text-xs font-semibold text-sky-700 bg-sky-50 rounded-full border border-sky-100">Em Análise</span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-50 rounded-full border border-emerald-100">Concluído</span>
                        @endif
                        
                        <a href="{{ route('manutencoes.edit', $manutencao->id) }}" class="text-xs font-semibold text-apple-blue hover:underline">Editar &rarr;</a>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-apple-gray">
                    <svg class="mx-auto h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-sm mt-2 font-medium">Nenhuma manutenção pendente no momento.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
