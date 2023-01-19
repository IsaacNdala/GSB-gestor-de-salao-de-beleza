<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

use PDF;

class ClienteController extends Controller
{
    public function listar() {
        $clientes = Cliente::all();

        return view('admin.clientes.listar', [
            'activeLink' => "clientes",
            'clientes' => $clientes
        ]);
    }

    public function getOne(Cliente $cliente) {
        $cliente->load('user');

        return view('admin.clientes.detalhes', [
            'activeLink' => "clientes",
            'cliente' => $cliente
        ]);
    }


    // Pega a Pagina de Cadastro
    public function getCadastro() {
        return view('admin.clientes.cadastrar', [
            'activeLink' => "clientes",
        ]);
    }

    // Metodo Para Cadastrar cliente
    public function cadastrar(Request $req) {
        // Criando usuario
        $userInput = $req->validate([
            'nome' => 'required|string',
            'sexo' => 'required|string',
            'tel' => 'required|string',
            'morada' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'imagem' => 'file'
        ]);

        $userInput['password'] = Crypt::encrypt($userInput['password']);
        
        // Verifica se o email já existe
        $emailExist = User::where('email', $req->email)->first();
        if ($emailExist) {
            return redirect('/admin/clientes/cadastrar')->with(['errorMsg' => 'O email ' .$req->email. ' já existe']);
        }

        // Verifica se o telefone já existe
        $telExist = User::where('tel', $req->tel)->first();
        if ($telExist) {
            return redirect('/admin/clientes/cadastrar')->with(['errorMsg' => 'O telefone ' .$req->tel. ' já existe']);
        }

        $file = $userInput['imagem'];
        $path = $file->store('images', 'public');
        $userInput['imagem'] = $path;

        $user = User::create($userInput);

        $input = ['user_id' => $user->id ];

        Cliente::create($input);

        return redirect('/admin/clientes')->with(['msg' => 'Cliente Cadastrado Com Sucesso']);
    }

    // Metodo Para Editar Cliente
    public function editar(Request $req) {
        // Criando usuario
        $userInput = $req->validate([
            'nome' => 'required|string',
            'sexo' => 'required|string',
            'tel' => 'required|string',
            'morada' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'imagem' => 'file'
        ]);

        $userInput['password'] = Crypt::encrypt($userInput['password']);

        $cliente = Cliente::find($req->cliente_id);
        $user = User::find($cliente->user_id);

         // Verifica se o email já existe
        $emailExist = User::where('email', $req->email)->where('id', '!=', $user->id)->first();
        if ($emailExist) {
            return redirect('/admin/clientes/editar/' . $cliente->id)->with(['errorMsg' => 'O email ' .$req->email. ' já existe']);
        }

        // Verifica se o telefone já existe
        $telExist = User::where('tel', $req->tel)->where('id', '!=', $user->id)->first();
        if ($telExist) {
            return redirect('/admin/clientes/editar/' . $cliente->id)->with(['errorMsg' => 'O telefone ' .$req->tel. ' já existe']);
        }

        // Upload de Imagem
        $file = $userInput['imagem'];
        $path = $file->store('images', 'public');
        $userInput['imagem'] = $path;

        Storage::delete($user->imagem);
        
        $user->fill($userInput);
        $user->save();

        return redirect('/admin/clientes')->with(['msg' => 'Cliente editado com sucesso']);
    }

    public function getEdit($id) {
        $cliente = Cliente::find($id);
        
        $passowrd = Crypt::decrypt($cliente->user->password);

        return view('admin.clientes.editar', [
            'activeLink' => 'clientes',
            'cliente' => $cliente,
            'password' => $passowrd
        ]);
    }

    // Metodo Para Deletar Cliente
    public function deletar(Request $req) {

        $user = User::find($req->user_id);

        Storage::delete($user->imagem);

        $user->delete();

        return redirect('/admin/clientes')->with(['msg' => 'Cliente eliminado com successo!']);
    }

    public function exportarPDF() {
        $clientes = Cliente::all();
        
        $pdf = PDF::loadView('admin.clientes.pdf', [
            'clientes' => $clientes
        ]);

        return $pdf->stream('clientes.pdf');
    }
}
