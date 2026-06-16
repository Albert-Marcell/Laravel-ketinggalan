<!doctype html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'IF21 — Sistem Manajemen Prodi & Fakultas' }}</title>
    <meta name="description" content="Sistem manajemen data Program Studi dan Fakultas — IF21 Informatika 2021">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite([])

    <style>
        /* ─── Font & Base ──────────────────────────────────────── */
        * { font-family: 'Inter', sans-serif; }

        body {
            transition: background-color 0.3s, color 0.3s;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main { flex: 1; }

        /* ─── Navbar ──────────────────────────────────────────── */
        .navbar {
            border-bottom: 1px solid rgba(0,0,0,0.08);
            padding: 0.6rem 1rem;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: -0.3px;
        }

        .nav-link {
            font-size: 0.9rem;
            font-weight: 500;
            padding: 6px 12px !important;
            border-radius: 8px !important;
            transition: all 0.2s;
        }

        .nav-link:hover { background: rgba(59,130,246,0.08); }

        .nav-link.active {
            background: #3b82f6 !important;
            color: #fff !important;
        }

        /* ─── Theme Toggle ───────────────────────────────────── */
        #themeToggle {
            border: none;
            background: transparent;
            font-size: 1.15rem;
            cursor: pointer;
            padding: 6px 8px;
            border-radius: 8px;
            transition: background 0.2s;
        }

        #themeToggle:hover { background: rgba(0,0,0,0.06); }

        /* ─── User Badge ─────────────────────────────────────── */
        .user-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #374151;
            padding: 6px 10px;
            border-radius: 8px;
            background: rgba(0,0,0,0.04);
        }

        .user-badge .avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
        }

        /* ─── Dark Mode ───────────────────────────────────────── */
        [data-theme="dark"] {
            --bs-body-bg: #0f172a;
            --bs-body-color: #e2e8f0;
        }

        [data-theme="dark"] body { background: #0f172a; color: #e2e8f0; }

        [data-theme="dark"] .navbar {
            background: #1e293b !important;
            border-bottom: 1px solid #334155;
        }

        [data-theme="dark"] .navbar-brand,
        [data-theme="dark"] .nav-link { color: #e2e8f0 !important; }

        [data-theme="dark"] .nav-link:hover { background: rgba(255,255,255,0.06); }

        [data-theme="dark"] main { background: #0f172a; color: #e2e8f0; }

        [data-theme="dark"] h1,
        [data-theme="dark"] h2,
        [data-theme="dark"] h3,
        [data-theme="dark"] h4,
        [data-theme="dark"] h5,
        [data-theme="dark"] h6 { color: #f1f5f9 !important; }

        [data-theme="dark"] .card {
            background: #1e293b !important;
            border-color: #334155 !important;
            color: #e2e8f0 !important;
        }

        [data-theme="dark"] .table {
            --bs-table-color: #e2e8f0;
            --bs-table-bg: transparent;
            --bs-table-border-color: #334155;
            --bs-table-hover-bg: rgba(255,255,255,0.04);
            color: #e2e8f0 !important;
        }

        [data-theme="dark"] .table th,
        [data-theme="dark"] .table td { color: #e2e8f0 !important; border-color: #334155; }

        [data-theme="dark"] thead { background: #0f172a; }

        [data-theme="dark"] .form-label,
        [data-theme="dark"] label { color: #cbd5e1 !important; }

        [data-theme="dark"] .form-control,
        [data-theme="dark"] .form-select {
            background: #0f172a !important;
            border-color: #334155 !important;
            color: #e2e8f0 !important;
        }

        [data-theme="dark"] .form-control::placeholder { color: #64748b !important; }

        [data-theme="dark"] .form-control:focus,
        [data-theme="dark"] .form-select:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2) !important;
        }

        [data-theme="dark"] footer {
            background: #1e293b !important;
            border-top: 1px solid #334155;
            color: #64748b;
        }

        [data-theme="dark"] .user-badge {
            background: rgba(255,255,255,0.06);
            color: #cbd5e1;
        }

        [data-theme="dark"] #themeToggle:hover { background: rgba(255,255,255,0.08); }

        [data-theme="dark"] .btn-outline-secondary {
            color: #cbd5e1;
            border-color: #475569;
        }

        [data-theme="dark"] .btn-outline-secondary:hover {
            background: #334155;
            color: #f1f5f9;
        }

        [data-theme="dark"] .text-muted { color: #64748b !important; }
        [data-theme="dark"] .border { border-color: #334155 !important; }

        /* ─── Footer ─────────────────────────────────────────── */
        footer {
            border-top: 1px solid rgba(0,0,0,0.06);
        }

        /* ─── Responsive ─────────────────────────────────────── */
        @media (max-width: 768px) {
            .navbar-nav { padding: 8px 0; gap: 2px; }
        }
    </style>
</head>
<body>

    {{-- ─── Navbar ──────────────────────────────────────────────────── --}}
    <nav class="navbar navbar-expand-lg bg-body-tertiary px-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('prodi.index') }}">
                💻 IF21
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-label="Toggle navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('fakultas.*') ? 'active' : '' }}"
                           href="{{ route('fakultas.index') }}">
                            🏛️ Fakultas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('prodi.index') || request()->routeIs('prodi.show') ? 'active' : '' }}"
                           href="{{ route('prodi.index') }}">
                            📚 Prodi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('prodi.create') ? 'active' : '' }}"
                           href="{{ route('prodi.create') }}">
                            ➕ Tambah Prodi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('prodi.trashed') ? 'active' : '' }}"
                           href="{{ route('prodi.trashed') }}">
                            🗑️ Arsip
                        </a>
                    </li>
                </ul>

                {{-- User info & logout --}}
                @auth
                    <div class="d-flex align-items-center gap-2">
                        <div class="user-badge d-none d-lg-flex">
                            <div class="avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                            {{ auth()->user()->name }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary" id="btnLogout">
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth
            </div>

            {{-- Dark/Light Mode Toggle --}}
            <button id="themeToggle" title="Toggle tema" aria-label="Toggle tema" class="ms-2">🌙</button>
        </div>
    </nav>

    {{-- ─── Main Content ─────────────────────────────────────────────── --}}
    <main class="container py-4">
        {{-- Flash Messages via Component --}}
        <x-alert />

        {{ $slot }}
    </main>

    {{-- ─── Footer ──────────────────────────────────────────────────── --}}
    <footer class="bg-body-tertiary text-center py-3 mt-auto">
        <small class="text-muted">
            © {{ date('Y') }} IF21 — Informatika 2021 &nbsp;·&nbsp;
            Sistem Manajemen Prodi & Fakultas
        </small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
        // ─── Dark/Light Mode ─────────────────────────────────────────
        const toggle = document.getElementById('themeToggle');
        const html   = document.documentElement;

        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        toggle.textContent = savedTheme === 'dark' ? '☀️' : '🌙';

        toggle.addEventListener('click', () => {
            const current = html.getAttribute('data-theme');
            const next    = current === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            toggle.textContent = next === 'dark' ? '☀️' : '🌙';
        });
    </script>

</body>
</html>
