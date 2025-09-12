<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use Illuminate\Validation\Rule; ;
use Illuminate\Http\Request; 

class CarrierController extends Controller
{
    public function index(Request $request)
    {
        $query = Carrier::query();

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

        $carriers = $query->orderBy($sortField, $sortDirection)
                        ->paginate(15)
                        ->appends($request->query());

        return view('carriers.index_carrier', [
            'carriers' => $carriers,
            'nomeOuEmail' => $request->input('nomeOuEmail', ''),
            'telefone' => $request->input('telefone', ''),
            'ativo' => $request->input('ativo', '')
        ]);
    }

    public function create()
    {
        $estados = config('estados');
        return view('carriers.create_carrier', compact('estados'));
    }

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

                    $doc = preg_replace('/[^0-9]/', '', $value);

                    if ($request->tipoPessoa == 'F' && strlen($doc) === 11 && !validateCPF($doc)) {
                        $fail('CPF inválido.');
                    } elseif ($request->tipoPessoa == 'J' && strlen($doc) === 14 && !validateCNPJ($doc)) {
                        $fail('CNPJ inválido.');
                    } else if ($request->tipoPessoa != 'F' && $request->tipoPessoa != 'J') {
                        $fail('Documento inválido para o tipo selecionado.');
                    }

                    $query = Carrier::where('documento', $doc);

                    if ($request->has('id')) {
                        $query->where('id', '!=', $request->id);
                    }

                    if ($query->exists()) {
                        $msgDocument = $request->tipoPessoa == 'F' ? 'CPF' : 'CNPJ';
                        $fail("$msgDocument está cadastrado para outra transportadora.");
                    }
                }
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('transportadora', 'email')->ignore($request->id)
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
            
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'documento.required' => 'CPF/CNPJ é obrigatório.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'email.email' => 'Informe um e-mail válido.',
            'estado.in' => 'Selecione um estado válido.',
            'cep.min' => 'CEP inválido.'
        ]);

        Carrier::create($validated);

        return redirect()->route('carriers.index')
            ->with('success', applicationMessage('cadastrar'));
    }

    public function show(Carrier $carrier)
    {
        return view('carriers.show_carrier', compact('carrier'));
    }

    public function edit(Carrier $carrier)
    {
       return view('carriers.edit_carrier', compact('carrier'));
    }

    public function update(Request $request, Carrier $carrier)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|min:3',
            'tipoPessoa' => 'required|in:F,J',
            'documento' => [
                'required',
                'string',
                'max:18',
                function ($attribute, $value, $fail) use ($request, $carrier) {

                    $doc = preg_replace('/[^0-9]/', '', $value);

                    if ($request->tipoPessoa == 'F' && strlen($doc) === 11 && !validateCPF($doc)) {
                        $fail('CPF inválido.');
                    } elseif ($request->tipoPessoa == 'J' && strlen($doc) === 14 && !validateCNPJ($doc)) {
                        $fail('CNPJ inválido.');
                    } else if ($request->tipoPessoa != 'F' && $request->tipoPessoa != 'J') {
                        $fail('Documento inválido para o tipo selecionado.');
                    }

                    $query = Carrier::where('documento', $doc)
                        ->where('id', '!=', $carrier->id);

                    if ($query->exists()) {
                        $msgDocument = $request->tipoPessoa == 'F' ? 'CPF' : 'CNPJ';
                        $fail("$msgDocument está cadastrado para outra transportadora.");
                    }
                }
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('transportadora', 'email')->ignore($carrier->id)
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

        if (!$validated){
            return redirect()->back()->withErrors(['field' => 'E-mail já informado para outro usuário'])->withInput();
        }

        $carrier->update($validated);

        return redirect()->route('carriers.index')
            ->with('success', applicationMessage('atualizar'));
    }

    public function destroy(Carrier $carrier)
    {
        $carrier->delete();
        return redirect()->route('carriers.index')->with('success', applicationMessage('excluir'));
    }
}
