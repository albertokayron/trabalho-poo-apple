<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Manutencao;
use App\Models\Aparelho;
use App\Models\User;

class ManutencaoController extends Controller
{
    
    public function index()
    {
        
        $manutencoes = Manutencao::with(['aparelho', 'tecnico'])->latest()->get();

        return view('manutencoes.index', compact('manutencoes'));
    }

    
    public function create()
    {
        
        $aparelhos = Aparelho::all();
        $usuarios = User::all();

        return view('manutencoes.create', compact('aparelhos', 'usuarios'));
    }

    
    public function store(Request $request)
    {
        
        $request->validate([
            'aparelho_id' => 'required|exists:aparelhos,id',
            'usuario_id' => 'required|exists:users,id',
            'descricao_problema' => 'required|string',
            'status' => 'required|string|in:Pendente,Em Análise,Concluído',
            'data_entrada' => 'required|date',
        ]);

        
        Manutencao::create([
            'aparelho_id' => $request->aparelho_id,
            'usuario_id' => $request->usuario_id,
            'descricao_problema' => $request->descricao_problema,
            'status' => $request->status,
            'data_entrada' => $request->data_entrada,
        ]);

        
        $aparelho = Aparelho::find($request->aparelho_id);
        if ($aparelho && $request->status !== 'Concluído') {
            $aparelho->update(['status' => 'Em Manutenção']);
        }

        return redirect()->route('manutencoes.index')->with('success', 'Registro de manutenção criado com sucesso!');
    }

    
    public function show(string $id)
    {
        return redirect()->route('manutencoes.index');
    }

    
    public function edit(string $id)
    {
        $manutencao = Manutencao::findOrFail($id);
        $aparelhos = Aparelho::all();
        $usuarios = User::all();

        return view('manutencoes.edit', compact('manutencao', 'aparelhos', 'usuarios'));
    }

    
    public function update(Request $request, string $id)
    {
        $manutencao = Manutencao::findOrFail($id);

        
        $request->validate([
            'aparelho_id' => 'required|exists:aparelhos,id',
            'usuario_id' => 'required|exists:users,id',
            'descricao_problema' => 'required|string',
            'status' => 'required|string|in:Pendente,Em Análise,Concluído',
            'data_entrada' => 'required|date',
        ]);

        
        $manutencao->update([
            'aparelho_id' => $request->aparelho_id,
            'usuario_id' => $request->usuario_id,
            'descricao_problema' => $request->descricao_problema,
            'status' => $request->status,
            'data_entrada' => $request->data_entrada,
        ]);

        
        $aparelho = Aparelho::find($request->aparelho_id);
        if ($aparelho) {
            if ($request->status === 'Concluído') {
                $aparelho->update(['status' => 'Disponível']);
            } else {
                $aparelho->update(['status' => 'Em Manutenção']);
            }
        }

        return redirect()->route('manutencoes.index')->with('success', 'Registro de manutenção atualizado com sucesso!');
    }

    
    public function destroy(string $id)
    {
        $manutencao = Manutencao::findOrFail($id);
        $manutencao->delete();

        return redirect()->route('manutencoes.index')->with('success', 'Registro de manutenção excluído com sucesso!');
    }
}
