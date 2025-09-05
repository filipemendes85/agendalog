@extends('layout')
@section('conteudo')

    <div class="body-wrapper-inner">
        <div class="container-fluid">
            <div class="card p-4 p-lg-5">
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="p-2 bg-primary bg-opacity-10 rounded me-3">
                            
                            {{-- <i class="ti ti-user-plus text-primary" width="30" height="30"></i> --}}
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-user text-primary"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" /><path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" /></svg>                        </div>
                        <div>
                            <h2 class="text-xl fw-semibold text-dark mb-1">Novo Usuario</h2>
                            <p class="small text-muted mb-0">Preencha os dados para criar um novo usuário</p>
                        </div>
                    </div>
                    
                    <!-- Progress Indicator -->
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar" role="progressbar" style="width: 0%" id="progressBar"></div>
                    </div>
                </div>

                <!-- Form -->
                <form id="appointmentForm">
                    <!-- Basic Information Section -->
                    <div class="row g-4 mb-5">
                        <!-- Nome -->
                        <div class="col-lg-6">
                            <label for="txtNome" class="form-label fw-medium">
                                Nome <span class="text-danger">*</span>
                            </label>
                            <input id="txtNome" name="name" required class="form-control">
                            <div class="form-text">Nome completo do usuário</div>
                        </div>

                        <!-- E-mail -->
                        <div class="col-lg-6">
                            <label for="peso" class="form-label fw-medium">
                                E-mail <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="email" id="txtEmail" name="email" required placeholder="nome@gmail.com" class="form-control" />
                            </div>
                            <div class="form-text">E-mail válido para notificação</div>
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <!-- Password -->
                        <div class="col-lg-6">
                            <label for="txtNome" class="form-label fw-medium">
                                Senha <span class="text-danger">*</span>
                            </label>
                            <input type="password" id="txtSenha" name="password" required placeholder="" class="form-control" />
                            <div class="form-text">Informe a senha</div>
                        </div>

                        <!-- E-mail -->
                        <div class="col-lg-6">
                            <label for="peso" class="form-label fw-medium">
                                Confirmar Senha <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" id="txtConfirmaSenha" name="password_confirm" required placeholder="" class="form-control" />
                            </div>
                            <div class="form-text">Confirme a mesma senha digitada</div>
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <!-- Transportadora -->
                        <div class="col-lg-6">
                            <label for="transportadora" class="form-label fw-medium">
                                Transportadora
                            </label>
                            <select class="form-select" name="transportadoraId">
                                <option value="">Todos</option>
                                {{-- @foreach($transportadoras as $transpotadora)
                                    <option value="{{ $transpotadora->id }}" @selected($transportadoraId == $transpotadora->id)>{{ $transpotadora->nome }}</option>
                                @endforeach --}}
                            </select>
                            <div class="form-text">Transportadora que o usuário é vinculado (Apenas Usuários externos)</div>
                        </div>

                        <!-- Data Inicial -->
                        <div class="col-lg-6">
                            <label for="transportadora" class="form-label fw-medium">
                                Status do usuário
                            </label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked" checked>
                                <label class="form-check-label" for="switchCheckChecked">Ativo</label>
                            </div>
                        </div>
                    </div>

                    

                    <!-- Form Actions -->
                    <div class="d-flex flex-column flex-sm-row gap-3 pt-4 border-top justify-content-end">
                  
                        
                        <div class="flex">
                            <div class="d-flex flex-column flex-sm-row gap-3">

                                <button type="submit" class="btn btn-primary flex-fill px-4 py-2 fs-6" id="submitBtn">
                                    <i class="ti ti-file-check" width="16" height="16"></i>
                                    {{-- <svg class="me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg> --}}
                                    Salvar
                                </button>

                                <button type="button" id="saveDraftBtn" class="btn btn-secondary d-flex align-items-center justify-content-center">
                                    <i class="ti ti-x" width="16" height="16"></i>
                                    Fechar
                                </button>

                            </div>
                        </div>

                              <!-- Quick Actions -->
                        <div class="d-flex align-items-center">
                            <button type="button" id="clearFormBtn" class="btn btn-outline-danger p-2" title="Excluir Registro">
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

@endsection