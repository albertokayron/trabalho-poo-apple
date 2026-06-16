@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    
    <!-- Cabeçalho -->
    <div>
        <a href="{{ route('manutencoes.index') }}" class="text-xs font-semibold text-apple-gray hover:text-apple-black transition-colors">&larr; Voltar para a lista</a>
        <h1 class="text-3xl font-bold tracking-tight text-apple-black mt-2">Editar Manutenção</h1>
        <p class="text-sm text-apple-gray mt-1">Atualize as informações do chamado técnico.</p>
    </div>

    <!-- Formulário -->
    <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
        <form action="{{ route('manutencoes.update', $manutencao->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Campo Aparelho -->
            <div>
                <label for="aparelho_id" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">Aparelho com Defeito</label>
                <select name="aparelho_id" id="aparelho_id" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm transition-all" required>
                    @foreach($aparelhos as $aparelho)
                        <option value="{{ $aparelho->id }}" {{ old('aparelho_id', $manutencao->aparelho_id) == $aparelho->id ? 'selected' : '' }}>
                            {{ $aparelho->modelo }} (S/N: {{ $aparelho->numero_serie }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Campo Usuário/Técnico -->
            <div>
                <label for="usuario_id" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">Técnico Responsável</label>
                <select name="usuario_id" id="usuario_id" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm transition-all" required>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('usuario_id', $manutencao->usuario_id) == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->name }} ({{ $usuario->cargo }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Campo Descrição do Problema -->
            <div>
                <label for="descricao_problema" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">Descrição do Problema</label>
                <textarea name="descricao_problema" id="descricao_problema" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm transition-all" required>{{ old('descricao_problema', $manutencao->descricao_problema) }}</textarea>
            </div>

            <!-- Campo Status da Manutenção -->
            <div>
                <label for="status" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">Status da Manutenção</label>
                <select name="status" id="status" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm transition-all" required>
                    <option value="Pendente" {{ old('status', $manutencao->status) == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="Em Análise" {{ old('status', $manutencao->status) == 'Em Análise' ? 'selected' : '' }}>Em Análise</option>
                    <option value="Concluído" {{ old('status', $manutencao->status) == 'Concluído' ? 'selected' : '' }}>Concluído</option>
                </select>
            </div>

            <!-- Campo Data de Entrada -->
            <div>
                <label for="data_entrada" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">Data e Hora de Entrada</label>
                <input type="datetime-local" name="data_entrada" id="data_entrada" value="{{ old('data_entrada', $manutencao->data_entrada ? $manutencao->data_entrada->format('Y-m-d\TH:i') : '') }}" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm transition-all" required>
            </div>

            <!-- Botões de Ação -->
            <div class="pt-4 border-t border-gray-100 flex items-center justify-end space-x-4">
                <a href="{{ route('manutencoes.index') }}" class="px-5 py-2.5 rounded-full text-xs font-semibold border border-gray-300 text-apple-black hover:bg-gray-50 transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-full text-xs font-semibold text-white bg-apple-black hover:bg-black hover:shadow transition-all duration-200">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
