<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\User;
use App\Models\Servico;
use App\Models\Pagamento;
use App\Models\FormaPagamento;

class AgendaController extends Controller
{
    public function listar() {
        $agendas = Agenda::where('status', '!=', 'Finalizado')->get();
        $forma_pagamentos = FormaPagamento::all();

        return view('admin.agendas.listar', [
            'activeLink' => "agendas",
            'agendas' => $agendas,
            'forma_pagamentos' => $forma_pagamentos,
        ]);
    }

    public function getStepOne() {
        $clientes = Cliente::all();

        return view('admin.agendas.step_one', [
            'activeLink' => "agendas",
            'clientes' => $clientes
        ]);
    }

    public function postStepOne(Request $req) {
        $input = $req->validate([
            'data' => 'required|string',
            'hora_inicial' => 'required|string',
            'hora_final' => 'required|string',
            'cliente_id' => 'required|numeric'
        ]);

        $agendas = Agenda::whereRaw("data = '". $req->data ."'AND ( hora_inicial BETWEEN '". $req->hora_inicial."' AND '" . $req->hora_final ."' OR hora_final BETWEEN '". $req->hora_inicial. "' AND '" . $req->hora_final ."' )" )->get();

        $funcioarios = Funcionario::all();

        $funs = array();

        if(count($agendas) > 0 ) {
            foreach($agendas as $agenda) {
                foreach ($funcioarios as $funcioario) {
                    
                    if($funcioario->id != $agenda->funcionario_id) {
                        array_push($funs, $funcioario);
                    }
                }
            }
        } else {
            $funs = $funcioarios;
        }


        $clientes = Cliente::all();
        $servicos = Servico::all();

        return view('admin.agendas.agendar', [
            'activeLink' => "agendas",
            'clientes' => $clientes,
            'servicos' => $servicos,
            'funcionarios' => $funs,
            'data' => $req->data,
            'hora_inicial' => $req->hora_inicial,
            'hora_final' => $req->hora_final,
            'cliente_id' => $req->cliente_id,
        ]);
    }

    // Metodo Para Agendar Servico
    public function agendar(Request $req) {

        $input = $req->validate([
            'servico_id' => 'required|numeric',
            'cliente_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'data' => 'required|string',
            'hora_inicial' => 'required|string',
            'hora_final' => 'required|string',
            'status' => 'required|string'
        ]);

        Agenda::create($input);

        return redirect('/admin/agendas')->with(['msg' => 'Agendado Com Sucesso']);
    }


    public function finalizar(Request $req) {

        $agenda = Agenda::find($req->agenda_id);

        // $input = $req->validate([
        //     'forma_pagamento_id' => 'required',
        //     'user_id' => 'required',
        //     'cliente' => 'required',
        //     'user_id' => 'required',
        // ]);

        // Pagamento::create($input);

        $agenda->status = 'Finalizado';

        $agenda->save();

        return redirect('/admin/agendas')->with(['msg' => 'Finalizado com successo!']);
    }

    public function deletar(Request $req) {

        $agenda = Agenda::find($req->agenda_id);

        $agenda->delete();

        return redirect('/admin/agendas')->with(['msg' => 'Agenda eliminada com successo!']);
    }

    public function exportarPDF() {
        $agendas = Agenda::all();
        
        $pdf = PDF::loadView('admin.agendas.pdf', [
            'agendas' => $agendas
        ]);

        return $pdf->stream('agendas.pdf');
    }

}
