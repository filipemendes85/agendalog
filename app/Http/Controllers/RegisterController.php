<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Models\Carrier;
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
            'password' => 'required|string|min:6|regex:/[A-Z]/|regex:/[0-9]/|regex:/[^A-Za-z0-9]/|confirmed',
            'cnpj' => 'required'
        ];
        
        $validation = $request->validate($rules);

        $erroRegras = array();


        $transportadora = Carrier::where('documento', $request->input('cnpj'))
                                ->where('tipoPessoa', 'J')
                                ->first();

        if ($transportadora == null){
            array_push($erroRegras, "CNPJ informado não encontrado na base de dados"); 
        } else if ($transportadora->ativo == 0){
                array_push($erroRegras, "Transportadora inativada na base de dados."); 
        }

        if ( count($erroRegras) > 0 ){
            return redirect()->back()->withErrors($erroRegras)->withInput($validation);
        } 

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'transportadora_id' => $transportadora->id,
            'active' => 1, //registra como inativo
            'password' => bcrypt($request->input('password')),
        ]); 

        $user->save();


        event(new Registered($user));

        return redirect('/email/notice')->with('successLink', 'Você recebeu um e-mail com link de verificação de acesso.');
        
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
