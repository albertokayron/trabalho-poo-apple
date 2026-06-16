<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aparelho;

class AparelhoController extends Controller
{
    /**
     * Exibe a listagem dos aparelhos.
     */
    public function index()
    {
        // Busca todos os aparelhos do mais recente para o mais antigo
        $aparelhos = Aparelho::latest()->get();

        return view('aparelhos.index', compact('aparelhos'));
    }

    /**
     * Exibe o formulário de cadastro de aparelhos.
     */
    public function create()
    {
        return view('aparelhos.create');
    }

    /**
     * Salva o novo aparelho no banco de dados.
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados (com campos obrigatórios e formato esperado)
        $request->validate([
            'modelo' => 'required|string|max:255',
            'tipo' => 'required|string|in:iPhone,Mac,iPad,Outros',
            'numero_serie' => 'required|string|unique:aparelhos,numero_serie|max:255',
            'status' => 'required|string|in:Disponível,Em Uso,Em Manutenção,Descartado',
        ]);

        // 2. Salva o registro no banco
        Aparelho::create([
            'modelo' => $request->modelo,
            'tipo' => $request->tipo,
            'numero_serie' => $request->numero_serie,
            'status' => $request->status,
        ]);

        return redirect()->route('aparelhos.index')->with('success', 'Aparelho cadastrado com sucesso!');
    }

    /**
     * Redireciona para listagem (detalhes não necessários para este CRUD).
     */
    public function show(string $id)
    {
        return redirect()->route('aparelhos.index');
    }

    /**
     * Exibe o formulário para editar um aparelho existente.
     */
    public function edit(string $id)
    {
        $aparelho = Aparelho::findOrFail($id);

        return view('aparelhos.edit', compact('aparelho'));
    }

    /**
     * Atualiza as informações do aparelho.
     */
    public function update(Request $request, string $id)
    {
        $aparelho = Aparelho::findOrFail($id);

        // 1. Validação (garante número de série único, ignorando o ID atual deste aparelho)
        $request->validate([
            'modelo' => 'required|string|max:255',
            'tipo' => 'required|string|in:iPhone,Mac,iPad,Outros',
            'numero_serie' => 'required|string|max:255|unique:aparelhos,numero_serie,' . $aparelho->id,
            'status' => 'required|string|in:Disponível,Em Uso,Em Manutenção,Descartado',
        ]);

        // 2. Atualização dos campos no banco
        $aparelho->update([
            'modelo' => $request->modelo,
            'tipo' => $request->tipo,
            'numero_serie' => $request->numero_serie,
            'status' => $request->status,
        ]);

        return redirect()->route('aparelhos.index')->with('success', 'Aparelho atualizado com sucesso!');
    }

    /**
     * Remove o aparelho do banco de dados.
     */
    public function destroy(string $id)
    {
        $aparelho = Aparelho::findOrFail($id);
        $aparelho->delete();

        return redirect()->route('aparelhos.index')->with('success', 'Aparelho excluído com sucesso!');
    }
}
