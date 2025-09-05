<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AgendaLog - Ecollogistics</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>

  <!--  Body Wrapper -->

  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../assets/images/logos/logo.png" alt="" class="img-fluid">
                </a>
                @if (session()->has('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
                  <a href="/login" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2"> Login </a>
                @else     
                  <p class="text-center">Informe sua nova senha</p>
                  <form action="/resetpassword" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="mb-4">
                      <label for="inputSenha" class="form-label">Senha</label>
                      <div class="input-group">
                        <input type="password" class="form-control" id="inputSenha" name="password" placeholder="Digite sua senha">
                        <button class="btn btn-outline-secondary" type="button" id="toggleSenha">
                          <i class="ti ti-eye"></i>
                        </button>
                      </div>
                    </div>
                    <div class="mb-4">
                      <label for="inputSenha" class="form-label">Repitir a senha</label>
                      <div class="input-group">
                        <input type="password" class="form-control" id="inputSenhaConfirmacao" name="password_confirmation" placeholder="Repitir a senha">
                        <button class="btn btn-outline-secondary" type="button" id="toggleSenhaConfirmacao">
                          <i class="ti ti-eye"></i>
                        </button>
                      </div>
                    </div>
                    
                    {{-- <a href="./index.html" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Entrar</a> --}}
                    <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" type="submit" id="btnEntrar">Confirmar</button>
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

    const senhaInputConfirm = document.getElementById("inputSenhaConfirmacao");
    const toggleBtnConfirm = document.getElementById("toggleSenhaConfirmacao");
    const iconConfirm = toggleBtn.querySelector("i");
    toggleBtnConfirm.addEventListener("click", () => {
      const isPassword = senhaInputConfirm.type === "password";
      senhaInputConfirm.type = isPassword ? "text" : "password";
      iconConfirm.classList.toggle("bi-eye");
      iconConfirm.classList.toggle("bi-eye-slash");
    });

  </script>
</body>

</html>