<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Models\Transportadora;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'cnpj' => 'required'
        ];

        $customMessages = [
            'name.required' => 'Nome é obrigatório.',
            'name.max' => 'Tamanho máximo de 100 caracteres.',
            'email.required' => 'E-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'email.unique' => 'E-mail informado já cadastrado',
            'password.required' => 'Senha é obrigatória',
            'password.min' => 'Tamanho mínimo de 6 caracteres',
            'cnpj.required' => 'CNPJ transportadora é obrigatório'

        ];
        $validation = $request->validate($rules, $customMessages);

        $erroRegras = array();


        $transportadora = Transportadora::where('documento', $request->input('cnpj'))
                                ->where('tipoPessoa', 'J')
                                ->first();

        if ($transportadora == null){
            array_push($erroRegras, "CNPJ informado não encontrado na base de dados"); 
        }

        if ( count($erroRegras) > 0 ){
            return redirect()->back()->withErrors($erroRegras)->withInput($validation);
        } 

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), // <<!nav>>Encripta a palavra-passe<<!/nav>>
        ]); 

        $user->save();


        event(new Registered($user));

        return redirect('/email/notice')->with('successLink', 'Você recebeu um email com link de verificação de acesso.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
