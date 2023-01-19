<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Agenda;
use App\Models\Servico;
use App\Models\Funcionario;

class DashboardController extends Controller
{
    public function index() {

        $clientes = Cliente::all();
        $servicos = Servico::all();
        $agendas = Agenda::where('status', '!=', 'Finalizado')->get();
        // $clientes = Cliente::all();

        return view('admin.index', [
            'activeLink' => 'dashboard',
            'clientes' => $clientes,
            'agendas' => $agendas,
            'servicos' => $servicos
        ]);
    }
}
