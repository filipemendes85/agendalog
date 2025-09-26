@extends('layout')
@section('conteudo')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div id="boxshadow" class="card p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <div class="p-2 bg-primary bg-opacity-10 rounded me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user text-primary">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                            <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl fw-semibold text-dark mb-1">Cliente</h2>
                            <p class="text-muted mb-0">Cadastro e consulta de clientes</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('clients.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Novo
                    </a>
                </div>
            </div>

            <!-- Filtros -->
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ url('/clients') }}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="block text-sm font-medium text-text-primary mb-1">Nome ou E-mail</label>
                                <div class="input-group">
                                    <input id="searchinput" type="search" class="form-control" name="nomeOuEmail" placeholder="Nome ou email..." value="{{ $nomeOuEmail ?? '' }}">
                                    <span id="searchclear" class="ti ti-X"></span>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <label class="block text-sm font-medium text-text-primary mb-1">Telefone</label>
                                <input type="text" class="form-control" name="telefone" placeholder="Telefone..." value="{{ $telefone ?? '' }}">
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
                    <span class="badge bg-primary">{{ $clients->total() }} clientes encontrados</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="border-b border-border">
                                <th class="col w-25">{!! sort_link('nome', 'Nome') !!}</th>
                                <th class="col w-35">{!! sort_link('email', 'E-mail') !!}</th>
                                <th class="col w-20">{!! sort_link('telefone', 'Telefone') !!}</th>
                                <th class="col w-10">Ativo</th>
                                <th class="col w-10">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border" id="operationsTableBody">
                            @forelse($clients as $client)
                            <tr class="hover:bg-gray-50 transition-standard">
                                <td class="py-2 px-2">
                                    <div class="font-medium text-text-primary">{{ $client->nome }}</div>
                                </td>
                                <td class="py-2 px-2">
                                    <div class="font-mono text-sm text-primary">{{ $client->email }}</div>
                                </td>
                                <td class="py-2 px-2">
                                    <div class="text-sm text-text-secondary">{{ $client->telefone ?? 'N/A' }}</div>
                                </td>
                                <td class="py-2 px-2 text-sm text-text-secondary">
                                    @if(isset($client->ativo))
                                        <span class="badge {{ $client->ativo == 1 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $client->ativo == 1 ? 'Ativo' : 'Inativo' }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td class="py-2 px-2">
                                    <div class="flex items-center space-x-2">
                                        <!-- Ver Detalhes -->
                                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-outline-info btn-sm" title="Ver detalhes">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        
                                        <!-- Editar -->
                                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-outline-primary btn-sm" title="Editar">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        
                                        <!-- Excluir -->
                                        <form id="delete-form-{{ $client->id }}" action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline" data-loading-text="Excluindo...">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger btn-sm" 
                                                onclick="confirmAction('Tem certeza que deseja excluir o cliente {{ addslashes($client->nome) }}?', 'delete-form-{{ $client->id }}')" 
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
                    {{ $clients->appends(request()->query())->links() }}
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection