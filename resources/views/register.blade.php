<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AgendaLog - Ecollogistics</title>
  <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>

<body>

  <!--  Body Wrapper -->

  @if (session('loginErro') || $errors->any())
    <div class="toast-container position-fixed top-10 end-0 p-3 show">
      <div class="toast align-items-center bg-danger" role="alert" aria-live="assertive" aria-atomic="true" id="toastLoginErro">
          <div class="d-flex">
              <div class="toast-body text-white">
                @foreach ($errors->all() as $error)
                  {{ $error }}<br>
                @endforeach
              </div>
              <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
      </div>
    </div>
  @endif


  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('loginErro'))
                    <div class="alert alert-success">
                        {{ session('loginErro') }}
                    </div>
                @endif --}}
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="./assets/images/logos/logo.png" alt="" class="img-fluid">
                </a>

                @if (session()->has('success'))

                  <div class="alert alert-success">
                    Registro realizado com sucesso
                  </div>
                  <p class="justify-content-center">
                    <i class="ti ti-eye"></i>
                    Acesso o e-mail informado para fazer verificação/confirmação de acesso
                  </p>
                  <Br>
                  <a href="/login" class="btn btn-outline-primary mx-3 mt-2 d-block">Reenviar link de verificação</a>

                @else
                  
                  <p class="text-center">Solicitar acesso ao sistema como transportadora</p>
                  
                  <form action="/register" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="inputName" class="form-label">Nome do Usuário</label>
                      <input type="text" class="form-control" id="inputName" name="name" value="{{old('name')}}" aria-describedby="nameHelp">
                    </div>
                    <div class="mb-3">
                      <label for="inputCNPJ" class="form-label">CNPJ da Transportadora</label>
                      <input type="text" class="form-control" id="inputCNPJ" name="cnpj" value="{{old('cnpj')}}" aria-describedby="nameHelp">
                    </div>
                    <div class="mb-3">
                      <label for="inputEmail" class="form-label">E-mail do Usuário</label>
                      <input type="email" class="form-control" id="inputEmail" name="email" value="{{old('email')}}"aria-describedby="emailHelp">
                    </div>
                    <div class="mb-4">
                      <label for="inputSenha" class="form-label">Senha</label>
                      <div class="input-group">
                        <input type="password" class="form-control" id="inputSenha" name="password" value=""placeholder="Digite sua senha">
                        <button class="btn btn-outline-secondary" type="button" id="toggleSenha">
                          <i class="ti ti-eye"></i>
                        </button>
                      </div>
                      <div class="form-text" id="lblSenha">Informe a senha</div>
                    </div>
                    <div class="mb-4">
                      <label for="inputSenha" class="form-label">Repitir a senha</label>
                      <div class="input-group">
                        <input type="password" class="form-control" id="inputSenhaConfirmacao" name="password_confirmation" placeholder="Repitir a senha">
                        <button class="btn btn-outline-secondary" type="button" id="toggleSenhaConfirmacao">
                          <i class="ti ti-eye"></i>
                        </button>
                      </div>
                      <div class="form-text" id="lblSenhaConfirmacao">Confirme a senha</div>
                    </div>
                    {{-- <a href="./index.html" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Entrar</a> --}}
                    <div class="row">
                      <div class="col-md-8 col-sm-6">
                        <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" type="submit" id="btnEntrar">Solicitar</button>
                      </div>
                      <div class="col-md-4 col-sm-6">
                        <a class="btn btn-outline-primary w-100 py-8 fs-4 mb-4 rounded-2" href='/login'>Voltar</a>
                      </div>  
                    </div>

                  </form>

                @endif  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/libs/jquery/dist/jquery.mask.min.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  <script>
    const senhaInput = document.getElementById("inputSenha");
    const toggleBtn = document.getElementById("toggleSenha");
    const icon = toggleBtn.querySelector("i");

    toggleBtn.addEventListener("click", () => {
      const isPassword = senhaInput.type === "password";
      senhaInput.type = isPassword ? "text" : "password";
      icon.classList.toggle("bi-eye");
      icon.classList.toggle("bi-eye-slash");
    });

    const toast = document.getElementById('toastLoginErro');
    if (toast != null){
      var myToast = new bootstrap.Toast(toast);
      myToast.show();
    }

    $(document).ready(function(){
      $('#inputCNPJ').mask('00.000.000/0000-00');
    });

    function validarSenha(event, label, msgPadrao) {

        var senha =  event.target.value;
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

    txtSenha = document.getElementById('inputSenha');
    txtSenha.addEventListener('input', function(event){
      validarSenha(event, 'lblSenha', 'Informe a senha');
    });
    txtSenhaConfirmacao = document.getElementById('inputSenhaConfirmacao');
    txtSenhaConfirmacao.addEventListener('input', function(event){
      validarSenha(event, 'lblSenhaConfirmacao', 'Confirme a senha');
    });


  </script>
</body>

</html>