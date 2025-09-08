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
                        <h2 class="text-xl fw-semibold text-dark mb-1">Editar Cliente</h2>
                        <p class="small text-muted mb-0">Editando: {{ $client->nome }}</p>
                    </div>
                </div>
                
                <!-- Progress Indicator -->
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%" id="progressBar"></div>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('clients.update', $client->id) }}">
                @csrf
                @method('PUT')
                
                <!-- Basic Information Section -->
                <div class="row g-4 mb-5">
                    <!-- Nome -->
                    <div class="col-lg-6">
                        <label for="txtNome" class="form-label fw-medium">
                            Nome <span class="text-danger">*</span>
                        </label>
                        <input id="txtNome" name="nome" required class="form-control" value="{{ old('nome', $client->nome) }}">
                        <div class="form-text">Nome completo do cliente</div>
                        @error('nome') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- E-mail -->
                    <div class="col-lg-6">
                        <label for="txtEmail" class="form-label fw-medium">
                            E-mail <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="email" id="txtEmail" name="email" required placeholder="cliente@email.com" 
                                   class="form-control" value="{{ old('email', $client->email) }}" />
                        </div>
                        <div class="form-text">E-mail válido do cliente</div>
                        @error('email') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-4 mb-5">
                    <!-- Telefone -->
                    <div class="col-lg-6">
                        <label for="txtTelefone" class="form-label fw-medium">
                            Telefone
                        </label>
                        <input type="text" id="txtTelefone" name="telefone" placeholder="(27) 99999-9999" 
                               class="form-control" value="{{ old('telefone', $client->telefone) }}" />
                        <div class="form-text">Telefone para contato</div>
                        @error('telefone') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-lg-6">
                        <label class="form-label fw-medium">
                            Status do Cliente
                        </label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked" 
                                   name="ativo" value="1" {{ old('ativo', $client->ativo) ? 'checked' : '' }}>
                            <label class="form-check-label" for="switchCheckChecked">Ativo</label>
                        </div>
                        <div class="form-text">Cliente ativo ou inativo no sistema</div>
                        @error('ativo') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex flex-column flex-sm-row gap-3 pt-4 border-top justify-content-end">
                    <div class="flex">
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <button type="submit" class="btn btn-primary flex-fill px-4 py-2 fs-6">
                                <i class="ti ti-file-check" width="16" height="16"></i>
                                Atualizar Cliente
                            </button>

                            <a href="{{ route('clients.index') }}" class="btn btn-secondary d-flex align-items-center justify-content-center">
                                <i class="ti ti-x" width="16" height="16"></i>
                                Fechar
                            </a>
                        </div>
                    </div>

                    <!-- Clear Form -->
                    <div class="d-flex align-items-center">
                        <button type="button" id="clearFormBtn" class="btn btn-outline-danger p-2" title="Limpar Alterações">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Script para limpar as alterações e restaurar valores originais
document.addEventListener('DOMContentLoaded', function() {
    const clearFormBtn = document.getElementById('clearFormBtn');
    
    if (clearFormBtn) {
        clearFormBtn.addEventListener('click', function() {
            // Restaurar valores originais do cliente
            document.getElementById('txtNome').value = '{{ $client->nome }}';
            document.getElementById('txtEmail').value = '{{ $client->email }}';
            document.getElementById('txtTelefone').value = '{{ $client->telefone }}';
            document.getElementById('switchCheckChecked').checked = {{ $client->ativo ? 'true' : 'false' }};
        });
    }
    
    // Máscara de telefone
    const telefoneInput = document.getElementById('txtTelefone');
    if (telefoneInput) {
        telefoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);
            
            if (value.length > 10) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else if (value.length > 6) {
                value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
            } else if (value.length > 2) {
                value = value.replace(/(\d{2})(\d{0,5})/, '($1) $2');
            }
            e.target.value = value;
        });
    }
});
</script>

@endsection