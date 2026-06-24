@extends('layouts.app')

@section('content')
<div class="space-y-6 animate-slide-up">
    
    <!-- Cabeçalho -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-apple-black dark:text-white">Aparelhos</h1>
            <p class="text-sm text-apple-gray dark:text-gray-400 mt-1">Gerencie o inventário de produtos Apple cadastrados no sistema.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <!-- Campo de Busca Dinâmico -->
            <div class="relative w-full sm:w-64">
                <input type="text" id="device-search" placeholder="Buscar por modelo, tipo, S/N..." class="w-full px-4 py-2 text-xs rounded-full border border-gray-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 text-apple-black dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-apple-blue/55 focus:border-apple-blue transition-all" />
                <span class="absolute right-3.5 top-2.5 text-apple-gray dark:text-gray-500">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
            </div>

            <a href="{{ route('aparelhos.create') }}" class="inline-flex items-center justify-center px-5 py-2 text-xs font-bold tracking-wider text-white bg-apple-blue hover:bg-blue-600 rounded-full transition-all duration-300 shadow-sm hover:shadow-lg hover:-translate-y-0.5 whitespace-nowrap">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Novo Aparelho
            </a>
        </div>
    </div>

    <!-- Tabela de Aparelhos -->
    <div class="bg-white dark:bg-zinc-900 rounded-3xl border border-gray-200/60 dark:border-zinc-800/80 shadow-sm overflow-hidden transition-colors duration-300">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-800 text-left">
                <thead class="bg-gray-50 dark:bg-zinc-900/50 text-[10px] font-bold tracking-widest text-apple-gray dark:text-gray-400 uppercase">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Modelo</th>
                        <th class="px-6 py-4">Tipo</th>
                        <th class="px-6 py-4">Número de Série</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-zinc-800 text-sm" id="device-tbody">
                    @forelse ($aparelhos as $aparelho)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/20 transition-colors device-row"
                            data-searchable="{{ strtolower($aparelho->id . ' ' . $aparelho->modelo . ' ' . $aparelho->tipo . ' ' . $aparelho->numero_serie . ' ' . $aparelho->status) }}">
                            <td class="px-6 py-4 font-bold text-apple-black dark:text-zinc-400">#{{ $aparelho->id }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-apple-black dark:text-white">{{ $aparelho->modelo }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold bg-gray-100 dark:bg-zinc-800 rounded-full text-apple-black dark:text-gray-200 border border-gray-200/60 dark:border-zinc-700/80">
                                    {{ $aparelho->tipo }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono text-xs text-apple-gray dark:text-gray-400">{{ $aparelho->numero_serie }}</td>
                            <td class="px-6 py-4">
                                @if ($aparelho->status === 'Disponível')
                                    <span class="px-3 py-1 text-xs font-semibold text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-950/20 rounded-full border border-emerald-100 dark:border-emerald-900/30 inline-flex items-center">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                        Disponível
                                    </span>
                                @elseif ($aparelho->status === 'Em Uso')
                                    <span class="px-3 py-1 text-xs font-semibold text-sky-700 bg-sky-50 dark:text-sky-400 dark:bg-sky-950/20 rounded-full border border-sky-100 dark:border-sky-900/30 inline-flex items-center">
                                        <span class="relative flex h-1.5 w-1.5 mr-1.5">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-sky-500"></span>
                                        </span>
                                        Em Uso
                                    </span>
                                @elseif ($aparelho->status === 'Em Manutenção')
                                    <span class="px-3 py-1 text-xs font-semibold text-amber-700 bg-amber-50 dark:text-amber-400 dark:bg-amber-950/20 rounded-full border border-amber-100 dark:border-amber-900/30 inline-flex items-center">
                                        <span class="relative flex h-1.5 w-1.5 mr-1.5">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-amber-500"></span>
                                        </span>
                                        Em Manutenção
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold text-rose-700 bg-rose-50 dark:text-rose-400 dark:bg-rose-950/20 rounded-full border border-rose-100 dark:border-rose-900/30 inline-flex items-center">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                        Descartado
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                <!-- Botão Editar -->
                                <a href="{{ route('aparelhos.edit', $aparelho->id) }}" class="inline-flex items-center px-3 py-1 text-xs font-bold text-apple-blue dark:text-blue-400 bg-blue-50 dark:bg-blue-950/20 hover:bg-apple-blue hover:text-white dark:hover:bg-apple-blue dark:hover:text-white rounded-full transition-all duration-200">
                                    Editar
                                </a>
                                
                                <!-- Formulário Excluir -->
                                <form action="{{ route('aparelhos.destroy', $aparelho->id) }}" method="POST" class="inline" onsubmit="return confirm('Deseja realmente remover este aparelho?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 text-xs font-bold text-rose-600 bg-rose-50 dark:text-rose-400 dark:bg-rose-950/20 hover:bg-rose-600 hover:text-white dark:hover:bg-rose-600 dark:hover:text-white rounded-full transition-all duration-200">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr id="empty-row">
                            <td colspan="6" class="px-6 py-12 text-center text-apple-gray dark:text-gray-500">
                                <svg class="mx-auto h-10 w-10 text-gray-300 dark:text-zinc-700 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm font-semibold">Nenhum aparelho no inventário.</p>
                            </td>
                        </tr>
                    @endforelse

                    <!-- Linha de busca sem resultados -->
                    <tr id="no-results-row" class="hidden">
                        <td colspan="6" class="px-6 py-12 text-center text-apple-gray dark:text-gray-500">
                            <svg class="mx-auto h-10 w-10 text-gray-300 dark:text-zinc-700 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <p class="text-sm font-semibold">Nenhum aparelho corresponde à busca.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Script de Filtro Instantâneo -->
<script>
    document.getElementById('device-search').addEventListener('input', function(e) {
        let query = e.target.value.toLowerCase().trim();
        let rows = document.querySelectorAll('.device-row');
        let noResultsRow = document.getElementById('no-results-row');
        let emptyRow = document.getElementById('empty-row');
        let visibleCount = 0;

        rows.forEach(function(row) {
            let searchable = row.getAttribute('data-searchable');
            if (searchable.includes(query)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        if (rows.length > 0) {
            if (visibleCount === 0) {
                noResultsRow.classList.remove('hidden');
            } else {
                noResultsRow.classList.add('hidden');
            }
        }
    });
</script>
@endsection

