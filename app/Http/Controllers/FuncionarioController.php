<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class FuncionarioController extends Controller
{
    public function listar() {
        $funcionarios = Funcionario::all();

        return view('admin.funcionarios.listar', [
            'activeLink' => "funcionarios",
            'funcionarios' => $funcionarios
        ]);
    }

    public function getOne(Funcionario $funcionario) {
        $funcionario->load('user');

        return view('admin.funcionarios.detalhes', [
            'activeLink' => "funcionarios",
            'funcionario' => $funcionario
        ]);
    }


    // Pega a Pagina de Cadastro
    public function getCadastro() {
        return view('admin.funcionarios.cadastrar', [
            'activeLink' => "funcionarios",
        ]);
    }

    // Metodo Para Cadastrar Funcionario
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
        
        $emailExist = User::where('email', $req->email)->first();

        // Verifica se o email já existe
        if ($emailExist) {
            return redirect('/admin/funcionarios/cadastrar')->with(['errorMsg' => 'O email ' .$req->email. ' já existe']);
        }

        // Verifica se o telefone já existe
        $telExist = User::where('tel', $req->tel)->first();
        if ($telExist) {
            return redirect('/admin/funcionarios/cadastrar')->with(['errorMsg' => 'O telefone ' .$req->tel. ' já existe']);
        }

        $input = $req->validate([
            'data_nascimento' => 'required|string',
            'bi' => 'required|string',
            'funcao' => 'required|string',
            'salario' => 'required',
        ]);

        // Verifica se o bi já existe
        $biExist = Funcionario::where('bi', $req->bi)->first();
        if ($biExist) {
            return redirect('/admin/funcionarios/cadastrar')->with(['errorMsg' => 'O numero do BI ' .$req->bi. ' já existe']);
        }

        $file = $userInput['imagem'];
        $path = $file->store('images', 'public');
        $userInput['imagem'] = $path;

        $user = User::create($userInput);

        $input['user_id'] = $user->id;

        Funcionario::create($input);

        return redirect('/admin/funcionarios')->with(['msg' => 'Funcionário Cadastrado Com Sucesso']);
    }

    public function getEdit($id) {
        $funcionario = Funcionario::find($id);

        $passowrd = Crypt::decrypt($funcionario->user->password);

        return view('admin.funcionarios.editar', [
            'activeLink' => 'funcionarios',
            'funcionario' => $funcionario,
            'password' => $passowrd
        ]);
    }

    // Metodo Para Editar Funcionario
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

        $funcionario = Funcionario::find($req->fun_id);
        $user = User::find($funcionario->user_id);

        // Verifica se o email já existe
        $emailExist = User::where('email', $req->email)->where('id', '!=', $user->id)->first();
        if ($emailExist) {
            return redirect('/admin/funcionarios/editar/' . $funcionario->id)->with(['errorMsg' => 'O email ' .$req->email. ' já existe']);
        }

        // Verifica se o telefone já existe
        $telExist = User::where('tel', $req->tel)->where('id', '!=', $user->id)->first();
        if ($telExist) {
            return redirect('/admin/funcionarios/editar' . $funcionario->id)->with(['errorMsg' => 'O telefone ' .$req->tel. ' já existe']);
        }

        $input = $req->validate([
            'data_nascimento' => 'required|string',
            'bi' => 'required|string',
            'funcao' => 'required|string',
            'salario' => 'required',
        ]);


        // Verifica se o bi já existe
        $biExist = Funcionario::where('bi', $req->bi)->where('id', '!=', $funcionario->id)->first();
        if ($biExist) {
            return redirect('/admin/funcionarios/editar' . $funcionario->id)->with(['errorMsg' => 'O numero do BI ' .$req->bi. ' já existe']);
        }

        $file = $userInput['imagem'];
        $path = $file->store('images', 'public');
        $userInput['imagem'] = $path;

        Storage::delete($user->imagem);
        
        $user->fill($userInput);
        $funcionario->fill($input);

        $user->save();
        $funcionario->save();

        return redirect('/admin/funcionarios')->with(['msg' => 'Funcionário editado com sucesso']);
    }

    // Metodo Para Deletar Funcionario
    public function deletar(Request $req) {

        $user = User::find($req->user_id);

        Storage::delete($user->imagem);

        $user->delete();

        return redirect('/admin/funcionarios')->with(['msg' => 'Funcionário eliminado com successo!']);
    }
}
