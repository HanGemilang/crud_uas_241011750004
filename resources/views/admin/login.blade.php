<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - StartingVano</title>
    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card-login {
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .card-header-login {
            background-color: #0f1d3a;
            color: white;
            text-align: center;
            padding: 30px 20px;
        }
        .text-blue {
            color: #d1b442 !important;
        }
        .btn-navy {
            background-color: #0f1d3a;
            border-color: #0f1d3a;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-navy:hover {
            background-color: #1c325c;
            border-color: #1c325c;
        }
        .form-control:focus {
            border-color: #d1b442;
            box-shadow: 0 0 0 0.25rem rgba(209, 180, 66, 0.25);
        }
    </style>
</head>
<body class="d-flex align-items-center min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                
                <!-- Back to Home -->
                <div class="text-center mb-4">
                    <a href="/" class="text-decoration-none text-muted small fw-semibold">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Utama
                    </a>
                </div>

                <div class="card card-login">
                    <div class="card-header-login">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="90" class="mb-3 bg-white p-1 rounded">
                        <h4 class="mb-1 fw-bold">STARTINGVANO</h4>
                        <p class="mb-0 text-blue small fw-bold text-uppercase tracking-wider" style="font-size: 0.75rem;">Admin Area Login</p>
                    </div>
                    
                    <div class="card-body p-4 p-md-5 bg-white">
                        
                        <!-- Flash Error Message -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                                    <div>{{ session('error') }}</div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Flash Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                                    <div>{{ session('success') }}</div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.login.submit') }}" method="POST">
                            @csrf
                            
                            <!-- Email Form Group -->
                            <div class="mb-4">
                                <label for="email" class="form-label text-secondary small fw-bold">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" id="email" 
                                           class="form-control border-start-0 bg-light @error('email') is-invalid @enderror" 
                                           placeholder="admin@company.com" 
                                           value="{{ old('email') }}" 
                                           required autocomplete="email" autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Password Form Group -->
                            <div class="mb-4">
                                <label for="password" class="form-label text-secondary small fw-bold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" id="password" 
                                           class="form-control border-start-0 bg-light @error('password') is-invalid @enderror" 
                                           placeholder="••••••••" 
                                           required autocomplete="current-password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-navy py-2 shadow-sm text-white">
                                    MASUK <i class="bi bi-box-arrow-in-right ms-1"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Footer info -->
                <div class="text-center mt-4">
                    <small class="text-muted">&copy; 2026 StartingVano. All rights reserved.</small>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
