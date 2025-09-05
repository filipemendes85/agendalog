<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    //
    public function index(){
        return view('login');
    }

    public function login(Request $request){

        $rules = [
            'email' => 'required|email',
            'password' => 'required'
            
        ];

        $customMessages = [
            'email.required' => 'Usuário é obrigatório.',
            'email.email' => 'E-mail inválido',
            'password.required' => 'Senha é obrigatória'
        ];
        $credenciais = $request->validate($rules, $customMessages);


        if (Auth::attempt($credenciais)){
            $request->session()->regenerate();
            return redirect('index');
        }

        return back()->withInput()->with('loginErro', 'Usuário ou senha inválido!');
    }

    public function logout(Request $request){
        
        Auth::logout(); // Logs out the authenticated user

        $request->session()->invalidate(); // Invalidates the current session
        $request->session()->regenerateToken(); // Regenerates the CSRF token

        return redirect('/login'); // Redire

    }
   
}
