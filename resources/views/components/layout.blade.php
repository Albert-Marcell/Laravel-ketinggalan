<!doctype html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'IF21' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    @vite([])

    <style>
        [data-theme="dark"] {
            --bs-body-bg: #121212;
            --bs-body-color: #e0e0e0;
            --bs-body-color-rgb: 224, 224, 224;
        }
        [data-theme="dark"] .navbar {
            background-color: #1e1e1e !important;
            border-bottom: 1px solid #2e2e2e;
        }
        [data-theme="dark"] .navbar-text,
        [data-theme="dark"] .nav-link {
            color: #e0e0e0 !important;
        }
        [data-theme="dark"] main {
            background-color: #121212;
            color: #e0e0e0;
        }
        [data-theme="dark"] footer {
            background-color: #1e1e1e !important;
            border-top: 1px solid #2e2e2e;
            color: #888;
        }
        body { transition: background-color 0.3s, color 0.3s; }
        .navbar { border-bottom: 1px solid rgba(0,0,0,0.08); }
        #themeToggle { border: none; background: transparent; font-size: 1.2rem; cursor: pointer; }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-body-tertiary px-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-semibold" href="#">
                💻 IF21
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active bg-primary text-white' : '' }}" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeis('fakultas.index') ? 'active bg-primary text-white' : '' }}" href="#">Fakultas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang</a>
                    </li>
                </ul>
            </div>

            {{-- Tombol Dark/Light Mode --}}
            <button id="themeToggle" title="Toggle tema" aria-label="Toggle tema">🌙</button>
        </div>
    </nav>

    {{-- Konten Utama --}}
    <main class="container py-4">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-body-tertiary text-center py-3 mt-auto">
        <small class="text-muted">© {{ date('Y') }} IF21 — Informatika 2021</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
        const toggle = document.getElementById('themeToggle');
        const html = document.documentElement;

        // Simpan preferensi ke localStorage
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        toggle.textContent = savedTheme === 'dark' ? '☀️' : '🌙';

        toggle.addEventListener('click', () => {
            const current = html.getAttribute('data-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            toggle.textContent = next === 'dark' ? '☀️' : '🌙';
        });
    </script>

</body>
</html>
