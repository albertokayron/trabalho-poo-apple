@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    
    <!-- Cabeçalho -->
    <div>
        <a href="{{ route('aparelhos.index') }}" class="text-xs font-semibold text-apple-gray hover:text-apple-black transition-colors">&larr; Voltar para a lista</a>
        <h1 class="text-3xl font-bold tracking-tight text-apple-black mt-2">Editar Aparelho</h1>
        <p class="text-sm text-apple-gray mt-1">Altere as informações cadastrais do aparelho.</p>
    </div>

    <!-- Formulário -->
    <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
        <form action="{{ route('aparelhos.update', $aparelho->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Campo Modelo -->
            <div>
                <label for="modelo" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">Modelo do Aparelho</label>
                <input type="text" name="modelo" id="modelo" value="{{ old('modelo', $aparelho->modelo) }}" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm transition-all" required>
            </div>

            <!-- Campo Tipo -->
            <div>
                <label for="tipo" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">Tipo de Produto</label>
                <select name="tipo" id="tipo" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm transition-all" required>
                    <option value="iPhone" {{ old('tipo', $aparelho->tipo) == 'iPhone' ? 'selected' : '' }}>iPhone</option>
                    <option value="Mac" {{ old('tipo', $aparelho->tipo) == 'Mac' ? 'selected' : '' }}>Mac</option>
                    <option value="iPad" {{ old('tipo', $aparelho->tipo) == 'iPad' ? 'selected' : '' }}>iPad</option>
                    <option value="Outros" {{ old('tipo', $aparelho->tipo) == 'Outros' ? 'selected' : '' }}>Outros (Apple Watch, AirPods, etc.)</option>
                </select>
            </div>

            <!-- Campo Número de Série -->
            <div>
                <label for="numero_serie" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">Número de Série</label>
                <input type="text" name="numero_serie" id="numero_serie" value="{{ old('numero_serie', $aparelho->numero_serie) }}" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm font-mono transition-all" required>
            </div>

            <!-- Campo Status -->
            <div>
                <label for="status" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">Status</label>
                <select name="status" id="status" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm transition-all" required>
                    <option value="Disponível" {{ old('status', $aparelho->status) == 'Disponível' ? 'selected' : '' }}>Disponível</option>
                    <option value="Em Uso" {{ old('status', $aparelho->status) == 'Em Uso' ? 'selected' : '' }}>Em Uso</option>
                    <option value="Em Manutenção" {{ old('status', $aparelho->status) == 'Em Manutenção' ? 'selected' : '' }}>Em Manutenção</option>
                    <option value="Descartado" {{ old('status', $aparelho->status) == 'Descartado' ? 'selected' : '' }}>Descartado</option>
                </select>
            </div>

            <!-- Botões de Ação -->
            <div class="pt-4 border-t border-gray-100 flex items-center justify-end space-x-4">
                <a href="{{ route('aparelhos.index') }}" class="px-5 py-2.5 rounded-full text-xs font-semibold border border-gray-300 text-apple-black hover:bg-gray-50 transition-all duration-200">
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
