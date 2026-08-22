<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Panel') - Oficina de Agua</title>
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin@7.0.7/dist/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ url('/') }}">
            <i class="fas fa-tint me-2"></i>Oficina de Agua
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Gestión</div>
                        <a class="nav-link {{ request()->routeIs('productos.*') ? '' : 'collapsed' }}"
                            href="{{ Route::has('productos.index') ? route('productos.index') : '#' }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                            Productos
                        </a>
                        <a class="nav-link {{ request()->routeIs('contadores.*') ? '' : 'collapsed' }}"
                            href="{{ Route::has('contadores.index') ? route('contadores.index') : '#' }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Contadores
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Proyecto:</div>
                    Oficina del Agua
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @if (session('mensaje'))
                    <div class="alert alert-success mt-4" role="alert">
                        {{ session('mensaje') }}
                    </div>
                    @endif

                    @yield('contenido')
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Oficina del Agua &copy; {{ date('Y') }}</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin@7.0.7/dist/js/scripts.js"></script>
</body>

</html>