@extends('layout')
@section('conteudo')

    <!-- Toast de erro -->
    @if ($errors->any())
        <div class="toast-container position-fixed top-0 end-0 p-3 show" style="z-index: 9999;">
            <div class="toast align-items-center custom-toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true"
                id="toastUser">
                <div class="d-flex">
                    <div class="toast-body text-white">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                    <button type="button" class="btn-close me-2 m-auto text-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="body-wrapper-inner">
        <div class="container-fluid">
            <div class="card p-4 p-lg-5">
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="p-2 bg-primary bg-opacity-10 rounded me-3">
                            
                            {{-- <i class="ti ti-user-plus text-primary" width="30" height="30"></i> --}}
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-user text-primary"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" /><path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" /></svg>                        </div>
                        <div>
                            <h2 class="text-xl fw-semibold text-dark mb-1">Cadastro de Usuário</h2>
                            <p class="small text-muted mb-0">Inclusão, alteração e exclusão de usuários do sistema</p>
                        </div>
                    </div>
                    
                    <!-- Progress Indicator -->
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar" role="progressbar" style="width: 0%" id="progressBar"></div>
                    </div>
                </div>

                <!-- Form -->
                <form id="usersForm" method="POST" action="{{ isset($user->id) != null ? route('users.update', [$user->id] + request()->query()) : route('users.store') }}">
                    @csrf
                    @if (isset($user->id) != null)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <!-- Basic Information Section -->
                    <div class="row g-4 mb-5">
                        <!-- Nome -->
                        <div class="col-lg-6">
                            <label for="txtNome" class="form-label fw-medium">
                                Nome <span class="text-danger">*</span>
                            </label>
                            <input id="txtNome" name="name" required class="form-control" value="{{old('name', $user->name ?? '')}}">
                            <div class="form-text">Nome completo do usuário</div>
                        </div>

                        <!-- E-mail -->
                        <div class="col-lg-6">
                            <label for="peso" class="form-label fw-medium">
                                E-mail <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="email" id="txtEmail" name="email" required placeholder="nome@gmail.com" class="form-control" value="{{old('email', $user->email ?? '')}}"/>
                            </div>
                            <div class="form-text">E-mail válido para notificação</div>
                        </div>
                    </div>
                    
                    @if (1==2)
                        <div class="row g-4 mb-5" style="display:none;">
                            <!-- Password -->
                            <div class="col-lg-6">
                                <label for="txtNome" class="form-label fw-medium">
                                    Senha <span class="text-danger">*</span>
                                </label>
                                <input type="password" id="txtSenha" name="password" required placeholder="" class="form-control" value="{{old('password')}}"/>
                                <div class="form-text" id="lblSenha">Informe a senha</div>
                            </div>

                            <!-- E-mail -->
                            <div class="col-lg-6">
                                <label for="peso" class="form-label fw-medium">
                                    Confirmar Senha <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="password" id="txtConfirmarSenha" name="password_confirmation" required placeholder="" class="form-control" value=""/>
                                </div>
                                <div class="form-text" id="lblConfirmarSenha">Confirme senha digitada</div>
                            </div>
                        </div>
                    @endif    
                    <div class="row g-4 mb-5">
                        <!-- Transportadora -->
                        <div class="col-lg-6">
                            <label for="transportadora" class="form-label fw-medium">
                                Transportadora
                            </label>
                            <select class="form-select" name="transportadora_id">
                                <option value="">Todos</option>
                                @foreach($transportadoras as $transpotadora)
                                    <option value="{{ $transpotadora->id }}" @selected(old('transportadora_id', $user->transportadora_id ?? '') == $transpotadora->id)>{{ $transpotadora->nome }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Transportadora que o usuário é vinculado (Apenas Usuários externos)</div>
                        </div>

                        <!-- Data Inicial -->
                        <div class="col-lg-6">
                            <label for="switchCheckActive" class="form-label fw-medium">
                                Status do usuário
                            </label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="active" value="true" id="switchCheckActive" {{ old('active', $user->active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="switchCheckActive">Ativo</label>
                            </div>
                        </div>
                    </div>

                    

                    <!-- Form Actions -->
                    <div class="d-flex flex-column flex-sm-row gap-3 pt-4 border-top justify-content-between">
                        
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            @if ( isset($user->id) )
                                <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('formResetPws').submit();">
                                    Alterar Senha
                                </button>
                            @endif    
                        </div>
                        
                        <div class="flex">
                            <div class="d-flex flex-column flex-sm-row gap-3">

                                <button type="submit" class="btn btn-primary flex-fill px-4 py-2 fs-6" id="submitBtn">
                                    <i class="ti ti-file-check" width="16" height="16"></i>
                                    Salvar
                                </button>

                                <a href="{{ route('users.index', request()->query()) }}" class="btn btn-secondary d-flex align-items-center justify-content-center">
                                    <i class="ti ti-x" width="16" height="16"></i>
                                    Fechar
                                </a>

                                @if ( isset($user->id) )
                            
                                    <!-- Quick Actions -->
                                    <div class="d-flex align-items-center">
                                        
                                            <button type="button" class="btn btn-outline-danger p-2" onclick="document.getElementById('formDelete').submit();">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        
                                        {{-- <a href="{{ route('users.destroy', [$user->id] + request()->query()) }}" class="btn btn-outline-danger p-2">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </a> --}}
                                    </div>
                                @endif

                            </div>
                        </div>
                        
                        
                    </div>
                </form>
            </div>
        </div>
    </div>    
    
    @if ( isset($user->id) )
        <form action="{{ route('users.resetpws', [$user->id] + request()->query()) }}" method="POST" style="display:inline;" id="formResetPws" onsubmit="return confirm('Enviar e-mail para definição de senha?')">
            @csrf
        </form>  
    
        <form action="{{ route('users.destroy', [$user->id] + request()->query()) }}" method="POST" style="display:inline;" id="formDelete" onsubmit="return confirm('Confirma a exclusão?')">
            @csrf
            @method('DELETE')
        </form>
    @endif

@endsection

@push('pagescript')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const form = document.getElementById('usersForm');
            const progressBar = document.getElementById('progressBar');

            function updateProgress() {
                const requiredFields = form.querySelectorAll('[required]');
                let filledFields = 0;

                requiredFields.forEach(field => {
                    if (field.type === 'radio') {
                        if (form.querySelector(`input[name="${field.name}"]:checked`)) {
                            filledFields++;
                        }
                    } else if (field.id == 'txtSenha' && field.value.trim() !== '') {
                        if (validarSenha(field.value, 'lblSenha',  'Informe a senha'))
                            filledFields++;
                    } else if (field.id == 'txtConfirmarSenha' && field.value.trim() !== '') {
                        if (validarSenha(field.value, 'lblConfirmarSenha', 'Confirme a senha informada'))
                            filledFields++;
                    } else if (field.value.trim() !== '') {
                        filledFields++;
                    }
                });

                const progress = Math.round((filledFields / requiredFields.length) * 100);
                progressBar.style.width = `${progress}%`;
            }

            // Update progress on field changes
            form.addEventListener('input', updateProgress);
            form.addEventListener('change', updateProgress);
        });
        
        function validarSenha(senha, label, msgPadrao) {
        const requisitos = [
            { regex: /.{6,}/, mensagem: "Mínimo 6 caracteres" },
            { regex: /[A-Z]/, mensagem: "Ao menos 1 letra maiúscula" },
            { regex: /\p{N}/u, mensagem: "Ao menos 1 número" },
            { regex: /[\W_]/, mensagem: "Ao menos 1 caractere especial" }
        ];

        let erros = [];

        requisitos.forEach(regra => {
            if (!regra.regex.test(senha)) {
            erros.push(regra.mensagem);
            }
        });
        document.getElementById(label).innerHTML = msgPadrao;
        if (erros.length > 0){
            document.getElementById(label).innerHTML = "❌ Senha inválida:<br>" + erros.join("<br>");
            return false;
        }

        return true;
        }

        const toast = document.getElementById('toastUser');
        if (toast != null){
            var myToast = new bootstrap.Toast(toast);
            myToast.show();
        }


    </script>
@endpush