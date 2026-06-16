@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <!-- Cabeçalho -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-apple-black">Ordem de Manutenção</h1>
            <p class="text-sm text-apple-gray mt-1">Gerencie a fila de suporte técnico e consertos de aparelhos da Apple.</p>
        </div>
        
        <a href="{{ route('manutencoes.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-wider text-white bg-apple-black rounded-full hover:bg-black transition-all duration-200 shadow-sm hover:shadow-md">
            + Registrar Manutenção
        </a>
    </div>

    <!-- Fila de Manutenções -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left">
                <thead class="bg-gray-50 text-xs font-semibold tracking-wider text-apple-gray uppercase">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Aparelho</th>
                        <th class="px-6 py-4">Técnico Responsável</th>
                        <th class="px-6 py-4">Descrição do Defeito</th>
                        <th class="px-6 py-4">Data de Entrada</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($manutencoes as $manutencao)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-6 py-4 font-semibold text-apple-black">#{{ $manutencao->id }}</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-apple-black">{{ $manutencao->aparelho->modelo }}</div>
                                <div class="text-xs text-apple-gray font-mono mt-0.5">S/N: {{ $manutencao->aparelho->numero_serie }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-apple-black">{{ $manutencao->tecnico->name }}</div>
                                <div class="text-xs text-apple-gray mt-0.5">{{ $manutencao->tecnico->cargo }}</div>
                            </td>
                            <td class="px-6 py-4 max-w-xs">
                                <p class="text-apple-black truncate" title="{{ $manutencao->descricao_problema }}">
                                    {{ $manutencao->descricao_problema }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-apple-gray text-xs">
                                {{ $manutencao->data_entrada->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($manutencao->status === 'Pendente')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-amber-700 bg-amber-50 rounded-full border border-amber-100">Pendente</span>
                                @elseif ($manutencao->status === 'Em Análise')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-sky-700 bg-sky-50 rounded-full border border-sky-100">Em Análise</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-50 rounded-full border border-emerald-100">Concluído</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                <!-- Botão Editar -->
                                <a href="{{ route('manutencoes.edit', $manutencao->id) }}" class="text-xs font-semibold text-apple-blue hover:underline">
                                    Editar
                                </a>
                                
                                <!-- Formulário Excluir -->
                                <form action="{{ route('manutencoes.destroy', $manutencao->id) }}" method="POST" class="inline" onsubmit="return confirm('Deseja realmente remover esta ordem de manutenção?');">
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
                            <td colspan="7" class="px-6 py-8 text-center text-apple-gray">
                                <p class="text-sm font-medium">Nenhum registro de manutenção encontrado.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
