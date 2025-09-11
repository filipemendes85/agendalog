<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgendaLog - Ecollogistics</title>
    <link rel="shortcut icon" type="image/png" href={{ asset('assets/images/logos/favicon.png') }} />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset( 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css ') }}">
    
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <script src="{{ asset('assets/js/masks.js') }}" defer></script>
</head>

<body>
  
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src={{ asset('assets/images/logos/logo.png') }} alt="" class="container-fluid" />
        </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-6"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Menu</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./index" aria-expanded="false">
                <i class="ti ti-atom"></i>
                <span class="hide-menu">Painel</span>
              </a>
            </li>
            <!-- ---------------------------------- -->
            <!-- Dashboard -->
            <!-- ---------------------------------- -->
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between"  
                href="#" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex">
                    <i class="ti ti-layout-grid"></i>
                  </span>
                  <span class="hide-menu">Grande</span>
                </div>
                
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between"  
                href="#" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex">
                    <i class="ti ti-calendar"></i>
                  </span>
                  <span class="hide-menu">Agendamento</span>
                </div>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between"  
                href="/clients" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex">
                    <i class="ti ti-address-book"></i>
                  </span>
                  <span class="hide-menu">Cliente</span>
                </div>
                
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between"  
                href="#" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex">
                    <i class="ti ti-truck"></i>
                  </span>
                  <span class="hide-menu">Transportadora</span>
                </div>
              </a>
            </li>
            {{-- <li class="sidebar-item">
              <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex">
                    <i class="ti ti-truck"></i>
                  </span>
                  <span class="hide-menu">Transportadora</span>
                </div>
                
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between"  
                    href="#">
                    <div class="d-flex align-items-center gap-3">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Homepage</span>
                    </div>
                    
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between"  
                    href="#">
                    <div class="d-flex align-items-center gap-3">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">About Us</span>
                    </div>
                    
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between"  
                    href="#">
                    <div class="d-flex align-items-center gap-3">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Blog</span>
                    </div>
                    
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between"  
                    href="#">
                    <div class="d-flex align-items-center gap-3">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Blog Details</span>
                    </div>
                    
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between"  
                    href="#">
                    <div class="d-flex align-items-center gap-3">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Contact Us</span>
                    </div>
                    
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between"  
                    href="#">
                    <div class="d-flex align-items-center gap-3">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Portfolio</span>
                    </div>
                    
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between"  
                    href="#">
                    <div class="d-flex align-items-center gap-3">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Pricing</span>
                    </div>
                    
                  </a>
                </li>
              </ul>
            </li> --}}

            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Configurações</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between"  
                href="/users" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex">
                    <i class="ti ti-users"></i>
                  </span>
                  <span class="hide-menu">Usuários</span>
                </div>
              </a>
            </li>
            {{-- <li class="sidebar-item">
              <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex">
                    <i class="ti ti-basket"></i>
                  </span>
                  <span class="hide-menu">Usuários</span>
                </div>
                
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between"  
                    href="#">
                    <div class="d-flex align-items-center gap-3">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Outros</span>
                    </div>
                    
                  </a>
                </li>
              </ul>
            </li> --}}
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link " href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                <iconify-icon icon="solar:bell-linear" class="fs-6"></iconify-icon>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-animate-up" aria-labelledby="drop1">
                <div class="message-body">
                  <a href="javascript:void(0)" class="dropdown-item">
                    Bem vindo!
                  </a>
                  <a href="javascript:void(0)" class="dropdown-item">
                    Item 2
                  </a>
                </div>
              </div>
            </li>
          </ul>

          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
               
              <li class="nav-item dropdown">
                {{-- <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="./assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a> --}}

                <a href="javascript:void(0)" class="nav-link" id="drop2" data-bs-toggle="dropdown">
                  <i class="ti ti-user fs-5"></i>
                  @auth
                      <p class="ms-2 mb-0 fs-3">Olá {{ Auth::user()->name }}</p>
                  @else
                      <p class="ms-2 mb-0 fs-3">Sem usuário</p>
                  @endauth
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    {{-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a> --}}
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">Minha conta</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">Configurações</p>
                    </a>
                    {{-- In your Blade view --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf {{-- Include CSRF token --}}
                        <button type="submit" class="btn btn-outline-primary mx-3 mt-2 d-block">Sair</button>
                    </form>
                    {{-- <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                      class="btn btn-outline-primary mx-3 mt-2 d-block">Sair</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form> --}}
                  </div>
                </div>

              </li>
            </ul>
          </div>

        </nav>
      </header>
      <!--  Header End -->

      <!--  Conteudo da tela -->
      @yield('conteudo')

      

    </div>
  </div>

  <script src="{{ asset('assets/js/alerts.js') }}" defer></script>
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js') }}"></script>
  <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>

  <script>
      // Alertas de sucesso
      @if (session('success'))
          Swal.fire({
              icon: 'success',
              title: 'Sucesso!',
              width: 400,
              text: '{{ session('success') }}',
              toast: true,
              position: 'bottom-end',
              showConfirmButton: false,
              timer: 4000,
              timerProgressBar: true,
              background: '#28a745',
              iconColor: '#285c34',
              color: '#f0f9f0'
          });
      @endif

      // Alertas de erro
      @if (session('error'))
          Swal.fire({
              icon: 'error',
              title: 'Erro!',
              width: 400,
              text: '{{ session('error') }}',
              toast: true,
              position: 'bottom-end',
              showConfirmButton: false,
              timer: 4000,
              timerProgressBar: true,
              background: '#dc3545',
              iconColor: '#7f3037',
              color: '#fdf2f2'
          });
      @endif

      // Alertas de aviso
      @if (session('warning'))
          Swal.fire({
              icon: 'warning',
              title: 'Atenção!',
              width: 400,
              text: '{{ session('warning') }}',
              toast: true,
              position: 'bottom-end',
              showConfirmButton: false,
              timer: 3500,
              timerProgressBar: true,
              background: '#ffc107',
              iconColor: '#8a6f1e',
              color: '#fff9eb'
          });
      @endif

      // Alertas de informação
      @if (session('info'))
          Swal.fire({
              icon: 'info',
              title: 'Informação',
              text: '{{ session('info') }}',
              toast: true,
              position: 'bottom-end',
              showConfirmButton: false,
              timer: 4000,
              timerProgressBar: true,
              background: '#17a2b8',
              iconColor: '#e8f4fd',
              color: '#e8f4fd'
          });
      @endif

      // Função global para confirmar exclusões (pode ser reutilizada em todo o sistema)
      function confirmDelete(formId, message = 'Tem certeza que deseja excluir este registro?') {
          Swal.fire({
              title: 'Confirmação',
              text: message,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Sim, excluir!',
              cancelButtonText: 'Cancelar'
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById(formId).submit();
              }
          });
      }

      // Inicialização quando o documento estiver pronto
      document.addEventListener('DOMContentLoaded', function() {
          // Para formulários com a classe 'delete-form' (método alternativo)
          document.querySelectorAll('form.delete-form').forEach(form => {
              form.addEventListener('submit', function(e) {
                  e.preventDefault();
                  const message = this.getAttribute('data-confirm-message') || 'Tem certeza que deseja excluir este registro?';
                  
                  Swal.fire({
                      title: 'Confirmação',
                      text: message,
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#d33',
                      cancelButtonColor: '#3085d6',
                      confirmButtonText: 'Sim, excluir!',
                      cancelButtonText: 'Cancelar'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          this.submit();
                      }
                  });
              });
          });
      });
  </script>
  @stack('pagescript')
</body>

</html>