@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6 animate-slide-up">
    
    <!-- Cabeçalho -->
    <div>
        <a href="{{ route('manutencoes.index') }}" class="inline-flex items-center text-xs font-bold text-apple-gray dark:text-gray-400 hover:text-apple-blue dark:hover:text-blue-400 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Voltar para a fila
        </a>
        <h1 class="text-3xl font-extrabold tracking-tight text-apple-black dark:text-white mt-2">Registrar Manutenção</h1>
        <p class="text-sm text-apple-gray dark:text-gray-400 mt-1">Abra uma nova ordem de serviço para conserto de dispositivo.</p>
    </div>

    <!-- Formulário -->
    <div class="bg-white dark:bg-zinc-900 p-8 rounded-3xl border border-gray-200/60 dark:border-zinc-800/80 shadow-sm transition-colors duration-300">
        <form action="{{ route('manutencoes.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Campo Aparelho -->
            <div class="space-y-2">
                <label for="aparelho_id" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Aparelho com Defeito</label>
                <select name="aparelho_id" id="aparelho_id" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/50 focus:border-apple-blue text-sm transition-all" required>
                    <option value="" disabled selected>Selecione o aparelho</option>
                    @foreach($aparelhos as $aparelho)
                        <option value="{{ $aparelho->id }}" {{ old('aparelho_id') == $aparelho->id ? 'selected' : '' }}>
                            {{ $aparelho->modelo }} (S/N: {{ $aparelho->numero_serie }})
                        </option>
                    @endforeach
                </select>
                @if($aparelhos->isEmpty())
                    <p class="text-xs text-rose-500 mt-1 font-semibold">Atenção: Cadastre primeiro um aparelho no sistema!</p>
                @endif
            </div>

            <!-- Campo Usuário/Técnico -->
            <div class="space-y-2">
                <label for="usuario_id" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Técnico Responsável</label>
                <select name="usuario_id" id="usuario_id" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/50 focus:border-apple-blue text-sm transition-all" required>
                    <option value="" disabled selected>Selecione o técnico</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->name }} ({{ $usuario->cargo }})
                        </option>
                    @endforeach
                </select>
                @if($usuarios->isEmpty())
                    <p class="text-xs text-rose-500 mt-1 font-semibold">Atenção: Cadastre primeiro um funcionário no sistema!</p>
                @endif
            </div>

            <!-- Campo Descrição do Problema -->
            <div class="space-y-2">
                <label for="descricao_problema" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Descrição do Problema</label>
                <textarea name="descricao_problema" id="descricao_problema" rows="4" placeholder="Descreva os defeitos relatados pelo cliente e testes preliminares..." class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/50 focus:border-apple-blue text-sm transition-all" required>{{ old('descricao_problema') }}</textarea>
            </div>

            <!-- Campo Status da Manutenção -->
            <div class="space-y-2">
                <label for="status" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Status da Manutenção</label>
                <select name="status" id="status" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/50 focus:border-apple-blue text-sm transition-all" required>
                    <option value="Pendente" {{ old('status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="Em Análise" {{ old('status') == 'Em Análise' ? 'selected' : '' }}>Em Análise</option>
                    <option value="Concluído" {{ old('status') == 'Concluído' ? 'selected' : '' }}>Concluído</option>
                </select>
            </div>

            <!-- Campo Data de Entrada -->
            <div class="space-y-2">
                <label for="data_entrada" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Data e Hora de Entrada</label>
                <input type="datetime-local" name="data_entrada" id="data_entrada" value="{{ old('data_entrada', now()->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/50 focus:border-apple-blue text-sm transition-all" required>
            </div>

            <!-- Botões de Ação -->
            <div class="pt-4 border-t border-gray-100 dark:border-zinc-800 flex items-center justify-end space-x-4">
                <a href="{{ route('manutencoes.index') }}" class="px-5 py-2.5 rounded-full text-xs font-bold border border-gray-300 dark:border-zinc-800 text-apple-black dark:text-white hover:bg-gray-50 dark:hover:bg-zinc-800 transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-full text-xs font-bold text-white bg-apple-blue hover:bg-blue-600 hover:shadow-lg disabled:opacity-50 transition-all duration-200" {{ ($aparelhos->isEmpty() || $usuarios->isEmpty()) ? 'disabled' : '' }}>
                    Registrar Ordem
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

