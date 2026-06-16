<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Exibe a listagem de todos os funcionários.
     */
    public function index()
    {
        // Recupera todos os usuários cadastrados no banco de dados ordenados pelo mais recente
        $usuarios = User::latest()->get();

        // Retorna a view 'usuarios.index' passando a variável com os dados
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Mostra o formulário para cadastrar um novo funcionário.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Salva o novo funcionário no banco de dados.
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados enviados pelo formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cargo' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // 2. Criação do novo funcionário utilizando Mass Assignment
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cargo' => $request->cargo,
            'password' => bcrypt($request->password), // Criptografa a senha por segurança
        ]);

        // 3. Redireciona de volta para a listagem com uma mensagem de sucesso na sessão
        return redirect()->route('usuarios.index')->with('success', 'Funcionário cadastrado com sucesso!');
    }

    /**
     * Exibe um recurso específico (não necessário para este CRUD, redireciona para index).
     */
    public function show(string $id)
    {
        return redirect()->route('usuarios.index');
    }

    /**
     * Mostra o formulário para editar um funcionário existente.
     */
    public function edit(string $id)
    {
        // Encontra o usuário pelo ID ou gera erro 404 caso não exista
        $usuario = User::findOrFail($id);

        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Atualiza os dados do funcionário no banco de dados.
     */
    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        // 1. Validação (garantindo que o e-mail não entre em conflito com outros, exceto o dele mesmo)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'cargo' => 'required|string|max:255',
            'password' => 'nullable|string|min:6', // A senha é opcional na edição
        ]);

        // 2. Atualização dos campos normais
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->cargo = $request->cargo;

        // Se uma nova senha foi preenchida, nós a atualizamos criptografada
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Dados do funcionário atualizados com sucesso!');
    }

    /**
     * Remove o funcionário do banco de dados.
     */
    public function destroy(string $id)
    {
        $usuario = User::findOrFail($id);
        
        // Exclui o registro
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Funcionário excluído com sucesso!');
    }
}
