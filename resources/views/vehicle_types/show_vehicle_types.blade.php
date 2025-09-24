@extends('layout')
@section('conteudo')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div class="card p-4 p-lg-5">
            <div class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center">
                        <div class="p-2 bg-primary bg-opacity-10 rounded me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-truck text-primary">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M6 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M18 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M4 17h-2v-11a1 1 0 0 1 1 -1h14a5 7 0 0 1 5 7v5h-2m-4 0h-8" />
                                <path d="M16 5l1.5 7l4.5 0" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl fw-semibold text-dark mb-1">Detalhes do Tipo de Veículo</h2>
                            <p class="small text-muted mb-0">Informações completas do tipo de veículo</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('vehicle_types.edit', $vehicleType->id) }}" class="btn btn-primary">
                            <i class="ti ti-edit" width="16" height="16"></i> Editar
                        </a>
                        <a href="{{ route('vehicle_types.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left" width="16" height="16"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Dados do Tipo de Veículo -->
            <div class="row g-4">
                <!-- Dados Básicos -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Dados Básicos</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Nome do Veículo</label>
                                <p class="form-control-plaintext">{{ $vehicleType->nomeVeiculo }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Tipo de Veículo</label>
                                <p class="form-control-plaintext">{{ $vehicleType->tipoVeiculo ?? 'N/A' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Quantidade de Eixos</label>
                                <p class="form-control-plaintext">{{ $vehicleType->qtdeEixo }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Status</label>
                                <p>
                                    <span class="badge {{ $vehicleType->ativo ? 'bg-success' : 'bg-danger' }}">
                                        {{ $vehicleType->ativo ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pesos -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Pesos</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Peso Líquido (kg)</label>
                                <p class="form-control-plaintext">{{ number_format($vehicleType->pesoLiquido, 2, ',', '.') }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Peso Bruto (kg)</label>
                                <p class="form-control-plaintext">{{ number_format($vehicleType->pesoBruto, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dimensões -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Dimensões</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-muted">Comprimento (m)</label>
                                        <p class="form-control-plaintext">
                                            {{ $vehicleType->comprimento ? number_format($vehicleType->comprimento, 2, ',', '.') : 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-muted">Altura (m)</label>
                                        <p class="form-control-plaintext">
                                            {{ $vehicleType->altura ? number_format($vehicleType->altura, 2, ',', '.') : 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-muted">Largura (m)</label>
                                        <p class="form-control-plaintext">
                                            {{ $vehicleType->largura ? number_format($vehicleType->largura, 2, ',', '.') : 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informações do Sistema -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Informações do Sistema</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Data de Criação</label>
                                <p class="form-control-plaintext">{{ $vehicleType->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Última Atualização</label>
                                <p class="form-control-plaintext">{{ $vehicleType->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection