<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aparelho;

class AparelhoController extends Controller
{
    
    public function index()
    {
        
        $aparelhos = Aparelho::latest()->get();

        return view('aparelhos.index', compact('aparelhos'));
    }

    
    public function create()
    {
        return view('aparelhos.create');
    }

    
    public function store(Request $request)
    {
        
        $request->validate([
            'modelo' => 'required|string|max:255',
            'tipo' => 'required|string|in:iPhone,Mac,iPad,Outros',
            'numero_serie' => 'required|string|unique:aparelhos,numero_serie|max:255',
            'status' => 'required|string|in:Disponível,Em Uso,Em Manutenção,Descartado',
        ]);

        
        Aparelho::create([
            'modelo' => $request->modelo,
            'tipo' => $request->tipo,
            'numero_serie' => $request->numero_serie,
            'status' => $request->status,
        ]);

        return redirect()->route('aparelhos.index')->with('success', 'Aparelho cadastrado com sucesso!');
    }

    
    public function show(string $id)
    {
        return redirect()->route('aparelhos.index');
    }

    
    public function edit(string $id)
    {
        $aparelho = Aparelho::findOrFail($id);

        return view('aparelhos.edit', compact('aparelho'));
    }

    
    public function update(Request $request, string $id)
    {
        $aparelho = Aparelho::findOrFail($id);

        
        $request->validate([
            'modelo' => 'required|string|max:255',
            'tipo' => 'required|string|in:iPhone,Mac,iPad,Outros',
            'numero_serie' => 'required|string|max:255|unique:aparelhos,numero_serie,' . $aparelho->id,
            'status' => 'required|string|in:Disponível,Em Uso,Em Manutenção,Descartado',
        ]);

        
        $aparelho->update([
            'modelo' => $request->modelo,
            'tipo' => $request->tipo,
            'numero_serie' => $request->numero_serie,
            'status' => $request->status,
        ]);

        return redirect()->route('aparelhos.index')->with('success', 'Aparelho atualizado com sucesso!');
    }

    
    public function destroy(string $id)
    {
        $aparelho = Aparelho::findOrFail($id);
        $aparelho->delete();

        return redirect()->route('aparelhos.index')->with('success', 'Aparelho excluído com sucesso!');
    }
}
