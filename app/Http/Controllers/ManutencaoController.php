<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Manutencao;
use App\Models\Aparelho;
use App\Models\User;

class ManutencaoController extends Controller
{
    /**
     * Exibe a listagem de registros de manutenção.
     */
    public function index()
    {
        // Recupera todas as manutenções pré-carregando o Aparelho e o Técnico responsável (evita problemas de performance)
        $manutencoes = Manutencao::with(['aparelho', 'tecnico'])->latest()->get();

        return view('manutencoes.index', compact('manutencoes'));
    }

    /**
     * Exibe o formulário de cadastro de manutenção.
     */
    public function create()
    {
        // Busca todos os aparelhos e usuários para que o estudante possa selecioná-los no formulário (<select>)
        $aparelhos = Aparelho::all();
        $usuarios = User::all();

        return view('manutencoes.create', compact('aparelhos', 'usuarios'));
    }

    /**
     * Salva o registro de manutenção no banco de dados.
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados
        $request->validate([
            'aparelho_id' => 'required|exists:aparelhos,id',
            'usuario_id' => 'required|exists:users,id',
            'descricao_problema' => 'required|string',
            'status' => 'required|string|in:Pendente,Em Análise,Concluído',
            'data_entrada' => 'required|date',
        ]);

        // 2. Criação do registro
        Manutencao::create([
            'aparelho_id' => $request->aparelho_id,
            'usuario_id' => $request->usuario_id,
            'descricao_problema' => $request->descricao_problema,
            'status' => $request->status,
            'data_entrada' => $request->data_entrada,
        ]);

        // 3. Lógica extra didática: Se a manutenção inicia pendente/em análise, mudamos o status do aparelho para "Em Manutenção"
        $aparelho = Aparelho::find($request->aparelho_id);
        if ($aparelho && $request->status !== 'Concluído') {
            $aparelho->update(['status' => 'Em Manutenção']);
        }

        return redirect()->route('manutencoes.index')->with('success', 'Registro de manutenção criado com sucesso!');
    }

    /**
     * Redireciona para index (detalhes não necessários).
     */
    public function show(string $id)
    {
        return redirect()->route('manutencoes.index');
    }

    /**
     * Exibe o formulário para editar uma manutenção existente.
     */
    public function edit(string $id)
    {
        $manutencao = Manutencao::findOrFail($id);
        $aparelhos = Aparelho::all();
        $usuarios = User::all();

        return view('manutencoes.edit', compact('manutencao', 'aparelhos', 'usuarios'));
    }

    /**
     * Atualiza as informações da manutenção no banco de dados.
     */
    public function update(Request $request, string $id)
    {
        $manutencao = Manutencao::findOrFail($id);

        // 1. Validação dos dados
        $request->validate([
            'aparelho_id' => 'required|exists:aparelhos,id',
            'usuario_id' => 'required|exists:users,id',
            'descricao_problema' => 'required|string',
            'status' => 'required|string|in:Pendente,Em Análise,Concluído',
            'data_entrada' => 'required|date',
        ]);

        // 2. Atualiza os dados
        $manutencao->update([
            'aparelho_id' => $request->aparelho_id,
            'usuario_id' => $request->usuario_id,
            'descricao_problema' => $request->descricao_problema,
            'status' => $request->status,
            'data_entrada' => $request->data_entrada,
        ]);

        // 3. Lógica didática: Se o status foi marcado como 'Concluído', liberamos o aparelho como 'Disponível'
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

    /**
     * Remove o registro de manutenção.
     */
    public function destroy(string $id)
    {
        $manutencao = Manutencao::findOrFail($id);
        $manutencao->delete();

        return redirect()->route('manutencoes.index')->with('success', 'Registro de manutenção excluído com sucesso!');
    }
}
