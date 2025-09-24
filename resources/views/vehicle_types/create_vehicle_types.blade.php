@extends('layout')
@section('conteudo')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div class="card p-4 p-lg-5">
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
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
                        <h2 class="text-xl fw-semibold text-dark mb-1">Novo Tipo de Veículo</h2>
                        <p class="small text-muted mb-0">Preencha os dados para criar um novo tipo de veículo</p>
                    </div>
                </div>

                <!-- Progress Indicator -->
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%" id="progressBar"></div>
                </div>
            </div>

            <!-- Form -->
            <form id="vehicleTypesForm" method="POST" action="{{ route('vehicle_types.store') }}" data-loading-text="Salvando...">
                @csrf
                
                <!-- Seção 1: Dados Básicos -->
                <div class="row g-4 mb-5">
                    <!-- Nome do Veículo -->
                    <div class="col-lg-6">
                        <label for="txtNomeVeiculo" class="form-label fw-medium">
                            Nome do Veículo <span class="text-danger">*</span>
                        </label>
                        <input id="txtNomeVeiculo" name="nomeVeiculo" required class="form-control" value="{{ old('nomeVeiculo') }}">
                        <div class="form-text">Nome descritivo do tipo de veículo</div>
                        @error('nomeVeiculo') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Tipo de Veículo -->
                    <div class="col-lg-6">
                        <label for="txtTipoVeiculo" class="form-label fw-medium">
                            Tipo de Veículo
                        </label>
                        <input type="text" id="txtTipoVeiculo" name="tipoVeiculo" class="form-control" 
                               value="{{ old('tipoVeiculo') }}" placeholder="Ex: Caminhão, Carreta, Van">
                        <div class="form-text">Categoria do veículo</div>
                        @error('tipoVeiculo') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Seção 2: Dimensões e Pesos -->
                <div class="row g-4 mb-5">
                    <!-- Quantidade de Eixos -->
                    <div class="col-lg-3">
                        <label for="txtQtdeEixo" class="form-label fw-medium">
                            Quantidade de Eixos <span class="text-danger">*</span>
                        </label>
                        <input type="number" id="txtQtdeEixo" name="qtdeEixo" required class="form-control" 
                               value="{{ old('qtdeEixo', 0) }}" min="0" max="10">
                        <div class="form-text">Número total de eixos</div>
                        @error('qtdeEixo') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Peso Líquido -->
                    <div class="col-lg-3">
                        <label for="txtPesoLiquido" class="form-label fw-medium">
                            Peso Líquido (kg) <span class="text-danger">*</span>
                        </label>
                        <input type="number" id="txtPesoLiquido" name="pesoLiquido" required class="form-control" 
                               value="{{ old('pesoLiquido', '0.00') }}" step="0.01" min="0">
                        <div class="form-text">Peso líquido em kilogramas</div>
                        @error('pesoLiquido') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Peso Bruto -->
                    <div class="col-lg-3">
                        <label for="txtPesoBruto" class="form-label fw-medium">
                            Peso Bruto (kg) <span class="text-danger">*</span>
                        </label>
                        <input type="number" id="txtPesoBruto" name="pesoBruto" required class="form-control" 
                               value="{{ old('pesoBruto', '0.00') }}" step="0.01" min="0">
                        <div class="form-text">Peso bruto em kilogramas</div>
                        @error('pesoBruto') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Seção 3: Dimensões -->
                <div class="row g-4 mb-5">
                    <!-- Comprimento -->
                    <div class="col-lg-4">
                        <label for="txtComprimento" class="form-label fw-medium">
                            Comprimento (m)
                        </label>
                        <input type="number" id="txtComprimento" name="comprimento" class="form-control" 
                               value="{{ old('comprimento') }}" step="0.01" min="0" placeholder="0.00">
                        <div class="form-text">Comprimento em metros</div>
                        @error('comprimento') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Altura -->
                    <div class="col-lg-4">
                        <label for="txtAltura" class="form-label fw-medium">
                            Altura (m)
                        </label>
                        <input type="number" id="txtAltura" name="altura" class="form-control" 
                               value="{{ old('altura') }}" step="0.01" min="0" placeholder="0.00">
                        <div class="form-text">Altura em metros</div>
                        @error('altura') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Largura -->
                    <div class="col-lg-4">
                        <label for="txtLargura" class="form-label fw-medium">
                            Largura (m)
                        </label>
                        <input type="number" id="txtLargura" name="largura" class="form-control" 
                               value="{{ old('largura') }}" step="0.01" min="0" placeholder="0.00">
                        <div class="form-text">Largura em metros</div>
                        @error('largura') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Seção 4: Status -->
                <div class="row g-4 mb-5">
                    <div class="col-lg-12">
                        <label class="form-label fw-medium">
                            Status do Tipo de Veículo
                        </label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="switchAtivo" 
                                   name="ativo" value="1" {{ old('ativo', 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="switchAtivo">Tipo de Veículo Ativo</label>
                        </div>
                        <div class="form-text">Tipo de veículo ativo ou inativo no sistema</div>
                        @error('ativo') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex flex-column flex-sm-row gap-3 pt-4 border-top justify-content-end">
                    <div class="flex">
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <button type="submit" class="btn btn-primary flex-fill px-4 py-2 fs-6">
                                <i class="ti ti-file-check" width="16" height="16"></i>
                                Salvar Tipo de Veículo
                            </button>
                            <a href="{{ route('vehicle_types.index') }}" class="btn btn-secondary d-flex align-items-center justify-content-center">
                                <i class="ti ti-x" width="16" height="16"></i>
                                Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/vehicle_types/create_vehicle_types.js') }}" defer></script>

@endsection