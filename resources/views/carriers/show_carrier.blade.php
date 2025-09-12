@extends('layout')
@section('conteudo')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div class="card p-4 p-lg-5">
            <div class="mb-5">
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
                            <h2 class="text-xl fw-semibold text-dark mb-1">Detalhes da Transportadora</h2>
                            <p class="small text-muted mb-0">Informações completas da Transportadora</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('carriers.edit', $carrier->id) }}" class="btn btn-primary">
                            <i class="ti ti-edit" width="16" height="16"></i> Editar
                        </a>
                        <a href="{{ route('carriers.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left" width="16" height="16"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Dados do Cliente -->
            <div class="row g-4">
                <!-- Dados Básicos -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Dados Básicos</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Nome/Razão Social</label>
                                <p class="form-control-plaintext">{{ $carrier->nome }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Tipo</label>
                                <p class="form-control-plaintext">{{ $carrier->tipoPessoa == 'F' ? 'Pessoa Física' : 'Pessoa Jurídica' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">CPF/CNPJ</label>
                                <p class="form-control-plaintext">{{ format_document($carrier->documento) }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Status</label>
                                <p>
                                    <span class="badge {{ $carrier->ativo ? 'bg-success' : 'bg-danger' }}">
                                        {{ $carrier->ativo ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contato -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Contato</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">E-mail</label>
                                <p class="form-control-plaintext">{{ $carrier->email }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Telefone</label>
                                <p class="form-control-plaintext">{{ format_phone($carrier->telefone) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Endereço -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Endereço</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-muted">CEP</label>
                                        <p class="form-control-plaintext">{{ $carrier->cep }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-muted">Endereço</label>
                                        <p class="form-control-plaintext">{{ $carrier->endereco }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-muted">Número</label>
                                        <p class="form-control-plaintext">{{ $carrier->numero }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-muted">Complemento</label>
                                        <p class="form-control-plaintext">{{ $carrier->complemento ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-muted">Bairro</label>
                                        <p class="form-control-plaintext">{{ $carrier->bairro }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-muted">Cidade</label>
                                        <p class="form-control-plaintext">{{ $carrier->cidade }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-muted">Estado</label>
                                        <p class="form-control-plaintext">{{ getNomeEstado($carrier->estado) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Datas -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Informações do Sistema</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Data de Criação</label>
                                <p class="form-control-plaintext">{{ $carrier->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Última Atualização</label>
                                <p class="form-control-plaintext">{{ $carrier->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection