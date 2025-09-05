<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom CSS */
        .sidebar {
            min-height: 100vh;
            transition: all 0.3s;
        }
        .sidebar-link {
            transition: all 0.2s;
        }
        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .login-container {
            background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Login Screen (visible by default) -->
    <div id="login-screen" class="min-vh-100 d-flex align-items-center justify-content-center login-container">
        <div class="card shadow-lg" style="width: 400px; max-width: 95%;">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="fas fa-lock fa-3x text-primary mb-3"></i>
                    <h2 class="h4">Painel de Controle</h2>
                    <p class="text-muted">Faça login para continuar</p>
                </div>
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuário</label>
                        <input type="text" class="form-control" id="username" placeholder="Digite seu usuário" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" placeholder="Digite sua senha" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Lembrar de mim</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">Entrar</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Esqueceu a senha?</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recuperar Senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Digite seu e-mail para receber instruções de recuperação de senha.</p>
                    <form>
                        <div class="mb-3">
                            <label for="recoveryEmail" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="recoveryEmail" placeholder="seu@email.com">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>