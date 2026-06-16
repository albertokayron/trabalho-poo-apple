@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <!-- Cabeçalho -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-apple-black">Funcionários</h1>
            <p class="text-sm text-apple-gray mt-1">Gerencie a equipe técnica da Apple Store cadastrada no sistema.</p>
        </div>
        
        <a href="{{ route('usuarios.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-wider text-white bg-apple-black rounded-full hover:bg-black transition-all duration-200 shadow-sm hover:shadow-md">
            + Novo Funcionário
        </a>
    </div>

    <!-- Tabela de Usuários -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left">
                <thead class="bg-gray-50 text-xs font-semibold tracking-wider text-apple-gray uppercase">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Nome</th>
                        <th class="px-6 py-4">E-mail</th>
                        <th class="px-6 py-4">Cargo</th>
                        <th class="px-6 py-4">Cadastrado em</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($usuarios as $usuario)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-6 py-4 font-semibold text-apple-black">#{{ $usuario->id }}</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-apple-black">{{ $usuario->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-apple-gray">{{ $usuario->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-xs font-medium bg-gray-100 rounded-full text-apple-black border border-gray-200">
                                    {{ $usuario->cargo }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-apple-gray text-xs">
                                {{ $usuario->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <!-- Botão Editar -->
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="text-xs font-semibold text-apple-blue hover:underline">
                                    Editar
                                </a>
                                
                                <!-- Formulário Excluir -->
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="inline" onsubmit="return confirm('Deseja realmente remover este funcionário?');">
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
                                <p class="text-sm font-medium">Nenhum funcionário cadastrado.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
