<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use Illuminate\Validation\Rule; ;
use Illuminate\Http\Request; 

class CarrierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "create";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "store";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "edit";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "destroy";
    }
}
