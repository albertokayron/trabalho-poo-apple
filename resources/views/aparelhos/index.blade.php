@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <!-- Cabeçalho -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-apple-black">Aparelhos</h1>
            <p class="text-sm text-apple-gray mt-1">Gerencie o inventário de produtos Apple cadastrados no sistema.</p>
        </div>
        
        <a href="{{ route('aparelhos.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-wider text-white bg-apple-black rounded-full hover:bg-black transition-all duration-200 shadow-sm hover:shadow-md">
            + Novo Aparelho
        </a>
    </div>

    <!-- Tabela de Aparelhos -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left">
                <thead class="bg-gray-50 text-xs font-semibold tracking-wider text-apple-gray uppercase">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Modelo</th>
                        <th class="px-6 py-4">Tipo</th>
                        <th class="px-6 py-4">Número de Série</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($aparelhos as $aparelho)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-6 py-4 font-semibold text-apple-black">#{{ $aparelho->id }}</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-apple-black">{{ $aparelho->modelo }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 text-xs font-medium bg-gray-100 rounded-md text-apple-black">
                                    {{ $aparelho->tipo }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono text-xs text-apple-gray">{{ $aparelho->numero_serie }}</td>
                            <td class="px-6 py-4">
                                @if ($aparelho->status === 'Disponível')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-50 rounded-full border border-emerald-100">Disponível</span>
                                @elseif ($aparelho->status === 'Em Uso')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-sky-700 bg-sky-50 rounded-full border border-sky-100">Em Uso</span>
                                @elseif ($aparelho->status === 'Em Manutenção')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-amber-700 bg-amber-50 rounded-full border border-amber-100">Em Manutenção</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold text-rose-700 bg-rose-50 rounded-full border border-rose-100">Descartado</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <!-- Botão Editar -->
                                <a href="{{ route('aparelhos.edit', $aparelho->id) }}" class="text-xs font-semibold text-apple-blue hover:underline">
                                    Editar
                                </a>
                                
                                <!-- Formulário Excluir -->
                                <form action="{{ route('aparelhos.destroy', $aparelho->id) }}" method="POST" class="inline" onsubmit="return confirm('Deseja realmente remover este aparelho?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold text-rose-600 hover:underline">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-apple-gray">
                                <p class="text-sm font-medium">Nenhum aparelho no inventário.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
