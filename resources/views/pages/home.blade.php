@extends('layout')
@section('conteudo')

    <div class="body-wrapper-inner">
        <div class="container-fluid">
            <div id="groupsContent" class="content-section">
                <div class="d-flex align-items-center justify-content-between mb-6">
                    <div>
                        <h2 class="text-xl font-semibold text-text-primary">Usuários</h2>
                        <p class="text-sm text-text-secondary">Lista de usuário para acesso ao sistema</p>
                    </div>
                    <button id="newGroupBtn" class="btn btn-primary">
                        <i class="ti ti-plus"></i>
                        Novo 
                    </button>
                </div>  
                <div class="card">
                    <div class="card-body">
                        <form action="">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="block text-sm font-medium text-text-primary mb-1">Nome ou E-mail</label>
                                <div class="input-group">
                                    <input id="searchinput" type="search" class="form-control" name="nomeOuEmail" placeholder="Nome ou email..." value ={{$nomeOuEmail}}>
                                    <span id="searchclear" class="ti ti-X"></span>
                                </div>    
                                {{-- </div>
                                <label class="block text-sm font-medium text-text-primary mb-1">Pesquisar</label>
                                <input type="text" class="form-control" placeholder="Nome ou email..." name="nomeOuEmail" aria-label="Nome ou email..."> --}}
                            </div>
                            <div class="col">
                                <label class="block text-sm font-medium text-text-primary mb-1">Transportadoras</label>
                                <select class="form-select" name="transportadoraId">
                                    <option value="">Todos</option>
                                    @foreach($transportadoras as $transpotadora)
                                        <option value="{{ $transpotadora->id }}" @selected($transportadoraId == $transpotadora->id)>{{ $transpotadora->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="block text-sm font-medium text-text-primary mb-1">Ativo</label>
                                <select class="form-select" name="active">
                                    <option value="">Todos</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                            <div class="w-auto justify-content-end align-content-center mt-4">
                                <button class="btn btn-light text-text-secondary w-full" type="submit">
                                    Filtrar
                                </button>
                            </div>
                        </div>
                        </form>
                        {{-- <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-text-primary mb-1">Pesquisar</label>
                                <input type="text" placeholder="Nome ou email..." class="form-input" id="contactSearch" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-text-primary mb-1">Tipo</label>
                                <select class="form-input" id="contactTypeFilter">
                                    <option value>Todos</option>
                                    <option value="cliente">Clientes</option>
                                    <option value="transportador">Transportadores</option>
                                </select>
                            </div>
                        </form>     --}}
                    </div>
                </div>
                <div class="card p-6">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr class="border-b border-border">
                                    <th class="col w-35">E-mail</th>
                                    <th class="col w-25">Nome</th>
                                    <th class="col w-5">Ativo</th>
                                    <th class="col w-10">Transportadora</th>
                                    <th class="col w-10">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border" id="operationsTableBody">
                                @forelse($users as $usuario)
                                <!-- Operation rows will be populated here -->
                                <tr class="hover:bg-gray-50 transition-standard ">
                                <td class="py-2 px-2" >
                                    <div class="font-mono text-sm text-primary">{{ $usuario->email }}</div>
                                </td>
                                <td class="py-2 px-2" >
                                    <div class="font-medium text-text-primary">{{ $usuario->name }}</div>
                                </td>
                                <td class="py-2 px-2 text-sm text-text-secondary" >
                                    <span class="badge {{ $usuario->active === false ? 'bg-gray-100 text-gray-600' : 'badge text-bg-secondary' }} ">Ativo</span>
                                </td>
                                <td class="py-2 px-2">
                                    <div class="text-sm text-primary">{{ $usuario->transportadora?->nome }}</div>
                                    <div class="alert-secondary">{{ $usuario->transportadora?->documento }}</div>
                                </td>
                                <td class="py-2 px-2">
                                    <div class="flex items-center space-x-2">
                                        <button class="btn btn-outline-primary hover:bg-primary-50 rounded">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-danger hover:bg-gray-100 rounded">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                </tr>
                                @empty 
                                    <tr><td colspan="5"><div class="alert alert-warning">Sem registros</div></td></tr>
                                @endforelse    
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    {{ $users->links() }}
                    {{-- <div class="d-flex align-items-center justify-content-between mt-6">
                        
                        <div class="text-sm text-text-secondary">
                            Mostrando 1-1 de 5 usuários
                        </div>
                        <div>
                            
                        <div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 border border-border rounded text-sm text-text-secondary hover:bg-gray-50">Anterior</button>
                            <button class="px-3 py-1 bg-primary text-white rounded text-sm">1</button>
                            <button class="px-3 py-1 border border-border rounded text-sm text-text-secondary hover:bg-gray-50">2</button>
                            <button class="px-3 py-1 border border-border rounded text-sm text-text-secondary hover:bg-gray-50">3</button>
                            <button class="px-3 py-1 border border-border rounded text-sm text-text-secondary hover:bg-gray-50">Próximo</button>
                        </div> 
                    </div>--}}
                </div>
            </div>    
        </div>
        
    </div>

@endsection