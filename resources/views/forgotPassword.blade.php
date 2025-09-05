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
                  <img src="./assets/images/logos/logo.png" alt="" class="img-fluid">
                </a>
                
                @if (session()->has('passwordresetErro'))
                    
                    <div class="alert alert-danger">
                        {{ session('passwordresetErro') }}
                    </div>
                    
                @endif 

                @if (session()->has('passwordresetSuccess'))
                
                  <div class="alert alert-success">
                      E-mail enviado com sucesso!
                  </div>
                  <p class="text-center">Verifique sua caixa de entrada ou span para acessar o link de re-criar a senha.</p>  
                
                @else

                  <p class="text-center">Informe o e-mail de cadastro para re-criar a senha</p>
                  <form action="/passwordreset" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="inputEmail" class="form-label">E-mail</label>
                      <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp">
                    </div>
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

</body>

</html>