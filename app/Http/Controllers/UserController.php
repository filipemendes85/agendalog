<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carrier as Transportadora;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $transportadoras = Transportadora::orderBy('nome')->get();
        $query = User::query();

        if ($request->has('transportadoraId') && $request->input('transportadoraId') != "")
            $query->where('transportadora_id', '=', $request->input('transportadoraId'));

        if ($request->has('active') && $request->input('active') != "")
            $query->where('active', '=', $request->input('active'));

        if ($request->has('nomeOuEmail')){
            $query->where(function ($q) use ($request) {
                    $q->where('users.name', 'like', '%'.$request->input('nomeOuEmail').'%')
                        ->orWhere('users.email', 'like', '%'.$request->input('nomeOuEmail').'%');
            });
        }
        
        $users = $query->sortable()->paginate(10)->withQueryString();

        return view('users.index', ['users' => $users, 
                        'transportadoras' => $transportadoras,
                        'transportadoraId' => $request->input('transportadoraId'), 
                        'nomeOuEmail' => $request->input('nomeOuEmail'),
                        'active' => $request->input('active')]);

        // return view('pages/home', ['usuarios' => $users,  
        //                             'transportadoras' => $transportadoras,  
        //                             'transportadoraId' =>  $request->input('transportadoraId'), 
        //                             'nomeOuEmail' => $request->input('nomeOuEmail')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transportadoras = Transportadora::orderBy('nome')->get();
        $query = User::query();

        return view('users.form', ['transportadoras' => $transportadoras, 'transportadoraId' => null ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        //Realiza validação dos campos
        $validator = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|string|email|max:255|unique:users']
        );

        //'password' => 'required|string|min:6|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/|confirmed']

        //Faz o envio do email para definição

        // Se passou na validação e fez o envio do e-mail cria usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60)
        ]);

        $response = Password::sendResetLink(
            $request->only('email')
        );
    
        //Se não conseguiu fazer o disparo, devolve a mensagem de erro 
        if ($response !== Password::RESET_LINK_SENT)
            return redirect()->back()->withErrors(['field' => 'Falha ao enviar e-mail para o e-mail informado'])->withInput();
        else
            return redirect()->route('users.index')->with('message', 'Usuário salvo com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.form', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, Request $request)
    {
        $transportadoras = Transportadora::orderBy('nome')->get();
        return view('users.form', compact('user', 'transportadoras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        
        $regras = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255'];
        
        $request->validate($regras);

        $query = User::query();
        $userExists = $query->where('email', '=', $request->input('email'))->where('id', '<>', $user->id)->first();
        if ($userExists){
            return redirect()->back()->withErrors(['field' => 'E-mail já informado para outro usuário'])->withInput();
        }
        
        if ($request->input('email') != $user->email ){
            $user->forceFill(['email_verified_at' => null])->save();
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->transportadora_id = $request->input('transportadora_id');
        $user->active = $request->input('active') ? 1 : 0;
        $user->save();


        return redirect()->route('users.index', $request->query())
                          ->with('message', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Request $request)
    {
        try {
            $user->delete();
            return redirect()->route('users.index', $request->query())
                        ->with('message', 'Usuário excluído com sucesso!');    
        } catch(Exception $e){
            return redirect()->route('users.index', $request->query())
                        ->with('error', 'Falha ao excluir: ' + $e->getMessage());    
        }
        
    }

    public function resetpws(User $user, Request $request){
        
        $response = Password::sendResetLink(
            ['email' =>  $user->email]
        );
        
        return $response === Password::RESET_LINK_SENT
            ? redirect()->route('users.index', $request->query())->with('message', 'E-mail para redefinir senha enviado com sucesso!')
            : redirect()->back()->withErrors(['field' => 'Falha ao enviar e-mail para o e-mail do usuário.'])->withInput();
      
    }

    public function resend(User $user, Request $request){
        
        $erro = null;
        
        $user = User::where('email', $user->email)->first();
        
        if ($user){
            if ($user->hasVerifiedEmail()) {
                $erro = ['field' => 'E-mail já verificado.'];
            }
            else
                $user->sendEmailVerificationNotification();
        } else {
            $erro = ['field' => 'Usuário não encontrado.'];
        }

        return $erro == null ? redirect()->route('users.index', $request->query())->with('message', 'E-mail de verificação enviado!')
            : redirect()->back()->withErrors($erro)->withInput();
    }
}
