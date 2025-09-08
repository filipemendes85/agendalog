<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::query();

        if ($request->has('nomeOuEmail') && !empty($request->nomeOuEmail)) {
            $query->where(function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->nomeOuEmail . '%')
                  ->orWhere('email', 'like', '%' . $request->nomeOuEmail . '%');
            });
        }

        if ($request->has('telefone') && !empty($request->telefone)) {
            $query->where( 'telefone', 'like', '%' . $request->telefone . '%');
        }

        if ($request->has('ativo') && !empty($request->ativo)) {
            $query->where('ativo', $request->ativo);
        }

        $sortField = $request->get('sort', 'nome');
        $sortDirection = $request->get('direction', 'asc');
        
        $clients = $query->orderBy($sortField, $sortDirection)
                        ->paginate(15)
                        ->appends($request->query());

        return view('clients.index', [
            'clients' => $clients,
            'nomeOuEmail' => $request->input('nomeOuEmail', ''),
            'telefone' => $request->input('telefone', ''),
            'ativo' => $request->input('ativo', '')
        ]);
    }

     // CREATE - Formulário de criação
    public function create()
    {
        return view('clients.create');
    }

    // STORE - Salvar novo cliente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:cliente,email',
            'telefone' => 'nullable|string|max:20',
            'ativo' => 'required|boolean'
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Cliente criado com sucesso!');
    }

    // SHOW - Visualizar cliente (opcional)
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }


    // EDIT - Formulário de edição
    public function edit(Client $client) // Route Model Binding
    {
        return view('clients.edit', compact('client'));
    }

    // UPDATE - Atualizar cliente
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:cliente,email,' . $client->id,
            'telefone' => 'nullable|string|max:20',
            'ativo' => 'required|boolean'
        ]);

        $client->update($validated);
        
        return redirect()->route('clients.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    // DESTROY - Excluir cliente
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente excluído!');
    }

}