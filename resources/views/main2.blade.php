<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #36b9cc;
            --dark-color: #5a5c69;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
        }
        
        .sidebar {
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            margin-bottom: 0.2rem;
        }
        
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .sidebar .nav-link i {
            margin-right: 0.25rem;
        }
        
        .topbar {
            height: 4.375rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            background-color: #fff;
        }
        
        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }
        
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
        }
        
        .bg-primary {
            background-color: var(--primary-color) !important;
        }
        
        .bg-success {
            background-color: #1cc88a !important;
        }
        
        .bg-info {
            background-color: var(--accent-color) !important;
        }
        
        .bg-warning {
            background-color: #f6c23e !important;
        }
        
        .chart-area {
            position: relative;
            height: 10rem;
            width: 100%;
        }
        
        @media (min-width: 768px) {
            .sidebar {
                width: 14rem !important;
            }
            
            .sidebar.toggled {
                margin-left: -14rem;
            }
            
            .content {
                margin-left: 14rem;
                width: calc(100% - 14rem);
            }
            
            .content.toggled {
                margin-left: 0;
                width: 100%;
            }
        }
        
        /* Login Page */
        .bg-login {
            background-color: var(--primary-color);
        }
        
        .btn-login {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-login:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
        }
    </style>
</head>
<body>
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-login text-white">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="loginEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="loginPassword" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Lembrar-me</label>
                        </div>
                        <button type="submit" class="btn btn-login text-white w-100">Entrar</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Criar uma conta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="registerModalLabel">Cadastro</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">Sobrenome</label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="registerEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="registerPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirmar Senha</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Já tem uma conta? Faça login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Layout (hidden until login) -->
    <div id="dashboardLayout" style="display: none;">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-brand d-flex align-items-center justify-content-center p-3">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin Dashboard</div>
            </div>
            
            <hr class="sidebar-divider my-0">
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <hr class="sidebar-divider">
                
                <div class="sidebar-heading">
                    Interface
                </div>
                
                <li class="nav-item">
                    <a class="nav-link" href="#users" id="usersLink">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Usuários</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#products">
                        <i class="fas fa-fw fa-boxes"></i>
                        <span>Produtos</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#orders">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                        <span>Pedidos</span>
                    </a>
                </li>
                
                <hr class="sidebar-divider">
                
                <div class="sidebar-heading">
                    Configurações
                </div>
                
                <li class="nav-item">
                    <a class="nav-link" href="#settings">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Configurações</span>
                    </a>
                </li>
            </ul>
            
            <div class="text-center d-none d-md-inline p-3">
                <button class="btn btn-sm btn-light" id="sidebarToggle">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
        </nav>
        
        <!-- Content Wrapper -->
        <div id="content" class="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand topbar mb-4 static-top">
                <div class="container-fluid">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge bg-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Central de Alertas
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">Dezembro 12, 2023</div>
                                        <span class="font-weight-bold">Um novo relatório mensal está pronto para download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">Dezembro 7, 2023</div>
                                        $290.29 foi depositado em sua conta!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">Dezembro 2, 2023</div>
                                        Alertas de gastos: Estamos perto do orçamento definido.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Mostrar todos os alertas</a>
                            </div>
                        </li>
                        
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge bg-success badge-counter">7</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Central de Mensagens
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Olá, estou interessado no seu produto. Podemos conversar?</div>
                                        <div class="small text-gray-500">Cliente · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/cssvEZacHvQ/60x60" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Tenho um problema com meu pedido recente</div>
                                        <div class="small text-gray-500">Cliente · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/IWLOvomUmWU/60x60" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Obrigado pelo suporte rápido!</div>
                                        <div class="small text-gray-500">Cliente · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Ler todas as mensagens</a>
                            </div>
                        </li>
                        
                        <div class="topbar-divider d-none d-sm-block"></div>
                        
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configurações
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Log de Atividades
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="logoutBtn">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Main Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Gerar Relatório
                    </a>
                </div>
                
                <!-- Content Row -->
                <div class="row">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Faturamento (Mensal)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">R$40,000</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Earnings (Annual) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Faturamento (Anual)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">R$215,000</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tasks Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tarefas
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pedidos Pendentes</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Content Row -->
                <div class="row">
                    <!-- Area Chart -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Visão Geral do Faturamento</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Opções:</div>
                                        <a class="dropdown-item" href="#">Exportar Dados</a>
                                        <a class="dropdown-item" href="#">Imprimir</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Algo mais</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="myAreaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Fontes de Tráfego</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Opções:</div>
                                        <a class="dropdown-item" href="#">Exportar Dados</a>
                                        <a class="dropdown-item" href="#">Imprimir</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Algo mais</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-primary"></i> Direto
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-success"></i> Social
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-info"></i> Referência
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Users Table Section (Hidden by default) -->
                <div id="usersSection" style="display: none;">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Gerenciamento de Usuários</h6>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <i class="fas fa-plus"></i> Adicionar Usuário
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="dataTables_length" id="dataTable_length">
                                            <label>
                                                Mostrar 
                                                <select name="dataTable_length" class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> 
                                                entradas
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="dataTable_filter" class="dataTables_filter">
                                            <label>
                                                Buscar:
                                                <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID <i class="fas fa-sort"></i></th>
                                            <th>Nome <i class="fas fa-sort"></i></th>
                                            <th>Email <i class="fas fa-sort"></i></th>
                                            <th>Cargo <i class="fas fa-sort"></i></th>
                                            <th>Status <i class="fas fa-sort"></i></th>
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
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Maria Souza</td>
                                            <td>maria@exemplo.com</td>
                                            <td>Editor</td>
                                            <td><span class="badge bg-success">Ativo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Carlos Oliveira</td>
                                            <td>carlos@exemplo.com</td>
                                            <td>Visualizador</td>
                                            <td><span class="badge bg-warning">Pendente</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Ana Pereira</td>
                                            <td>ana@exemplo.com</td>
                                            <td>Editor</td>
                                            <td><span class="badge bg-success">Ativo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Pedro Costa</td>
                                            <td>pedro@exemplo.com</td>
                                            <td>Visualizador</td>
                                            <td><span class="badge bg-danger">Inativo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Luiza Mendes</td>
                                            <td>luiza@exemplo.com</td>
                                            <td>Administrador</td>
                                            <td><span class="badge bg-success">Ativo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Rafael Lima</td>
                                            <td>rafael@exemplo.com</td>
                                            <td>Editor</td>
                                            <td><span class="badge bg-success">Ativo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Fernanda Alves</td>
                                            <td>fernanda@exemplo.com</td>
                                            <td>Visualizador</td>
                                            <td><span class="badge bg-warning">Pendente</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Gustavo Santos</td>
                                            <td>gustavo@exemplo.com</td>
                                            <td>Editor</td>
                                            <td><span class="badge bg-success">Ativo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Juliana Rocha</td>
                                            <td>juliana@exemplo.com</td>
                                            <td>Visualizador</td>
                                            <td><span class="badge bg-danger">Inativo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                                            Mostrando 1 a 10 de 57 entradas
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled" id="dataTable_previous">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Anterior</a>
                                                </li>
                                                <li class="paginate_button page-item active">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                                </li>
                                                <li class="paginate_button page-item ">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                                </li>
                                                <li class="paginate_button page-item ">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                                                </li>
                                                <li class="paginate_button page-item ">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                                                </li>
                                                <li class="paginate_button page-item ">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                                                </li>
                                                <li class="paginate_button page-item ">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                                                </li>
                                                <li class="paginate_button page-item next" id="dataTable_next">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Próximo</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Add User Modal -->
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="addUserModalLabel">Adicionar Novo Usuário</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addUserForm">
                                    <div class="mb-3">
                                        <label for="userName" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" id="userName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="userEmail" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userRole" class="form-label">Cargo</label>
                                        <select class="form-select" id="userRole" required>
                                            <option value="">Selecione um cargo</option>
                                            <option value="admin">Administrador</option>
                                            <option value="editor">Editor</option>
                                            <option value="viewer">Visualizador</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Senha</label>
                                        <input type="password" class="form-control" id="userPassword" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmUserPassword" class="form-label">Confirmar Senha</label>
                                        <input type="password" class="form-control" id="confirmUserPassword" required>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="userActive" checked>
                                        <label class="form-check-label" for="userActive">Ativo</label>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="saveUserBtn">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Show login modal on page load
        document.addEventListener('DOMContentLoaded', function() {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
            
            // Initialize charts
            initCharts();
            
            // Sidebar toggle functionality
            document.getElementById('sidebarToggle').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('toggled');
                document.getElementById('content').classList.toggle('toggled');
            });
            
            document.getElementById('sidebarToggleTop').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('toggled');
                document.getElementById('content').classList.toggle('toggled');
            });
            
            // Login form submission
            document.getElementById('loginForm').addEventListener('submit', function(e) {
                e.preventDefault();
                var email = document.getElementById('loginEmail').value;
                var password = document.getElementById('loginPassword').value;
                
                // Simple validation
                if(email && password) {
                    // Hide login modal
                    var loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                    loginModal.hide();
                    
                    // Show dashboard
                    document.getElementById('dashboardLayout').style.display = 'block';
                }
            });
            
            // Register form submission
            document.getElementById('registerForm').addEventListener('submit', function(e) {
                e.preventDefault();
                var firstName = document.getElementById('firstName').value;
                var lastName = document.getElementById('lastName').value;
                var email = document.getElementById('registerEmail').value;
                var password = document.getElementById('registerPassword').value;
                var confirmPassword = document.getElementById('confirmPassword').value;
                
                // Simple validation
                if(firstName && lastName && email && password && confirmPassword && password === confirmPassword) {
                    // Hide register modal and show login modal
                    var registerModal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
                    registerModal.hide();
                    
                    var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                    loginModal.show();
                    
                    // Auto-fill login form
                    document.getElementById('loginEmail').value = email;
                    document.getElementById('loginPassword').value = password;
                }
            });
            
            // Logout button
            document.getElementById('logoutBtn').addEventListener('click', function() {
                // Hide dashboard
                document.getElementById('dashboardLayout').style.display = 'none';
                
                // Show login modal
                var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
            });
            
            // Users link click
            document.getElementById('usersLink').addEventListener('click', function(e) {
                e.preventDefault();
                // Hide all sections
                document.querySelectorAll('.container-fluid > div').forEach(function(section) {
                    section.style.display = 'none';
                });
                // Show users section
                document.getElementById('usersSection').style.display = 'block';
            });
            
            // Save user button
            document.getElementById('saveUserBtn').addEventListener('click', function() {
                // Validate form
                var formValid = true;
                var userName = document.getElementById('userName').value;
                var userEmail = document.getElementById('userEmail').value;
                var userRole = document.getElementById('userRole').value;
                var userPassword = document.getElementById('userPassword').value;
                var confirmUserPassword = document.getElementById('confirmUserPassword').value;
                
                if(!userName || !userEmail || !userRole || !userPassword || !confirmUserPassword) {
                    formValid = false;
                    alert('Por favor, preencha todos os campos obrigatórios.');
                }
                
                if(userPassword !== confirmUserPassword) {
                    formValid = false;
                    alert('As senhas não coincidem.');
                }
                
                if(formValid) {
                    // Here you would typically send the data to a server
                    alert('Usuário adicionado com sucesso!');
                    
                    // Close modal
                    var addUserModal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
                    addUserModal.hide();
                    
                    // Reset form
                    document.getElementById('addUserForm').reset();
                }
            });
            
            // Table sorting functionality
            document.querySelectorAll('#dataTable th').forEach(function(header, index) {
                header.addEventListener('click', function() {
                    sortTable(index);
                });
            });
        });
        
        function initCharts() {
            // Area Chart
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Faturamento",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        },
                        y: {
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                callback: function(value, index, values) {
                                    return 'R$' + value.toLocaleString();
                                }
                            },
                            grid: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        },
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyColor: "#858796",
                            titleMarginBottom: 10,
                            titleColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += 'R$' + context.parsed.y.toLocaleString();
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
            
            // Pie Chart
            var ctx2 = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: ["Direto", "Social", "Referência"],
                    datasets: [{
                        data: [55, 30, 15],
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false
                        },
                    },
                    cutout: '80%',
                },
            });
        }
        
        function sortTable(columnIndex) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("dataTable");
            switching = true;
            dir = "asc";
            
            while (switching) {
                switching = false;
                rows = table.rows;
                
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    
                    x = rows[i].getElementsByTagName("td")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("td")[columnIndex];
                    
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount ++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
</body>
</html>