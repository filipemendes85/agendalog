@extends('layout')
@section('conteudo')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div id="groupsContent" class="content-section">
            <div class="d-flex align-items-center justify-content-between mb-6">
                <div>
                    <h2><a href="{{ route('vehicle_types.index') }}" class="text-xl font-semibold text-text-primary">Tipos de Veículos</a></h2>
                </div>
                <a href="{{ route('vehicle_types.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Novo
                </a>
            </div>  

            <!-- Filtros -->
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ url('/vehicle_types') }}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="block text-sm font-medium text-text-primary mb-1">Nome</label>
                                <div class="input-group">
                                    <input id="searchinput" type="search" class="form-control" name="nomeVeiculo" placeholder="Nome do veículo" value="{{ $nomeVeiculo ?? '' }}">
                                    <span id="searchclear" class="ti ti-X"></span>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label class="block text-sm font-medium text-text-primary mb-1">Ativo</label>
                                <select class="form-select" name="ativo">
                                    <option value="">Todos</option>
                                    <option value="1" {{ ($ativo ?? '') == '1' ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ ($ativo ?? '') == '0' ? 'selected' : '' }}>Inativo</option>
                                </select>
                            </div>
                            
                            <div class="w-auto justify-content-end align-content-center mt-4">
                                <button class="btn btn-primary w-full" type="submit">
                                    <i class="ti ti-search"></i> Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Resultados -->
            <div class="card p-6">
                <div class="d-flex justify-content-end align-items-center mb-4">
                    <span class="badge bg-primary">{{ $vehicle_types->total() }} Tipos de veículos encontrados</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="border-b border-border">
                                <th class="text-start">{!! sort_link('nomeVeiculo', 'Nome') !!}</th>
                                <th class="text-start">{!! sort_link('tipoVeiculo', 'Tipo') !!}</th>
                                <th class="text-center">{!! sort_link('qtdeEixo', 'Qtde. Eixos') !!}</th>
                                <th class="text-center">{!! sort_link('pesoLiquido', 'Peso Liq.') !!}</th>
                                <th class="text-center">{!! sort_link('pesoBruto', 'Peso Bru.') !!}</th>
                                <th class="text-center">Ativo</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border" id="operationsTableBody">
                            @forelse($vehicle_types as $vehicleType)
                            <tr class="hover:bg-gray-50 transition-standard">
                                <td class="text-start">
                                    <div class="font-medium text-text-primary">{{ $vehicleType->nomeVeiculo }}</div>
                                </td>
                                <td class="text-start">
                                    <div class="font-medium text-text-primary">{{ $vehicleType->tipoVeiculo }}</div>
                                </td>
                                <td class="text-center">
                                    <div class="text-sm-center-sm text-text-secondary">{{ $vehicleType->qtdeEixo }}</div>
                                </td>
                                <td class="text-center">
                                    <div class="text-sm text-text-secondary">{{ $vehicleType->pesoLiquido }}</div>
                                </td>
                                <td class="text-center">
                                    <div class="text-sm text-text-secondary">{{ $vehicleType->pesoBruto }}</div>
                                </td>
                                <td class="text-center text-text-secondary">
                                    @if(isset($vehicleType->ativo))
                                        <span class="badge {{ $vehicleType->ativo == 1 ? 'badge text-bg-secondary' : 'bg-danger' }}">
                                            {{ $vehicleType->ativo == 1 ? 'Ativo' : 'Inativo' }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="flex items-center space-x-2">
                                        <!-- Ver Detalhes -->
                                        <a href="{{ route('vehicle_types.show', $vehicleType->id) }}" class="btn btn-outline-info btn-sm" title="Ver detalhes">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        
                                        <!-- Editar -->
                                        <a href="{{ route('vehicle_types.edit', $vehicleType->id) }}" class="btn btn-outline-primary btn-sm" title="Editar">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        
                                        <!-- Excluir -->
                                        <form id="delete-form-{{ $vehicleType->id }}" action="{{ route('vehicle_types.destroy', $vehicleType->id) }}" method="POST" class="d-inline" data-loading-text="Excluindo...">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger btn-sm" 
                                                onclick="confirmAction('Tem certeza que deseja excluir o cliente {{ addslashes($vehicleType->nomeVeiculo) }}?', 'delete-form-{{ $vehicleType->id }}')" 
                                                title="Excluir">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty 
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-warning text-center">
                                            {{ applicationMessage('sem_registros') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginação -->
                <div class="d-flex justify-content-end mt-4">
                    {{ $vehicle_types->appends(request()->query())->links() }}
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection