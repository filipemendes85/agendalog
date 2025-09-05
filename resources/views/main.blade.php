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

    <!-- Dashboard (hidden by default) -->
    <div id="dashboard" class="d-none">
        <!-- Sidebar -->
        <div class="sidebar bg-dark text-white position-fixed" style="width: 250px;">
            <div class="p-3">
                <h4 class="text-center mb-4">Painel Admin</h4>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link sidebar-link active" onclick="showSection('dashboard-section')">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link sidebar-link" onclick="showSection('users-section')">
                            <i class="fas fa-users me-2"></i> Usuários
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link sidebar-link" onclick="showSection('products-section')">
                            <i class="fas fa-boxes me-2"></i> Produtos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link sidebar-link" onclick="showSection('orders-section')">
                            <i class="fas fa-shopping-cart me-2"></i> Pedidos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link sidebar-link" onclick="showSection('settings-section')">
                            <i class="fas fa-cog me-2"></i> Configurações
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content" style="margin-left: 250px; padding: 20px;">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand navbar-light bg-white shadow-sm mb-4">
                <div class="container-fluid">
                    <button class="btn btn-sm btn-outline-secondary me-2" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Nova mensagem</a></li>
                                <li><a class="dropdown-item" href="#">Alerta do sistema</a></li>
                                <li><a class="dropdown-item" href="#">Atualização disponível</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> Admin
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                                <li><a class="dropdown-item" href="#">Configurações</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#" onclick="logout()">Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Dashboard Section -->
            <div id="dashboard-section" class="content-section">
                <h4 class="mb-4">Dashboard</h4>
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card bg-primary text-white card-hover h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">Usuários</h6>
                                        <h2 class="mb-0">1,254</h2>
                                    </div>
                                    <i class="fas fa-users fa-2x opacity-50"></i>
                                </div>
                                <div class="mt-3">
                                    <span class="badge bg-white text-primary">+12% este mês</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-success text-white card-hover h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">Produtos</h6>
                                        <h2 class="mb-0">568</h2>
                                    </div>
                                    <i class="fas fa-boxes fa-2x opacity-50"></i>
                                </div>
                                <div class="mt-3">
                                    <span class="badge bg-white text-success">+5% este mês</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-warning text-white card-hover h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">Pedidos</h6>
                                        <h2 class="mb-0">1,024</h2>
                                    </div>
                                    <i class="fas fa-shopping-cart fa-2x opacity-50"></i>
                                </div>
                                <div class="mt-3">
                                    <span class="badge bg-white text-warning">+8% este mês</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-info text-white card-hover h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">Receita</h6>
                                        <h2 class="mb-0">R$ 24,780</h2>
                                    </div>
                                    <i class="fas fa-dollar-sign fa-2x opacity-50"></i>
                                </div>
                                <div class="mt-3">
                                    <span class="badge bg-white text-info">+15% este mês</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-white">
                                <h6 class="mb-0">Vendas Mensais</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="salesChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-white">
                                <h6 class="mb-0">Atividades Recentes</h6>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-0">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <span class="avatar bg-primary text-white rounded-circle p-2">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <small class="text-muted">5 min atrás</small>
                                                <p class="mb-0">Novo usuário registrado</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <span class="avatar bg-success text-white rounded-circle p-2">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <small class="text-muted">12 min atrás</small>
                                                <p class="mb-0">Novo pedido recebido</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <span class="avatar bg-warning text-white rounded-circle p-2">
                                                    <i class="fas fa-truck"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <small class="text-muted">23 min atrás</small>
                                                <p class="mb-0">Pedido enviado</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <span class="avatar bg-info text-white rounded-circle p-2">
                                                    <i class="fas fa-comment"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <small class="text-muted">1 hora atrás</small>
                                                <p class="mb-0">Novo comentário recebido</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Section -->
            <div id="users-section" class="content-section d-none">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Gerenciar Usuários</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fas fa-plus me-1"></i> Adicionar Usuário
                    </button>
                </div>
                
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Cargo</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>João Silva</td>
                                        <td>joao@exemplo.com</td>
                                        <td>Administrador</td>
                                        <td><span class="badge bg-success">Ativo</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Maria Souza</td>
                                        <td>maria@exemplo.com</td>
                                        <td>Editor</td>
                                        <td><span class="badge bg-success">Ativo</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Carlos Oliveira</td>
                                        <td>carlos@exemplo.com</td>
                                        <td>Usuário</td>
                                        <td><span class="badge bg-warning">Pendente</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add User Modal -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Adicionar Novo Usuário</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="userName" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" id="userName" placeholder="Digite o nome">
                                </div>
                                <div class="mb-3">
                                    <label for="userEmail" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="userEmail" placeholder="Digite o e-mail">
                                </div>
                                <div class="mb-3">
                                    <label for="userPassword" class="form-label">Senha</label>
                                    <input type="password" class="form-control" id="userPassword" placeholder="Digite a senha">
                                </div>
                                <div class="mb-3">
                                    <label for="userRole" class="form-label">Cargo</label>
                                    <select class="form-select" id="userRole">
                                        <option selected>Selecione um cargo</option>
                                        <option value="admin">Administrador</option>
                                        <option value="editor">Editor</option>
                                        <option value="user">Usuário</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div id="products-section" class="content-section d-none">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Gerenciar Produtos</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fas fa-plus me-1"></i> Adicionar Produto
                    </button>
                </div>
                
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Imagem</th>
                                        <th>Nome</th>
                                        <th>Categoria</th>
                                        <th>Preço</th>
                                        <th>Estoque</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <img src="https://via.placeholder.com/50" alt="Produto" class="rounded" width="50">
                                        </td>
                                        <td>Notebook Pro</td>
                                        <td>Eletrônicos</td>
                                        <td>R$ 4.599,00</td>
                                        <td>12</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <img src="https://via.placeholder.com/50" alt="Produto" class="rounded" width="50">
                                        </td>
                                        <td>Smartphone X</td>
                                        <td>Celulares</td>
                                        <td>R$ 2.999,00</td>
                                        <td>25</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            <img src="https://via.placeholder.com/50" alt="Produto" class="rounded" width="50">
                                        </td>
                                        <td>Fone Bluetooth</td>
                                        <td>Acessórios</td>
                                        <td>R$ 299,00</td>
                                        <td>42</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Product Modal -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Adicionar Novo Produto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="productName" class="form-label">Nome do Produto</label>
                                        <input type="text" class="form-control" id="productName" placeholder="Digite o nome">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="productCategory" class="form-label">Categoria</label>
                                        <select class="form-select" id="productCategory">
                                            <option selected>Selecione uma categoria</option>
                                            <option value="electronics">Eletrônicos</option>
                                            <option value="clothing">Vestuário</option>
                                            <option value="home">Casa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="productPrice" class="form-label">Preço</label>
                                        <input type="number" class="form-control" id="productPrice" placeholder="0,00">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="productStock" class="form-label">Estoque</label>
                                        <input type="number" class="form-control" id="productStock" placeholder="0">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="productDescription" class="form-label">Descrição</label>
                                    <textarea class="form-control" id="productDescription" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="productImage" class="form-label">Imagem do Produto</label>
                                    <input class="form-control" type="file" id="productImage">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Section -->
            <div id="orders-section" class="content-section d-none">
                <h4 class="mb-4">Gerenciar Pedidos</h4>
                
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Data</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#ORD-1001</td>
                                        <td>João Silva</td>
                                        <td>12/05/2023</td>
                                        <td>R$ 1.299,00</td>
                                        <td><span class="badge bg-success">Entregue</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-1002</td>
                                        <td>Maria Souza</td>
                                        <td>15/05/2023</td>
                                        <td>R$ 4.599,00</td>
                                        <td><span class="badge bg-primary">Em transporte</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-1003</td>
                                        <td>Carlos Oliveira</td>
                                        <td>18/05/2023</td>
                                        <td>R$ 299,00</td>
                                        <td><span class="badge bg-warning">Processando</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div id="settings-section" class="content-section d-none">
                <h4 class="mb-4">Configurações</h4>
                
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="siteName" class="form-label">Nome do Site</label>
                                <input type="text" class="form-control" id="siteName" value="Painel Admin">
                            </div>
                            <div class="mb-3">
                                <label for="siteLogo" class="form-label">Logo do Site</label>
                                <input class="form-control" type="file" id="siteLogo">
                            </div>
                            <div class="mb-3">
                                <label for="siteTheme" class="form-label">Tema</label>
                                <select class="form-select" id="siteTheme">
                                    <option value="light" selected>Claro</option>
                                    <option value="dark">Escuro</option>
                                    <option value="blue">Azul</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="siteDescription" class="form-label">Descrição do Site</label>
                                <textarea class="form-control" id="siteDescription" rows="3">Painel de administração do sistema</textarea>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="maintenanceMode">
                                <label class="form-check-label" for="maintenanceMode">Modo manutenção</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar Configurações</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Login functionality
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Simple validation
            if(username === 'admin' && password === 'admin') {
                document.getElementById('login-screen').classList.add('d-none');
                document.getElementById('dashboard').classList.remove('d-none');
                initDashboard();
            } else {
                alert('Usuário ou senha incorretos!');
            }
        });
        
        // Logout functionality
        function logout() {
            document.getElementById('dashboard').classList.add('d-none');
            document.getElementById('login-screen').classList.remove('d-none');
            document.getElementById('username').value = '';
            document.getElementById('password').value = '';
        }
        
        // Show section
        function showSection(sectionId) {
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.add('d-none');
            });
            document.getElementById(sectionId).classList.remove('d-none');
            
            // Update active menu item
            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
        }
        
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            
            if(sidebar.style.width === '250px') {
                sidebar.style.width = '70px';
                mainContent.style.marginLeft = '70px';
                document.querySelectorAll('.sidebar-link span').forEach(text => {
                    text.style.display = 'none';
                });
            } else {
                sidebar.style.width = '250px';
                mainContent.style.marginLeft = '250px';
                document.querySelectorAll('.sidebar-link span').forEach(text => {
                    text.style.display = 'inline';
                });
            }
        });
        
        // Initialize dashboard
        function initDashboard() {
            // Sales chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Vendas 2023',
                        data: [12000, 19000, 15000, 22000, 18000, 25000, 30000],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>