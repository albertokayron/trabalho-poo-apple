@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto space-y-6 animate-slide-up">

        <!-- Cabeçalho -->
        <div>
            <a href="{{ route('aparelhos.index') }}"
                class="inline-flex items-center text-xs font-bold text-apple-gray dark:text-gray-400 hover:text-apple-blue dark:hover:text-blue-400 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                Voltar para o inventário
            </a>
            <h1 class="text-3xl font-extrabold tracking-tight text-apple-black dark:text-white mt-2">Novo Aparelho</h1>
            <p class="text-sm text-apple-gray dark:text-gray-400 mt-1">Insira os dados para adicionar um novo produto Apple ao inventário.</p>
        </div>

        <!-- Formulário -->
        <div class="bg-white dark:bg-zinc-900 p-8 rounded-3xl border border-gray-200/60 dark:border-zinc-800/80 shadow-sm transition-colors duration-300">
            <form action="{{ route('aparelhos.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Campo Modelo -->
                <div class="space-y-2">
                    <label for="modelo"
                        class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Modelo do Aparelho</label>
                    <input type="text" name="modelo" id="modelo" value="{{ old('modelo') }}"
                        placeholder="Ex: MacBook Pro 14 (M3)"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/50 focus:border-apple-blue text-sm transition-all"
                        required>
                </div>

                <!-- Campo Tipo -->
                <div class="space-y-2">
                    <label for="tipo" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Tipo de Produto</label>
                    <select name="tipo" id="tipo"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/50 focus:border-apple-blue text-sm transition-all"
                        required>
                        <option value="" disabled selected>Selecione o tipo</option>
                        <option value="iPhone">iPhone</option>
                        <option value="Mac">Mac</option>
                        <option value="iPad">iPad</option>
                        <option value="Outros">Outros (Apple Watch, AirPods, etc.)</option>
                    </select>
                </div>

                <!-- Campo Número de Série -->
                <div class="space-y-2">
                    <label for="numero_serie"
                        class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Número de Série (Único)</label>
                    <input type="text" name="numero_serie" id="numero_serie" value="{{ old('numero_serie') }}"
                        placeholder="Ex: SN-MBPM3-1234"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/50 focus:border-apple-blue text-sm font-mono transition-all"
                        required>
                </div>

                <!-- Campo Status -->
                <div class="space-y-2">
                    <label for="status"
                        class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Status Inicial</label>
                    <select name="status" id="status"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/50 focus:border-apple-blue text-sm transition-all"
                        required>
                        <option value="Disponível">Disponível</option>
                        <option value="Em Uso">Em Uso</option>
                        <option value="Em Manutenção">Em Manutenção</option>
                        <option value="Descartado">Descartado</option>
                    </select>
                </div>

                <!-- Botões de Ação -->
                <div class="pt-4 border-t border-gray-100 dark:border-zinc-800 flex items-center justify-end space-x-4">
                    <a href="{{ route('aparelhos.index') }}"
                        class="px-5 py-2.5 rounded-full text-xs font-bold border border-gray-300 dark:border-zinc-800 text-apple-black dark:text-white hover:bg-gray-50 dark:hover:bg-zinc-800 transition-all duration-200">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-full text-xs font-bold text-white bg-apple-blue hover:bg-blue-600 hover:shadow-lg transition-all duration-200">
                        Cadastrar Aparelho
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection