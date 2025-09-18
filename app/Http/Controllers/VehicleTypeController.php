<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Validation\Rule; ;
use Illuminate\Http\Request; 

class VehicleTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = VehicleType::query();

        if ($request->has('nomeVeiculo') && !empty($request->telefone)) {
            $query->where( 'nomeVeiculo', 'like', '%' . $request->telefone . '%');
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
}
