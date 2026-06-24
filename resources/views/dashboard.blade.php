@extends('layouts.app')

@section('content')
<div class="space-y-8">
    
    <!-- Cabeçalho de Boas-vindas -->
    <div class="md:flex md:items-center md:justify-between animate-slide-up">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-apple-black dark:text-white">Dashboard</h1>
            <p class="text-sm text-apple-gray dark:text-gray-400 mt-1 flex items-center">
                <span class="mr-2">Painel interno de gerenciamento e suporte técnico.</span>
                <span class="hidden md:inline-block w-1.5 h-1.5 rounded-full bg-apple-blue"></span>
                <span id="live-date" class="ml-2 font-medium text-apple-blue dark:text-blue-400"></span>
            </p>
        </div>
        
        <!-- Ações Rápidas -->
        <div class="mt-5 md:mt-0 flex space-x-3">
            <a href="{{ route('manutencoes.create') }}" class="inline-flex items-center px-5 py-2.5 text-xs font-bold tracking-wider text-white bg-apple-blue hover:bg-blue-600 rounded-full transition-all duration-300 shadow-sm hover:shadow-lg hover:-translate-y-0.5">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Nova Manutenção
            </a>
            <a href="{{ route('aparelhos.create') }}" class="inline-flex items-center px-5 py-2.5 text-xs font-bold tracking-wider text-apple-black dark:text-white bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 rounded-full hover:bg-gray-50 dark:hover:bg-zinc-800 transition-all duration-300 shadow-sm hover:-translate-y-0.5">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Novo Aparelho
            </a>
        </div>
    </div>

    <!-- Grid de Cartões de Estatísticas (KPIs) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate-slide-up" style="animation-delay: 100ms;">
        
        <!-- Card Funcionários -->
        <div class="bg-white dark:bg-zinc-900 p-6 rounded-3xl border border-gray-200/60 dark:border-zinc-800/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-between group">
            <div>
                <span class="text-[10px] font-bold tracking-widest text-apple-gray dark:text-gray-400 uppercase">Técnicos Ativos</span>
                <h3 class="text-3xl font-extrabold text-apple-black dark:text-white mt-1 tracking-tight">{{ $totalFuncionarios }}</h3>
                <a href="{{ route('usuarios.index') }}" class="text-xs font-semibold text-apple-blue hover:text-blue-600 dark:text-blue-400 mt-3 inline-flex items-center group-hover:translate-x-1 transition-transform duration-300">
                    Ver equipe &rarr;
                </a>
            </div>
            <div class="p-3 bg-blue-50 dark:bg-blue-950/30 text-apple-blue dark:text-blue-400 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>

        <!-- Card Aparelhos -->
        <div class="bg-white dark:bg-zinc-900 p-6 rounded-3xl border border-gray-200/60 dark:border-zinc-800/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-between group">
            <div>
                <span class="text-[10px] font-bold tracking-widest text-apple-gray dark:text-gray-400 uppercase">Aparelhos no Inventário</span>
                <h3 class="text-3xl font-extrabold text-apple-black dark:text-white mt-1 tracking-tight">{{ $totalAparelhos }}</h3>
                <a href="{{ route('aparelhos.index') }}" class="text-xs font-semibold text-apple-blue hover:text-blue-600 dark:text-blue-400 mt-3 inline-flex items-center group-hover:translate-x-1 transition-transform duration-300">
                    Ver inventário &rarr;
                </a>
            </div>
            <div class="p-3 bg-indigo-50 dark:bg-indigo-950/30 text-indigo-600 dark:text-indigo-400 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

        <!-- Card Manutenções Ativas -->
        <div class="bg-white dark:bg-zinc-900 p-6 rounded-3xl border border-gray-200/60 dark:border-zinc-800/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-between group">
            <div>
                <span class="text-[10px] font-bold tracking-widest text-apple-gray dark:text-gray-400 uppercase">Total de Reparos</span>
                <h3 class="text-3xl font-extrabold text-apple-black dark:text-white mt-1 tracking-tight">{{ $totalManutencoes }}</h3>
                <a href="{{ route('manutencoes.index') }}" class="text-xs font-semibold text-apple-blue hover:text-blue-600 dark:text-blue-400 mt-3 inline-flex items-center group-hover:translate-x-1 transition-transform duration-300">
                    Ver fila &rarr;
                </a>
            </div>
            <div class="p-3 bg-pink-50 dark:bg-pink-950/30 text-pink-600 dark:text-pink-400 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
        </div>

    </div>

    <!-- Estatísticas de Reparo Detalhadas e Barras de Progresso -->
    @php
        $total = $totalManutencoes ?: 1;
        $pctPendentes = round(($manutencoesPendentes / $total) * 100);
        $pctEmAnalise = round(($manutencoesEmAnalise / $total) * 100);
        $pctConcluidas = round(($manutencoesConcluidas / $total) * 100);
    @endphp
    <div class="bg-white dark:bg-zinc-900 p-6 rounded-3xl border border-gray-200/60 dark:border-zinc-800/80 shadow-sm animate-slide-up" style="animation-delay: 200ms;">
        <h2 class="text-lg font-bold text-apple-black dark:text-white mb-6">Status dos Reparos Ativos</h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Pendentes -->
            <div class="space-y-2">
                <div class="flex justify-between items-center text-xs font-bold">
                    <span class="text-amber-600 dark:text-amber-400 flex items-center">
                        <span class="relative flex h-2 w-2 mr-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                        </span>
                        Pendentes ({{ $manutencoesPendentes }})
                    </span>
                    <span class="text-apple-gray dark:text-gray-400">{{ $pctPendentes }}%</span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-zinc-800 h-2.5 rounded-full overflow-hidden">
                    <div class="bg-amber-500 h-full rounded-full transition-all duration-1000 ease-out" style="width: {{ $pctPendentes }}%"></div>
                </div>
            </div>

            <!-- Em Análise -->
            <div class="space-y-2">
                <div class="flex justify-between items-center text-xs font-bold">
                    <span class="text-sky-600 dark:text-sky-400 flex items-center">
                        <span class="relative flex h-2 w-2 mr-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-sky-500"></span>
                        </span>
                        Em Análise ({{ $manutencoesEmAnalise }})
                    </span>
                    <span class="text-apple-gray dark:text-gray-400">{{ $pctEmAnalise }}%</span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-zinc-800 h-2.5 rounded-full overflow-hidden">
                    <div class="bg-sky-500 h-full rounded-full transition-all duration-1000 ease-out" style="width: {{ $pctEmAnalise }}%"></div>
                </div>
            </div>

            <!-- Concluídos -->
            <div class="space-y-2">
                <div class="flex justify-between items-center text-xs font-bold">
                    <span class="text-emerald-600 dark:text-emerald-400 flex items-center">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2"></span>
                        Concluídos ({{ $manutencoesConcluidas }})
                    </span>
                    <span class="text-apple-gray dark:text-gray-400">{{ $pctConcluidas }}%</span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-zinc-800 h-2.5 rounded-full overflow-hidden">
                    <div class="bg-emerald-500 h-full rounded-full transition-all duration-1000 ease-out" style="width: {{ $pctConcluidas }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Manutenções Recentes com Pesquisa Rápida -->
    <div class="bg-white dark:bg-zinc-900 rounded-3xl border border-gray-200/60 dark:border-zinc-800/80 shadow-sm overflow-hidden animate-slide-up" style="animation-delay: 300ms;">
        <div class="px-6 py-5 border-b border-gray-200/60 dark:border-zinc-800/80 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-apple-black dark:text-white">Fila de Reparos Ativos</h3>
                <p class="text-xs text-apple-gray dark:text-gray-400 mt-1">Últimas ordens de manutenção registradas no sistema.</p>
            </div>
            
            <!-- Campo de Busca Dinâmico -->
            <div class="relative w-full md:w-72">
                <input type="text" id="dashboard-search" placeholder="Filtrar por aparelho ou técnico..." class="w-full px-4 py-2 text-xs rounded-full border border-gray-200 dark:border-zinc-800 bg-gray-50 dark:bg-zinc-950 text-apple-black dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-apple-blue/55 focus:border-apple-blue transition-all" />
                <span class="absolute right-3.5 top-2.5 text-apple-gray dark:text-gray-500">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
            </div>
        </div>
        
        <div class="divide-y divide-gray-100 dark:divide-zinc-800/80" id="maintenance-list">
            @forelse($recentesManutencoes as $manutencao)
                <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between hover:bg-gray-50/50 dark:hover:bg-zinc-800/20 transition-colors duration-200 maintenance-item" data-modelo="{{ $manutencao->aparelho->modelo }}" data-tecnico="{{ $manutencao->tecnico->name }}">
                    <div class="space-y-1">
                        <div class="flex items-center space-x-3">
                            <span class="text-sm font-bold text-apple-black dark:text-white">{{ $manutencao->aparelho->modelo }}</span>
                            <span class="px-2 py-0.5 text-[10px] font-bold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-zinc-800 rounded-md">
                                {{ $manutencao->aparelho->tipo }}
                            </span>
                        </div>
                        <p class="text-xs text-apple-gray dark:text-gray-400 max-w-2xl line-clamp-1">{{ $manutencao->descricao_problema }}</p>
                        <div class="flex items-center space-x-2 text-[10px] text-apple-gray dark:text-gray-400 font-medium">
                            <span>Técnico: <strong class="text-apple-black dark:text-white font-semibold">{{ $manutencao->tecnico->name }}</strong></span>
                            <span>&bull;</span>
                            <span>Entrada: {{ $manutencao->data_entrada->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 md:mt-0 flex items-center justify-between md:space-x-6">
                        <!-- Badge de Status -->
                        @if ($manutencao->status === 'Pendente')
                            <span class="px-3 py-1 text-xs font-semibold text-amber-700 bg-amber-50 dark:text-amber-400 dark:bg-amber-950/20 rounded-full border border-amber-100 dark:border-amber-900/30 flex items-center">
                                <span class="relative flex h-1.5 w-1.5 mr-1.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-amber-500"></span>
                                </span>
                                Pendente
                            </span>
                        @elseif ($manutencao->status === 'Em Análise')
                            <span class="px-3 py-1 text-xs font-semibold text-sky-700 bg-sky-50 dark:text-sky-400 dark:bg-sky-950/20 rounded-full border border-sky-100 dark:border-sky-900/30 flex items-center">
                                <span class="relative flex h-1.5 w-1.5 mr-1.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-sky-500"></span>
                                </span>
                                Em Análise
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-950/20 rounded-full border border-emerald-100 dark:border-emerald-900/30 flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                Concluído
                            </span>
                        @endif
                        
                        <a href="{{ route('manutencoes.edit', $manutencao->id) }}" class="text-xs font-bold text-apple-blue dark:text-blue-400 hover:underline">
                            Editar &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-apple-gray dark:text-gray-500">
                    <svg class="mx-auto h-10 w-10 text-gray-300 dark:text-zinc-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-sm mt-3 font-semibold">Nenhuma manutenção pendente no momento.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>

<!-- Scripts de Interatividade do Dashboard -->
<script>
    // Formatar data em português brasileiro estilo Apple
    const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateStr = new Date().toLocaleDateString('pt-BR', dateOptions);
    const capitalizedDateStr = dateStr.charAt(0).toUpperCase() + dateStr.slice(1);
    document.getElementById('live-date').innerText = capitalizedDateStr;

    // Filtro instantâneo das manutenções recentes
    document.getElementById('dashboard-search').addEventListener('input', function(e) {
        let query = e.target.value.toLowerCase();
        let items = document.querySelectorAll('.maintenance-item');
        let visibleCount = 0;
        
        items.forEach(function(item) {
            let modelo = item.getAttribute('data-modelo').toLowerCase();
            let tecnico = item.getAttribute('data-tecnico').toLowerCase();
            if (modelo.includes(query) || tecnico.includes(query)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endsection

