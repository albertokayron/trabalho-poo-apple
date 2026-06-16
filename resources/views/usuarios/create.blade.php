@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    
    <!-- Cabeçalho -->
    <div>
        <a href="{{ route('usuarios.index') }}" class="text-xs font-semibold text-apple-gray hover:text-apple-black transition-colors">&larr; Voltar para a lista</a>
        <h1 class="text-3xl font-bold tracking-tight text-apple-black mt-2">Novo Funcionário</h1>
        <p class="text-sm text-apple-gray mt-1">Insira os dados para cadastrar um novo funcionário de suporte.</p>
    </div>

    <!-- Formulário -->
    <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
        <form action="{{ route('usuarios.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Campo Nome -->
            <div>
                <label for="name" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">Nome Completo</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Ex: John Doe" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm transition-all" required>
            </div>

            <!-- Campo E-mail -->
            <div>
                <label for="email" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">E-mail Corporativo</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Ex: john.doe@apple.com" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm transition-all" required>
            </div>

            <!-- Campo Cargo -->
            <div>
                <label for="cargo" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">Cargo</label>
                <select name="cargo" id="cargo" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm transition-all" required>
                    <option value="" disabled selected>Selecione um cargo</option>
                    <option value="Técnico Genius">Técnico Genius</option>
                    <option value="Suporte Remoto">Suporte Remoto</option>
                    <option value="Gerente de Loja">Gerente de Loja</option>
                    <option value="Especialista de Produto">Especialista de Produto</option>
                    <option value="Administrador">Administrador</option>
                </select>
            </div>

            <!-- Campo Senha -->
            <div>
                <label for="password" class="block text-xs font-bold text-apple-black uppercase tracking-wider mb-2">Senha de Acesso</label>
                <input type="password" name="password" id="password" placeholder="Mínimo 6 caracteres" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-apple-black focus:border-apple-black text-sm transition-all" required>
            </div>

            <!-- Botões de Ação -->
            <div class="pt-4 border-t border-gray-100 flex items-center justify-end space-x-4">
                <a href="{{ route('usuarios.index') }}" class="px-5 py-2.5 rounded-full text-xs font-semibold border border-gray-300 text-apple-black hover:bg-gray-50 transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-full text-xs font-semibold text-white bg-apple-black hover:bg-black hover:shadow transition-all duration-200">
                    Cadastrar
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
