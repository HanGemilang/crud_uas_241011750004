<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - StartingVano</title>
    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --sidebar-width: 260px;
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        .bg-navy {
            background-color: #0f1d3a !important;
        }
        .text-navy {
            color: #0f1d3a !important;
        }
        .bg-blue {
            background-color: #d1b442 !important; /* StartingVano Gold */
        }
        .text-blue {
            color: #d1b442 !important;
        }
        
        /* Sidebar styling */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            background-color: #0f1d3a;
            color: white;
            transition: all 0.3s;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 12px 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            border-left: 4px solid transparent;
            transition: 0.2s;
        }
        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.05);
        }
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: #d1b442;
        }
        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Topbar and Main content */
        .topbar {
            height: 70px;
            background-color: white;
            border-bottom: 1px solid #e9ecef;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding: 30px;
            background-color: #f8f9fa;
            transition: all 0.3s;
        }
        
        /* Custom UI Card */
        .card-custom {
            border-radius: 12px;
            overflow: hidden;
        }
        .bg-navy-gradient {
            background: linear-gradient(135deg, #0f1d3a 0%, #1c325c 100%);
        }
        
        /* Responsive styles */
        @media (max-width: 991.98px) {
            .sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }
            .sidebar.active {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand d-flex align-items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="55" class="bg-white p-1 rounded me-2">
            <div>
                <h6 class="mb-0 fw-bold" style="font-size: 0.95rem;">STARTINGVANO</h6>
                <small class="text-blue fw-bold" style="font-size: 0.6rem; letter-spacing: 0.5px;">ADMIN PANEL</small>
            </div>
        </div>
        <div class="py-4">
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link @if(Route::is('admin.dashboard')) active @endif">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.players.index') }}" class="nav-link @if(Route::is('admin.players.*') && !Route::is('admin.players.pdf')) active @endif">
                        <i class="bi bi-people-fill me-2"></i> Kelola Atlet
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.players.pdf') }}" class="nav-link @if(Route::is('admin.players.pdf')) active @endif">
                        <i class="bi bi-file-pdf-fill me-2"></i> Export PDF
                    </a>
                </li>

                <li class="nav-item mt-4 px-3">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 1px;">Sistem</small>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2 text-danger"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        
        <!-- TOPBAR -->
        <header class="topbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn btn-light d-lg-none me-3" id="sidebarCollapse">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h5 class="mb-0 fw-bold text-navy">@yield('page_title', 'Overview')</h5>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar bg-navy text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 38px; height: 38px; font-weight: 600;">
                            {{ strtoupper(substr(session('user_name', 'User'), 0, 2)) }}
                        </div>
                        <div class="d-none d-md-block text-start">
                            <div class="fw-bold small">{{ session('user_name') }}</div>
                            <div class="text-muted small" style="font-size: 0.65rem;">Administrator</div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right text-danger me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Hidden Logout Form -->
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </header>

        <!-- Flash messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-toggle="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                    <div>{{ session('error') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-toggle="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')

    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
    @yield('scripts')
</body>
</html>
