@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6 animate-slide-up">
    
    <!-- Cabeçalho -->
    <div>
        <a href="{{ route('usuarios.index') }}" class="inline-flex items-center text-xs font-bold text-apple-gray dark:text-gray-400 hover:text-apple-blue dark:hover:text-blue-400 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Voltar para a lista
        </a>
        <h1 class="text-3xl font-extrabold tracking-tight text-apple-black dark:text-white mt-2">Editar Funcionário</h1>
        <p class="text-sm text-apple-gray dark:text-gray-400 mt-1">Altere as informações cadastrais do funcionário.</p>
    </div>

    <!-- Formulário -->
    <div class="bg-white dark:bg-zinc-900 p-8 rounded-3xl border border-gray-200/60 dark:border-zinc-800/80 shadow-sm transition-colors duration-300">
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Campo Nome -->
            <div class="space-y-2">
                <label for="name" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Nome Completo</label>
                <input type="text" name="name" id="name" value="{{ old('name', $usuario->name) }}" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/55 focus:border-apple-blue text-sm transition-all" required>
            </div>

            <!-- Campo E-mail -->
            <div class="space-y-2">
                <label for="email" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">E-mail Corporativo</label>
                <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/55 focus:border-apple-blue text-sm transition-all" required>
            </div>

            <!-- Campo Cargo -->
            <div class="space-y-2">
                <label for="cargo" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Cargo</label>
                <select name="cargo" id="cargo" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-950 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/55 focus:border-apple-blue text-sm transition-all" required>
                    <option value="Técnico Genius" {{ old('cargo', $usuario->cargo) == 'Técnico Genius' ? 'selected' : '' }}>Técnico Genius</option>
                    <option value="Suporte Remoto" {{ old('cargo', $usuario->cargo) == 'Suporte Remoto' ? 'selected' : '' }}>Suporte Remoto</option>
                    <option value="Gerente de Loja" {{ old('cargo', $usuario->cargo) == 'Gerente de Loja' ? 'selected' : '' }}>Gerente de Loja</option>
                    <option value="Especialista de Produto" {{ old('cargo', $usuario->cargo) == 'Especialista de Produto' ? 'selected' : '' }}>Especialista de Produto</option>
                    <option value="Administrador" {{ old('cargo', $usuario->cargo) == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>

            <!-- Campo Senha (Opcional) -->
            <div class="space-y-2">
                <label for="password" class="block text-[10px] font-bold text-apple-black dark:text-zinc-300 uppercase tracking-widest">Nova Senha (Opcional)</label>
                <input type="password" name="password" id="password" placeholder="Deixe em branco para manter a senha atual" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-800 bg-white dark:bg-zinc-955 text-apple-black dark:text-white focus:outline-none focus:ring-2 focus:ring-apple-blue/55 focus:border-apple-blue text-sm transition-all">
                <p class="text-[10px] text-apple-gray dark:text-gray-400 mt-1">Preencha apenas se desejar redefinir a senha do funcionário.</p>
            </div>

            <!-- Botões de Ação -->
            <div class="pt-4 border-t border-gray-100 dark:border-zinc-800 flex items-center justify-end space-x-4">
                <a href="{{ route('usuarios.index') }}" class="px-5 py-2.5 rounded-full text-xs font-bold border border-gray-300 dark:border-zinc-800 text-apple-black dark:text-white hover:bg-gray-50 dark:hover:bg-zinc-800 transition-all duration-200">
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

