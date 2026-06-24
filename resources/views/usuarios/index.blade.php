@extends('layouts.app')

@section('content')
<div class="space-y-6 animate-slide-up">
    
    <!-- Cabeçalho -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-apple-black dark:text-white">Funcionários</h1>
            <p class="text-sm text-apple-gray dark:text-gray-400 mt-1">Gerencie a equipe técnica da Apple Store cadastrada no sistema.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <!-- Campo de Busca Dinâmico -->
            <div class="relative w-full sm:w-64">
                <input type="text" id="user-search" placeholder="Buscar por nome, e-mail, cargo..." class="w-full px-4 py-2 text-xs rounded-full border border-gray-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 text-apple-black dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-apple-blue/55 focus:border-apple-blue transition-all" />
                <span class="absolute right-3.5 top-2.5 text-apple-gray dark:text-gray-500">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
            </div>

            <a href="{{ route('usuarios.create') }}" class="inline-flex items-center justify-center px-5 py-2 text-xs font-bold tracking-wider text-white bg-apple-blue hover:bg-blue-600 rounded-full transition-all duration-300 shadow-sm hover:shadow-lg hover:-translate-y-0.5 whitespace-nowrap">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Novo Funcionário
            </a>
        </div>
    </div>

    <!-- Tabela de Usuários -->
    <div class="bg-white dark:bg-zinc-900 rounded-3xl border border-gray-200/60 dark:border-zinc-800/80 shadow-sm overflow-hidden transition-colors duration-300">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-800 text-left">
                <thead class="bg-gray-50 dark:bg-zinc-900/50 text-[10px] font-bold tracking-widest text-apple-gray dark:text-gray-400 uppercase">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Nome</th>
                        <th class="px-6 py-4">E-mail</th>
                        <th class="px-6 py-4">Cargo</th>
                        <th class="px-6 py-4">Cadastrado em</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-zinc-800 text-sm" id="user-tbody">
                    @forelse ($usuarios as $usuario)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/20 transition-colors user-row"
                            data-searchable="{{ strtolower($usuario->id . ' ' . $usuario->name . ' ' . $usuario->email . ' ' . $usuario->cargo) }}">
                            <td class="px-6 py-4 font-bold text-apple-black dark:text-zinc-400">#{{ $usuario->id }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-apple-black dark:text-white">{{ $usuario->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-apple-gray dark:text-gray-400">{{ $usuario->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold bg-gray-100 dark:bg-zinc-800 rounded-full text-apple-black dark:text-gray-200 border border-gray-200/60 dark:border-zinc-700/80">
                                    {{ $usuario->cargo }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-apple-gray dark:text-gray-400 text-xs">
                                {{ $usuario->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                <!-- Botão Editar -->
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="inline-flex items-center px-3 py-1 text-xs font-bold text-apple-blue dark:text-blue-400 bg-blue-50 dark:bg-blue-950/20 hover:bg-apple-blue hover:text-white dark:hover:bg-apple-blue dark:hover:text-white rounded-full transition-all duration-200">
                                    Editar
                                </a>
                                
                                <!-- Formulário Excluir -->
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="inline" onsubmit="return confirm('Deseja realmente remover este funcionário?');">
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <p class="text-sm font-semibold">Nenhum funcionário cadastrado.</p>
                            </td>
                        </tr>
                    @endforelse

                    <!-- Linha de busca sem resultados -->
                    <tr id="no-results-row" class="hidden">
                        <td colspan="6" class="px-6 py-12 text-center text-apple-gray dark:text-gray-500">
                            <svg class="mx-auto h-10 w-10 text-gray-300 dark:text-zinc-700 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <p class="text-sm font-semibold">Nenhum funcionário corresponde à busca.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Script de Filtro Instantâneo -->
<script>
    document.getElementById('user-search').addEventListener('input', function(e) {
        let query = e.target.value.toLowerCase().trim();
        let rows = document.querySelectorAll('.user-row');
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

