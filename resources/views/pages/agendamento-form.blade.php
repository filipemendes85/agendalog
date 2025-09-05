@extends('layout')
@section('conteudo')

    <div class="body-wrapper-inner">
        <div class="container-fluid">
            <div class="card p-4 p-lg-5">
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="p-2 bg-primary bg-opacity-10 rounded me-3">
                            <svg class="text-primary" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl fw-semibold text-dark mb-1">Novo Agendamento</h2>
                            <p class="small text-muted mb-0">Preencha os dados para criar um novo agendamento</p>
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
                        <!-- Operação -->
                        <div class="col-lg-6">
                            <label for="operacao" class="form-label fw-medium">
                                Operação <span class="text-danger">*</span>
                            </label>
                            <select id="operacao" name="operacao" required class="form-select">
                                <option value>Selecione a operação</option>
                                <option value="carga">Carga</option>
                                <option value="descarga">Descarga</option>
                                <option value="transporte">Transporte</option>
                                <option value="armazenagem">Armazenagem</option>
                                <option value="distribuicao">Distribuição</option>
                                <option value="manutencao">Manutenção</option>
                                <option value="inspecao">Inspeção</option>
                                <option value="outro">Outro</option>
                            </select>
                            <div class="form-text">Tipo de operação a ser agendada</div>
                        </div>

                        <!-- Peso -->
                        <div class="col-lg-6">
                            <label for="peso" class="form-label fw-medium">
                                Peso <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" id="peso" name="peso" required step="0.01" min="0" placeholder="0.00" class="form-control" />
                                <select class="form-select flex-shrink-0" id="pesoUnidade" name="pesoUnidade" style="max-width: 80px;">
                                    <option value="kg">kg</option>
                                    <option value="ton">ton</option>
                                    <option value="g">g</option>
                                </select>
                            </div>
                            <div class="form-text">Peso estimado da carga</div>
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <!-- Transportadora -->
                        <div class="col-lg-6">
                            <label for="transportadora" class="form-label fw-medium">
                                Transportadora <span class="text-danger">*</span>
                            </label>
                            <div class="position-relative">
                                <input type="text" id="transportadora" name="transportadora" required placeholder="Digite ou pesquise a transportadora" class="form-control" autocomplete="off" />
                                <div class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div id="transportadoraSuggestions" class="suggestions-dropdown d-none">
                                <!-- Suggestions will be populated here -->
                            </div>
                            <div class="form-text">Empresa responsável pelo transporte</div>
                        </div>

                        <!-- Data Inicial -->
                        <div class="col-lg-6">
                            <label for="dataInicial" class="form-label fw-medium">
                                Data Inicial <span class="text-danger">*</span>
                            </label>
                            <div class="position-relative">
                                <input type="datetime-local" id="dataInicial" name="dataInicial" required class="form-control" min />
                                <div class="position-absolute top-50 end-0 translate-middle-y pe-3 text-muted" style="pointer-events: none;">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="form-text">Data e horário de início da operação</div>
                        </div>
                    </div>

                    <!-- Observação -->
                    <div class="mb-5">
                        <label for="observacao" class="form-label fw-medium">
                            Observação
                        </label>
                        <textarea id="observacao" name="observacao" rows="4" placeholder="Informações adicionais, instruções especiais, restrições..." class="form-control" style="resize: none;"></textarea>
                        <div class="d-flex justify-content-between mt-1">
                            <div class="form-text">Detalhes e observações sobre o agendamento</div>
                            <div class="form-text" id="charCount">0 / 500 caracteres</div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-5">
                        <label class="form-label fw-medium">
                            Status <span class="text-danger">*</span>
                        </label>
                        <div class="row g-3">
                            <div class="col-6 col-lg-3">
                                <label class="position-relative">
                                    <input type="radio" name="status" value="pendente" class="visually-hidden" required />
                                    <div class="status-option text-center">
                                        <div class="d-flex justify-content-center mb-2">
                                            <div class="bg-warning rounded-circle" style="width: 12px; height: 12px;"></div>
                                        </div>
                                        <div>
                                            <p class="small fw-medium text-dark mb-1">Pendente</p>
                                            <p class="small text-muted mb-0">Aguardando confirmação</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="col-6 col-lg-3">
                                <label class="position-relative">
                                    <input type="radio" name="status" value="confirmado" class="visually-hidden" />
                                    <div class="status-option text-center">
                                        <div class="d-flex justify-content-center mb-2">
                                            <div class="bg-info rounded-circle" style="width: 12px; height: 12px;"></div>
                                        </div>
                                        <div>
                                            <p class="small fw-medium text-dark mb-1">Confirmado</p>
                                            <p class="small text-muted mb-0">Agendamento confirmado</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="col-6 col-lg-3">
                                <label class="position-relative">
                                    <input type="radio" name="status" value="em_progresso" class="visually-hidden" />
                                    <div class="status-option text-center">
                                        <div class="d-flex justify-content-center mb-2">
                                            <div class="rounded-circle animate-pulse" style="width: 12px; height: 12px; background-color: var(--color-purple-500);"></div>
                                        </div>
                                        <div>
                                            <p class="small fw-medium text-dark mb-1">Em Progresso</p>
                                            <p class="small text-muted mb-0">Operação em andamento</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="col-6 col-lg-3">
                                <label class="position-relative">
                                    <input type="radio" name="status" value="concluido" class="visually-hidden" />
                                    <div class="status-option text-center">
                                        <div class="d-flex justify-content-center mb-2">
                                            <div class="bg-success rounded-circle" style="width: 12px; height: 12px;"></div>
                                        </div>
                                        <div>
                                            <p class="small fw-medium text-dark mb-1">Concluído</p>
                                            <p class="small text-muted mb-0">Operação finalizada</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-text mt-2">Selecione o status atual do agendamento</div>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex flex-column flex-sm-row gap-3 pt-4 border-top">
                        <div class="flex-fill">
                            <div class="d-flex flex-column flex-sm-row gap-3">
                                <button type="button" id="saveDraftBtn" class="btn btn-secondary d-flex align-items-center justify-content-center">
                                    <svg class="me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    Salvar como Rascunho
                                </button>
                                
                                <button type="submit" class="btn btn-primary flex-fill px-4 py-2 fs-6" id="submitBtn">
                                    <svg class="me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Salvar Agendamento
                                </button>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="d-flex align-items-center">
                            <button type="button" id="clearFormBtn" class="btn btn-outline-secondary p-2" title="Limpar formulário">
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