@extends('layout')
@section('conteudo')

    @if (session('message'))
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
            <div class="toast align-items-center custom-toast bg-success" role="alert" aria-live="assertive" aria-atomic="true"
                id="toastUsers">
                <div class="d-flex">
                    <div class="toast-body text-white">
                        {{ session('message') }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto text-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="body-wrapper-inner">
        <div class="container-fluid">
            <div id="groupsContent" class="content-section">
                <div class="d-flex align-items-center justify-content-between mb-6">
                    <div>
                        <h2 class="text-xl font-semibold text-text-primary">Usuários</h2>
                        <p class="text-sm text-text-secondary">Lista de usuário para acesso ao sistema</p>
                    </div>
                    <a id="newGroupBtn" class="btn btn-primary" href="{{ route('users.create') }}">
                        <i class="ti ti-plus"></i>
                        Novo 
                    </a>
                </div>  
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.store') }}">
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
                                <label class="block text-sm font-medium text-text-primary mb-1">Status</label>
                                <select class="form-select" name="active">
                                    <option value="" >Todos</option>
                                    <option value="1" {{ $active == '1' ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ $active == '0' ? 'selected' : '' }}>Inativo</option>
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
                                    <th class="col w-35">
                                        @sortablelink('email','E-mail')
                                    </th>
                                    <th class="col w-25">@sortablelink('name','Nome')
                                    </th>
                                    <th class="col w-5">Status</th>
                                    <th class="col w-15">@sortablelink('transportadora.nome','Transportadora')</th>
                                    <th class="col w-5">Ações</th>
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
                                <td class="py-2 px-2 " >
                                    <span class="badge {{ $usuario->active == false ? 'text-bg-muted' : ' text-bg-secondary' }} "> {{ $usuario->active == false ? 'Inativo' : 'Ativo' }} </span>
                                </td>
                                <td class="py-2 px-2">
                                    <div class="text-sm text-primary">{{ $usuario->transportadora?->nome }}</div>
                                    <div class="alert-secondary">{{ $usuario->transportadora?->documento }}</div>
                                </td>
                                <td class="py-2 px-2">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('users.edit', [$usuario->id] + request()->query()) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', [$usuario->id] + request()->query()) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                        
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
                </div>
            </div>    
        </div>
        
    </div>

@endsection

@push('pagescript')
<script>
    const toast = document.getElementById('toastUsers');
    if (toast != null){
        var objToast = new bootstrap.Toast(toast);
        objToast.show();
    }
    
</script>
    
@endpush