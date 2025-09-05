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
                {{ session('loginErro') }}
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
                 --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif 
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="./assets/images/logos/logo.png" alt="" class="img-fluid">
                </a>
                <p class="text-center">Sistema para controle de Agendamentos</p>
                <form action="/login" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="inputEmail" class="form-label">Usuario</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="inputSenha" class="form-label">Senha</label>
                    <div class="input-group">
                      <input type="password" class="form-control" id="inputSenha" name="password" placeholder="Digite sua senha">
                      <button class="btn btn-outline-secondary" type="button" id="toggleSenha">
                        <i class="ti ti-eye"></i>
                      </button>
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-end mb-4">
                    {{-- <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div> --}}
                    <a class="text-primary fw-bold" href="./passwordreset">Esqueci a senha</a>
                  </div>
                  {{-- <a href="./index.html" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Entrar</a> --}}
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" type="submit" id="btnEntrar">Entrar</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Você é uma transportadora?</p>
                    <a class="text-primary fw-bold ms-2" href="./register">Solicitar acesso</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
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
  </script>
</body>

</html>