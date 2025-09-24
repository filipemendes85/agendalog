<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = VehicleType::query();

        // Corrigindo o filtro - estava usando 'telefone' em vez de 'nomeVeiculo'
        if ($request->has('nomeVeiculo') && !empty($request->nomeVeiculo)) {
            $query->where('nomeVeiculo', 'like', '%' . $request->nomeVeiculo . '%');
        }

        if ($request->has('ativo') && $request->ativo != '') {
            $query->where('ativo', '=', $request->ativo);
        }

        $sortField = $request->get('sort', 'nomeVeiculo');
        $sortDirection = $request->get('direction', 'asc');

        $vehicleTypes = $query->orderBy($sortField, $sortDirection)
                        ->paginate(15)
                        ->appends($request->query());

        return view('vehicle_types.index_vehicle_types', [
            'vehicle_types' => $vehicleTypes,
            'nomeVeiculo' => $request->input('nomeVeiculo', ''),
            'ativo' => $request->input('ativo', '')
        ]);
    }

    public function create()
    {
        return view('vehicle_types.create_vehicle_types');
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'nomeVeiculo' => 'required|string|max:100|unique:tipo_veiculo,nomeVeiculo',
            'tipoVeiculo' => 'nullable|string|max:100',
            'qtdeEixo' => 'required|integer|min:0|max:10',
            'pesoLiquido' => 'required|numeric|min:0',
            'pesoBruto' => 'required|numeric|min:0',
            'comprimento' => 'nullable|numeric|min:0',
            'altura' => 'nullable|numeric|min:0',
            'largura' => 'nullable|numeric|min:0',
            'ativo' => 'boolean'
        ], [
            'nomeVeiculo.required' => 'O nome do veículo é obrigatório.',
            'nomeVeiculo.unique' => 'Já existe um tipo de veículo com este nome.',
            'qtdeEixo.required' => 'A quantidade de eixos é obrigatória.',
            'pesoLiquido.required' => 'O peso líquido é obrigatório.',
            'pesoBruto.required' => 'O peso bruto é obrigatório.',
        ]);

        // Garantir que o campo ativo tenha um valor
        $validated['ativo'] = $request->has('ativo') ? 1 : 0;

        try {
            VehicleType::create($validated);
            
            return redirect()->route('vehicle_types.index')
                ->with('success', 'Tipo de veículo criado com sucesso!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao criar tipo de veículo: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(VehicleType $vehicleType)
    {
        return view('vehicle_types.show_vehicle_types', compact('vehicleType'));
    }

    public function edit(VehicleType $vehicleType)
    {
        return view('vehicle_types.edit_vehicle_types', compact('vehicleType'));
    }

    public function update(Request $request, VehicleType $vehicleType)
    {
        $validated = $request->validate([
            'nomeVeiculo' => [
                'required',
                'string',
                'max:100',
                Rule::unique('tipo_veiculo')->ignore($vehicleType->id)
            ],
            'tipoVeiculo' => 'nullable|string|max:100',
            'qtdeEixo' => 'required|integer|min:0|max:10',
            'pesoLiquido' => 'required|numeric|min:0',
            'pesoBruto' => 'required|numeric|min:0',
            'comprimento' => 'nullable|numeric|min:0',
            'altura' => 'nullable|numeric|min:0',
            'largura' => 'nullable|numeric|min:0',
            'ativo' => 'boolean'
        ]);

        $request->merge(['ativo' => $request->has('ativo')]);

        try {
            $vehicleType->update($validated);
            
            return redirect()->route('vehicle_types.index')
                ->with('success', 'Tipo de veículo atualizado com sucesso!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao atualizar tipo de veículo: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $vehicleType = VehicleType::findOrFail($id);
            $vehicleType->delete();
            
            return redirect()->route('vehicle_types.index')
                ->with('success', 'Tipo de veículo excluído com sucesso!');
                
        } catch (\Exception $e) {
            return redirect()->route('vehicle_types.index')
                ->with('error', 'Erro ao excluir tipo de veículo: ' . $e->getMessage());
        }
    }
}