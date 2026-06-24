@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6 animate-slide-up">
    
    <!-- Cabeçalho -->
    <div>
        <a href="{{ route('aparelhos.index') }}" class="inline-flex items-center text-xs font-bold text-apple-gray dark:text-gray-400 hover:text-apple-blue dark:hover:text-blue-400 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Voltar para o inventário
        </a>
        <h1 class="text-3xl font-extrabold tracking-tight text-apple-black dark:text-white mt-2">Editar Aparelho</h1>
        <p class="text-sm text-apple-gray dark:text-gray-400 mt-1">Altere as informações cadastrais do aparelho.</p>
    </div>

    <!-- Formulário -->
    <div class="bg-white dark:bg-zinc-900 p-8 rounded-3xl border border-gray-200/60 dark:border-zinc-800/80 shadow-sm transition-colors duration-300">
        <form action="{{ route('aparelhos.update', $aparelho->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Campo Modelo -->
            <div class="space-y-2">
                <label for="modelo" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Modelo do Aparelho</label>
                <input type="text" name="modelo" id="modelo" value="{{ old('modelo', $aparelho->modelo) }}" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/55 focus:border-apple-blue text-sm transition-all" required>
            </div>

            <!-- Campo Tipo -->
            <div class="space-y-2">
                <label for="tipo" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Tipo de Produto</label>
                <select name="tipo" id="tipo" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/55 focus:border-apple-blue text-sm transition-all" required>
                    <option value="iPhone" {{ old('tipo', $aparelho->tipo) == 'iPhone' ? 'selected' : '' }}>iPhone</option>
                    <option value="Mac" {{ old('tipo', $aparelho->tipo) == 'Mac' ? 'selected' : '' }}>Mac</option>
                    <option value="iPad" {{ old('tipo', $aparelho->tipo) == 'iPad' ? 'selected' : '' }}>iPad</option>
                    <option value="Outros" {{ old('tipo', $aparelho->tipo) == 'Outros' ? 'selected' : '' }}>Outros (Apple Watch, AirPods, etc.)</option>
                </select>
            </div>

            <!-- Campo Número de Série -->
            <div class="space-y-2">
                <label for="numero_serie" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Número de Série</label>
                <input type="text" name="numero_serie" id="numero_serie" value="{{ old('numero_serie', $aparelho->numero_serie) }}" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/55 focus:border-apple-blue text-sm font-mono transition-all" required>
            </div>

            <!-- Campo Status -->
            <div class="space-y-2">
                <label for="status" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Status</label>
                <select name="status" id="status" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/55 focus:border-apple-blue text-sm transition-all" required>
                    <option value="Disponível" {{ old('status', $aparelho->status) == 'Disponível' ? 'selected' : '' }}>Disponível</option>
                    <option value="Em Uso" {{ old('status', $aparelho->status) == 'Em Uso' ? 'selected' : '' }}>Em Uso</option>
                    <option value="Em Manutenção" {{ old('status', $aparelho->status) == 'Em Manutenção' ? 'selected' : '' }}>Em Manutenção</option>
                    <option value="Descartado" {{ old('status', $aparelho->status) == 'Descartado' ? 'selected' : '' }}>Descartado</option>
                </select>
            </div>

            <!-- Botões de Ação -->
            <div class="pt-4 border-t border-gray-100 dark:border-zinc-800 flex items-center justify-end space-x-4">
                <a href="{{ route('aparelhos.index') }}" class="px-5 py-2.5 rounded-full text-xs font-bold border border-gray-300 dark:border-zinc-800 text-apple-black dark:text-white hover:bg-gray-50 dark:hover:bg-zinc-800 transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-full text-xs font-bold text-white bg-apple-blue hover:bg-blue-600 hover:shadow-lg transition-all duration-200">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

