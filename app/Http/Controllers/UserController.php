<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function getLogin() {
        return view('admin.login');
    } 

    public function logar(Request $req) {
        $input = $req->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $req->email)->first();

        

        if(Crypt::decrypt($user->password) == $req->password) {
            $req->session()->put('user', $user);
            return redirect('/admin');
        } else {
            return redirect('/admin', ['errorMsg' => 'Email ou senha erradams']);
        }
    }
}
