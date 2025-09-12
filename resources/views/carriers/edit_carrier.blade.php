@extends('layout')
@section('conteudo')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div class="card p-4 p-lg-5">
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="p-2 bg-primary bg-opacity-10 rounded me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user-edit text-primary">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                            <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                            <path d="M19.001 19.001a.5 .5 0 0 1 .5 .5v1.5a.5 .5 0 0 1 -.5 .5h-1.5a.5 .5 0 0 1 -.5 -.5v-1.5a.5 .5 0 0 1 .5 -.5h1.5z" />
                            <path d="M19.001 15.004a.5 .5 0 0 1 .5 .5v1.5a.5 .5 0 0 1 -.5 .5h-1.5a.5 .5 0 0 1 -.5 -.5v-1.5a.5 .5 0 0 1 .5 -.5h1.5z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl fw-semibold text-dark mb-1">Editar Transportadora</h2>
                        <p class="small text-muted mb-0">Editando: {{ $carrier->nome }}</p>
                    </div>
                </div>

                <div class="progress" style="height: 6px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%" id="progressBar"></div>
                </div>
            </div>

            <!-- Form -->
            <form id="carriersForm" method="POST" action="{{ route('carriers.update', $carrier->id) }}" data-loading-text="{{ applicationMessage('salvando') }}">
                @csrf
                @method('PUT')
                
                <!-- Seção 1: Dados Básicos -->
                <div class="row g-4 mb-5">
                    <!-- Nome/Razão Social -->
                    <div class="col-lg-6">
                        <label for="txtNome" class="form-label fw-medium">
                            Nome/Razão Social <span class="text-danger">*</span>
                        </label>
                        <input id="txtNome" name="nome" required class="form-control" value="{{ old('nome', $carrier->nome) }}">
                        <div class="form-text">Nome completo ou razão social</div>
                        @error('nome') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Tipo Pessoa -->
                    <div class="col-lg-3">
                        <label for="tipoPessoa" class="form-label fw-medium">
                            Tipo <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="tipoPessoa" id="tipoPessoa" required>
                            <option value="F" {{ old('tipoPessoa', $carrier->tipoPessoa) == 'F' ? 'selected' : '' }}>Pessoa Física</option>
                            <option value="J" {{ old('tipoPessoa', $carrier->tipoPessoa) == 'J' ? 'selected' : '' }}>Pessoa Jurídica</option>
                        </select>
                        @error('tipoPessoa') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Documento (CPF/CNPJ) -->
                    <div class="col-lg-3">
                        <label for="txtDocumento" class="form-label fw-medium">
                            CPF/CNPJ <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="txtDocumento" name="documento" required class="form-control" 
                               value="{{ old('documento', $carrier->documento) }}">
                        <div class="form-text" id="documentoHelp">Informe o CPF ou CNPJ</div>
                        @error('documento') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Seção 2: Contato -->
                <div class="row g-4 mb-5">
                    <!-- E-mail -->
                    <div class="col-lg-6">
                        <label for="txtEmail" class="form-label fw-medium">
                            E-mail <span class="text-danger">*</span>
                        </label>
                        <input type="email" id="txtEmail" name="email" required class="form-control" 
                               value="{{ old('email', $carrier->email) }}" placeholder="{{ applicationMessage('placeholder_email') }}">
                        <div class="form-text">E-mail para contato</div>
                        @error('email') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Telefone -->
                    <div class="col-lg-6">
                        <label for="txtTelefone" class="form-label fw-medium">
                            Telefone <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="txtTelefone" name="telefone" required class="form-control" 
                               value="{{ old('telefone', $carrier->telefone) }}" placeholder="{{ applicationMessage('placeholder_celular') }}">
                        <div class="form-text">Telefone principal</div>
                        @error('telefone') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Seção 3: Endereço -->
                <div class="row g-4 mb-5">
                    <!-- CEP -->
                    <div class="col-lg-3">
                        <label for="txtCep" class="form-label fw-medium">
                            CEP <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="txtCep" name="cep" required class="form-control" 
                               value="{{ old('cep', $carrier->cep) }}" placeholder="{{ applicationMessage('placeholder_CEP') }}">
                        <div class="form-text">Informe o CEP</div>
                        @error('cep') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Endereço -->
                    <div class="col-lg-6">
                        <label for="txtEndereco" class="form-label fw-medium">
                            Endereço <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="txtEndereco" name="endereco" required class="form-control" 
                               value="{{ old('endereco', $carrier->endereco) }}" placeholder="{{ applicationMessage('placeholder_endereco') }}">
                        <div class="form-text">Logradouro completo</div>
                        @error('endereco') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Número -->
                    <div class="col-lg-3">
                        <label for="txtNumero" class="form-label fw-medium">
                            Número <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="txtNumero" name="numero" required class="form-control" 
                               value="{{ old('numero', $carrier->numero) }}" placeholder="{{ applicationMessage('placeholder_numero') }}">
                        <div class="form-text">Número do endereço</div>
                        @error('numero') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-4 mb-5">
                    <!-- Complemento -->
                    <div class="col-lg-4">
                        <label for="txtComplemento" class="form-label fw-medium">
                            Complemento
                        </label>
                        <input type="text" id="txtComplemento" name="complemento" class="form-control" 
                               value="{{ old('complemento', $carrier->complemento) }}" placeholder="{{ applicationMessage('placeholder_complemento') }}">
                        <div class="form-text">Complemento do endereço</div>
                        @error('complemento') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Bairro -->
                    <div class="col-lg-4">
                        <label for="txtBairro" class="form-label fw-medium">
                            Bairro <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="txtBairro" name="bairro" required class="form-control" 
                               value="{{ old('bairro', $carrier->bairro) }}" placeholder="{{ applicationMessage('placeholder_bairro') }}">
                        <div class="form-text">Bairro</div>
                        @error('bairro') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Cidade -->
                    <div class="col-lg-4">
                        <label for="txtCidade" class="form-label fw-medium">
                            Cidade <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="txtCidade" name="cidade" required class="form-control" 
                               value="{{ old('cidade', $carrier->cidade) }}" placeholder="{{ applicationMessage('Nome da cidade') }}">
                        <div class="form-text">Cidade</div>
                        @error('cidade') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-4 mb-5">
                    <!-- Estado -->
                    <div class="col-lg-6">
                        <label for="selEstado" class="form-label fw-medium">
                            Estado <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="estado" id="selEstado" required>
                        <option value="">Selecione o estado</option>
                        @foreach(config('estados') as $sigla => $nome)
                            <option value="{{ $sigla }}" {{ old('estado', $carrier->estado) == $sigla ? 'selected' : '' }}>
                                {{ $nome }}
                            </option>
                        @endforeach
                    </select>
                        @error('estado') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-lg-6">
                    <label class="form-label fw-medium">
                        Status da Transportadora 
                    </label>
                    
                    <!-- Campo hidden com valor 0 (inativo) -->
                    <input type="hidden" name="ativo" value="0">
                    
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked" 
                            name="ativo" value="1" {{ old('ativo', $carrier->ativo) ? 'checked' : '' }}>
                        <label class="form-check-label" for="switchCheckChecked">Transportadora Ativo</label>
                    </div>
                    
                    <div class="form-text">Transportadora ativo ou inativo no sistema</div>
                    @error('ativo') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex flex-column flex-sm-row gap-3 pt-4 border-top justify-content-end">
                    <div class="flex">
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <button type="submit" class="btn btn-primary flex-fill px-4 py-2 fs-6">
                                <i class="ti ti-file-check" width="16" height="16"></i>
                                Atualizar
                            </button>
                            <a href="{{ route('carriers.index') }}" class="btn btn-secondary d-flex align-items-center justify-content-center">
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

@endsection

@push('pagescript')
    <script src="{{ asset('assets/js/carriers/edit_carrier.js') }}" defer></script>
@endpush