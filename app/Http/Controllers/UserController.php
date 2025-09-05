<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transportadora;

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

        if ($request->has('nomeOuEmail')){
            $query->where(function ($q) use ($request) {
                    $q->where('users.name', 'like', '%'.$request->input('nomeOuEmail').'%')
                        ->orWhere('users.email', 'like', '%'.$request->input('nomeOuEmail').'%');
            });
        }
        
        $users = $query->sortable()->paginate(2)->withQueryString();

        return view('pages/usuario', ['users' => $users, 
                        'transportadoras' => $transportadoras,
                        'transportadoraId' => $request->input('transportadoraId'), 
                        'nomeOuEmail' => $request->input('nomeOuEmail')]);

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
        return view('pages/usuario-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages/usuario-form');
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
