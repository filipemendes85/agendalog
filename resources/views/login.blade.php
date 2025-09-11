<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgendaLog - Ecollogistics</title>
    <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="./assets/css/styles.min.css" />
    <link rel="stylesheet" href="./assets/css/login.css" />
</head>

<body>
    <!-- Toast de erro -->
    @if (session('loginErro') || $errors->any())
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
            <div class="toast align-items-center custom-toast" role="alert" aria-live="assertive" aria-atomic="true"
                id="toastLoginErro">
                <div class="d-flex">
                    <div class="toast-body text-white">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                        {{ session('loginErro') }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto text-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="login-container">
        <div class="login-card">
            <div class="card mb-0 shadow">
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                        <img src="./assets/images/logos/logo.png" alt="Ecollogistics Logo" class="img-fluid">
                    </a>

                    <p class="text-center mb-4">Sistema para controle de Agendamentos</p>

                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Usuário</label>
                            <input type="email" class="form-control" id="inputEmail" name="email"
                                aria-describedby="emailHelp" required>
                        </div>

                        <div class="mb-4">
                            <label for="inputSenha" class="form-label">Senha</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="inputSenha" name="password"
                                    placeholder="Digite sua senha" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleSenha">
                                    <i class="ti ti-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap">
                            <a class="text-primary fw-bold" href="./passwordreset">Esqueci a senha</a>
                        </div>

                        <button class="btn btn-primary w-100 py-3 fs-4 mb-4 rounded-2" type="submit"
                            id="btnEntrar">Entrar</button>

                        <div class="d-flex align-items-center justify-content-center flex-wrap">
                            <p class="fs-4 mb-0 fw-bold me-2">Você é uma transportadora?</p>
                            <a class="text-primary fw-bold" href="./register">Solicitar acesso</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/login.js"></script>
</body>

</html>