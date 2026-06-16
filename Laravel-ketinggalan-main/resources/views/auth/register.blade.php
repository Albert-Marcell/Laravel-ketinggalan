<!doctype html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar — IF21</title>
    <meta name="description" content="Daftar akun baru untuk sistem manajemen data Prodi dan Fakultas IF21">
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

        .register-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
        }

        .brand-logo { font-size: 2.5rem; margin-bottom: 8px; }
        .brand-title { font-size: 1.5rem; font-weight: 700; color: #fff; margin-bottom: 4px; }
        .brand-subtitle { color: rgba(255,255,255,0.5); font-size: 0.875rem; margin-bottom: 32px; }

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
            border-color: #10b981;
            color: #fff;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.25);
        }

        .form-control::placeholder { color: rgba(255,255,255,0.3); }

        .form-control.is-invalid {
            border-color: rgba(239,68,68,0.6);
        }

        .invalid-feedback { color: #fca5a5; font-size: 0.8rem; }

        .btn-register {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            color: #fff;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(16,185,129,0.4);
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(16,185,129,0.5);
            color: #fff;
        }

        .divider { border-color: rgba(255,255,255,0.1); margin: 20px 0; }

        .login-link { color: rgba(255,255,255,0.6); font-size: 0.875rem; }
        .login-link a { color: #34d399; text-decoration: none; font-weight: 500; }
        .login-link a:hover { color: #6ee7b7; text-decoration: underline; }

        .alert-danger {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            color: #fca5a5;
            border-radius: 10px;
            font-size: 0.875rem;
        }

        .floating-shapes { position: fixed; inset: 0; overflow: hidden; pointer-events: none; z-index: 0; }
        .shape { position: absolute; border-radius: 50%; background: rgba(16,185,129,0.08); animation: float 8s ease-in-out infinite; }
        .shape:nth-child(1) { width: 300px; height: 300px; top: -100px; left: -100px; animation-delay: 0s; }
        .shape:nth-child(2) { width: 200px; height: 200px; bottom: -50px; right: -50px; animation-delay: 3s; }
        .shape:nth-child(3) { width: 150px; height: 150px; top: 100px; right: 50px; animation-delay: 6s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.05); }
        }

        .register-wrapper { position: relative; z-index: 1; width: 100%; display: flex; justify-content: center; }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="register-wrapper">
        <div class="register-card">
            <div class="text-center">
                <div class="brand-logo">💻</div>
                <div class="brand-title">Daftar Akun</div>
                <div class="brand-subtitle">Buat akun baru untuk mengakses sistem</div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="/register" id="registerForm">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Nama Anda"
                        autocomplete="name"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="reg-email" class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="reg-email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="email@example.com"
                        autocomplete="email"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="reg-password" class="form-label">Password</label>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="reg-password"
                        name="password"
                        placeholder="Min. 8 karakter"
                        autocomplete="new-password"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        autocomplete="new-password"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-register" id="btnRegister">
                    Daftar Sekarang
                </button>
            </form>

            <hr class="divider">

            <div class="text-center login-link">
                Sudah punya akun? <a href="/login">Masuk di sini</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
