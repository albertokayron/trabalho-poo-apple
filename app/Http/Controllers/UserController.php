<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    
    public function index()
    {
        
        $usuarios = User::latest()->get();

        
        return view('usuarios.index', compact('usuarios'));
    }

    
    public function create()
    {
        return view('usuarios.create');
    }

    
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cargo' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cargo' => $request->cargo,
            'password' => bcrypt($request->password), 
        ]);

        
        return redirect()->route('usuarios.index')->with('success', 'Funcionário cadastrado com sucesso!');
    }

    
    public function show(string $id)
    {
        return redirect()->route('usuarios.index');
    }

    
    public function edit(string $id)
    {
        
        $usuario = User::findOrFail($id);

        return view('usuarios.edit', compact('usuario'));
    }

    
    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'cargo' => 'required|string|max:255',
            'password' => 'nullable|string|min:6', 
        ]);

        
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->cargo = $request->cargo;

        
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Dados do funcionário atualizados com sucesso!');
    }

    
    public function destroy(string $id)
    {
        $usuario = User::findOrFail($id);
        
        
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Funcionário excluído com sucesso!');
    }
}
