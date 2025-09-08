@extends('layout')
@section('conteudo')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div class="content-section">
            <div class="d-flex align-items-center justify-content-between mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-text-primary">Detalhes do Cliente</h2>
                    <p class="text-sm text-text-secondary">Informações completas do cliente</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">
                        <i class="ti ti-edit"></i> Editar
                    </a>
                    <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-text-secondary">Nome</label>
                                <p class="form-control-plaintext">{{ $client->nome }}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-text-secondary">E-mail</label>
                                <p class="form-control-plaintext">{{ $client->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-text-secondary">Telefone</label>
                                <p class="form-control-plaintext">{{ $client->telefone ?? 'N/A' }}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-text-secondary">Status</label>
                                <p>
                                    <span class="badge {{ $client->ativo ? 'badge text-bg-secondary' : 'bg-danger' }}">
                                        {{ $client->ativo ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-text-secondary">Data de Criação</label>
                                <p class="form-control-plaintext">{{ $client->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-text-secondary">Última Atualização</label>
                                <p class="form-control-plaintext">{{ $client->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection