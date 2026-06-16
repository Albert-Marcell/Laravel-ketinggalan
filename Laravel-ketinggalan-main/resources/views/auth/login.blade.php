<!doctype html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — IF21</title>
    <meta name="description" content="Login ke sistem manajemen data Prodi dan Fakultas IF21">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
        }

        .brand-logo {
            font-size: 2.5rem;
            margin-bottom: 8px;
        }

        .brand-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
        }

        .brand-subtitle {
            color: rgba(255,255,255,0.5);
            font-size: 0.875rem;
            margin-bottom: 32px;
        }

        .form-label {
            color: rgba(255,255,255,0.8);
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .form-control {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: #fff;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.12);
            border-color: #3b82f6;
            color: #fff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        .form-control::placeholder { color: rgba(255,255,255,0.3); }

        .btn-login {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            color: #fff;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(59,130,246,0.4);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(59,130,246,0.5);
            color: #fff;
        }

        .btn-login:active { transform: translateY(0); }

        .divider {
            border-color: rgba(255,255,255,0.1);
            margin: 20px 0;
        }

        .register-link {
            color: rgba(255,255,255,0.6);
            font-size: 0.875rem;
        }

        .register-link a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover { color: #93c5fd; text-decoration: underline; }

        .alert-danger {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            color: #fca5a5;
            border-radius: 10px;
            font-size: 0.875rem;
        }

        .floating-shapes {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(59,130,246,0.08);
            animation: float 8s ease-in-out infinite;
        }

        .shape:nth-child(1) { width: 300px; height: 300px; top: -100px; right: -100px; animation-delay: 0s; }
        .shape:nth-child(2) { width: 200px; height: 200px; bottom: -50px; left: -50px; animation-delay: 3s; }
        .shape:nth-child(3) { width: 150px; height: 150px; bottom: 100px; right: 100px; animation-delay: 6s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.05); }
        }

        .login-wrapper { position: relative; z-index: 1; width: 100%; display: flex; justify-content: center; }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="text-center">
                <div class="brand-logo">💻</div>
                <div class="brand-title">IF21</div>
                <div class="brand-subtitle">Sistem Manajemen Prodi & Fakultas</div>
            </div>

            {{-- Flash Error --}}
            @if (session('error'))
                <div class="alert alert-danger mb-3">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="/login" id="loginForm">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@example.com"
                        autocomplete="email"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-login" id="btnLogin">
                    Masuk
                </button>
            </form>

            <hr class="divider">

            <div class="text-center register-link">
                Belum punya akun? <a href="/register">Daftar sekarang</a>
            </div>

            <div class="text-center mt-3">
                <small style="color: rgba(255,255,255,0.3);">
                    Demo: admin@example.com / password
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
