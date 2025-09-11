<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Validation\Rule; ;
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

        if ($request->has('ativo') && $request->ativo != '') {
            $query->where('ativo', '=', $request->ativo);
        }

        $sortField = $request->get('sort', 'nome');
        $sortDirection = $request->get('direction', 'asc');
        
        $clients = $query->orderBy($sortField, $sortDirection)
                        ->paginate(15)
                        ->appends($request->query());

        return view('clients.index_clients', [
            'clients' => $clients,
            'nomeOuEmail' => $request->input('nomeOuEmail', ''),
            'telefone' => $request->input('telefone', ''),
            'ativo' => $request->input('ativo', '')
        ]);
    }

     // CREATE - Formulário de criação
    public function create()
    {
        return view('clients.create_client');
    }

    // STORE - Salvar novo cliente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|min:3',
            'tipoPessoa' => 'required|in:F,J',
            'documento' => [
                'required',
                'string',
                'max:18',
                function ($attribute, $value, $fail) use ($request) {
                    // Remove caracteres não numéricos
                    $doc = preg_replace('/[^0-9]/', '', $value);
                    
                    // Valida CPF
                    if ($request->tipoPessoa == 'F' && strlen($doc) === 11) {
                        if (!validateCPF($doc)) {
                            $fail('CPF inválido.');
                            session()->flash('warning', 'CPF inválido.');
                        }
                    }
                    // Valida CNPJ
                    elseif ($request->tipoPessoa == 'J' && strlen($doc) === 14) {
                        if (!validateCNPJ($doc)) {
                            $fail('CNPJ inválido.');
                            session()->flash('warning', 'CNPJ inválido.');
                        }
                    } else {
                        $fail('Documento inválido para o tipo selecionado.');
                        session()->flash('warning', 'Documento inválido para o tipo selecionado.');
                    }

                    // Verifica se já existe
                    $exists = Client::where('documento', $doc)
                        ->when($request->has('id'), function($query) use ($request) {
                            $query->where('id', '!=', $request->id);
                        })
                        ->exists();

                    if ($exists) {
                        $fail('Este documento já está cadastrados.');
                        session()->flash('warning', 'Este documento já está cadastrado no sistema.');
                    }
                }
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('cliente', 'email')->ignore($request->id)
            ],
            'telefone' => 'required|string|max:20|min:10',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:100',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|size:2|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            'cep' => 'required|string|max:9|min:8',
            'ativo' => 'required|boolean'
        ], [
            // Mensagens customizadas
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'documento.required' => 'CPF/CNPJ é obrigatório.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'email.email' => 'Informe um e-mail válido.',
            'estado.in' => 'Selecione um estado válido.',
            'cep.min' => 'CEP inválido.'
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Cliente criado com sucesso!');
    }

    // SHOW - Visualizar cliente (opcional)
    public function show(Client $client)
    {
        return view('clients.show_client', compact('client'));
    }


    // EDIT - Formulário de edição
    public function edit(Client $client) // Route Model Binding
    {
        return view('clients.edit_client', compact('client'));
    }

    // UPDATE - Atualizar cliente
    public function update(Request $request, Client $client)
    {
        // Reutiliza as mesmas regras de validação
        $validated = $request->validate([
            'nome' => 'required|string|max:255|min:3',
            'tipoPessoa' => 'required|in:F,J',
            'documento' => [
                'required',
                'string',
                'max:18',
                function ($attribute, $value, $fail) use ($request, $client) {
                    $doc = preg_replace('/[^0-9]/', '', $value);
                    
                    if ($request->tipoPessoa == 'F' && strlen($doc) === 11) {
                        if (!validateCPF($doc)) {
                            $fail('CPF inválido.');
                            session()->flash('warning', 'CPF inválido.');
                        }
                    }
                    elseif ($request->tipoPessoa == 'J' && strlen($doc) === 14) {
                        if (!validateCNPJ($doc)) {
                            $fail('CNPJ inválido.');
                            session()->flash('warning', 'CNPJ inválido.');
                        }
                    } else {
                        $fail('Documento inválido para o tipo selecionado.');
                        session()->flash('warning', 'Documento inválido para o tipo selecionado.');
                    }
                    
                    // Verifica se já existe, ignorando o atual
                    $exists = Client::where('documento', $doc)
                        ->where('id', '!=', $client->id)
                        ->exists();
                        
                    if ($exists) {
                        $fail('Este documento já está cadastrado');
                        session()->flash('warning', 'Este documento já está cadastrado no sistema.');
                    }
                }
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('cliente', 'email')->ignore($client->id)
            ],
            'telefone' => 'required|string|max:20|min:10',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:100',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|size:2|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            'cep' => 'required|string|max:9|min:8',
            'ativo' => 'required|boolean'
        ]);

        $request->merge(['ativo' => $request->has('ativo')]);
        
        $client->update($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    // DESTROY - Excluir cliente
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente excluído com sucesso!');
    }

}