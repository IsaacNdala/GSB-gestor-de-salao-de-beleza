<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use PDF;

class ServicoController extends Controller
{
    public function listar() {
        $servicos = Servico::all();

        return view('admin.servicos.listar', [
            'activeLink' => "servicos",
            'servicos' => $servicos
        ]);
    }

    public function getOne(Servico $servico) {
        $servico->load('servico');

        return view('admin.servicos.detalhes', [
            'activeLink' => "servicos",
            'servico' => $servico
        ]);
    }


    // Pega a Pagina de Cadastro
    public function getCadastro() {
        return view('admin.servicos.cadastrar', [
            'activeLink' => "servicos",
        ]);
    }

    // Metodo Para Cadastrar servico
    public function cadastrar(Request $req) {

        $designacao = strtolower($req->designacao);

        $servicos = Servico::all();

        foreach($servicos as $servico) {
            if(strtolower($servico->designacao) == $designacao) {
                return redirect('/admin/servicos/cadastrar')->with(['errorMsg' =>' "' .$req->designacao . '" já foi cadastrado']);
            }
        }

        $input = $req->validate([
            'designacao' => 'required|string',
            'preco' => 'required|string',
            'user_id' => 'required|numeric',
        ]);

        Servico::create($input);

        return redirect('/admin/servicos')->with(['msg' => 'Serviço Cadastrado Com Sucesso']);
    }

    // Metodo Para Editar Servico
    public function editar(Request $req) {

        $input = $req->validate([
            'designacao' => 'required|string',
            'preco' => 'required|string',
        ]);

        $designacao = strtolower($req->designacao);

        $servicos = Servico::where('id', '!=', $req->servico_id)->get();

        foreach($servicos as $servico) {
            if(strtolower($servico->designacao) == $designacao) {
                return redirect('/admin/servicos/cadastrar')->with(['errorMsg' =>' "' .$req->designacao . '" já foi cadastrado']);
            }
        }

        $servico = Servico::find($req->servico_id);
        
        $servico->fill($input);
        $servico->save();

        return redirect('/admin/servicos')->with(['msg' => 'Serviço editado com sucesso']);
    }

    public function getEdit($id) {
        $servico = Servico::find($id);
        return view('admin.servicos.editar', [
            'activeLink' => 'servicos',
            'servico' => $servico
        ]);
    }

    // Metodo Para Deletar Servico
    public function deletar(Request $req) {

        $servico = Servico::find($req->servico_id);

        $servico->delete();

        return redirect('/admin/servicos')->with(['msg' => 'Serviço eliminado com successo!']);
    }

    public function exportarPDF() {
        $servicos = Servico::all();
        
        $pdf = PDF::loadView('admin.servicos.pdf', [
            'servicos' => $servicos
        ]);

        return $pdf->stream('servicos.pdf');
    }
}