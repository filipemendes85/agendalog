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
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../assets/images/logos/logo.png" alt="" class="img-fluid">
                </a>

                @if (session()->has('successLink'))
                    <div class="alert alert-success mt-10">
                    <ul>
                        <li>{{ session('successLink') }}</li>
                    </ul>
                    </div>
                @elseif (session()->has('successVerify'))
                    <div class="alert alert-success mt-10">
                    <ul>
                        <li>{{ session('successVerify') }}</li>
                    </ul>
                    </div>
                @elseif (session()->has('errorLink'))
                    <div class="alert alert-danger mt-10">
                    <ul>
                        <li>{{ session('errorLink') }}</li>
                    </ul>
                    </div> 
                    <a href="/login" class="btn btn-outline-primary w-100 py-8 fs-4 mb-4 rounded-2">Reenviar link</a>
                @elseif (session()->has('errorUser'))
                    <div class="alert alert-danger mt-10">
                    <ul>
                        <li>{{ session('errorUser') }}</li>
                    </ul>
                    </div> 
                @elseif (session()->has('error'))
                    
                    <div class="alert alert-danger">
                    <ul>
                        <li>{{ session('error') }}</li>
                    </ul>
                    </div>

                @endif
                <a href="/login" class="btn btn-outline-primary w-100 py-8 fs-4 mb-4 rounded-2">Ir para Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>