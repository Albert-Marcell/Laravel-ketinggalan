{{--
    Komponen: x-alert
    Menampilkan flash message dari session.
    
    Penggunaan: <x-alert />
    Mendukung: session('success'), session('error'), session('warning'), session('info')
--}}

@if (session('success'))
    <div class="alert-flash alert-flash--success" role="alert" id="flashAlert">
        <span class="alert-flash__icon">✅</span>
        <span class="alert-flash__message">{{ session('success') }}</span>
        <button class="alert-flash__close" onclick="this.parentElement.style.display='none'" aria-label="Tutup">&times;</button>
    </div>
@endif

@if (session('error'))
    <div class="alert-flash alert-flash--error" role="alert" id="flashAlert">
        <span class="alert-flash__icon">❌</span>
        <span class="alert-flash__message">{{ session('error') }}</span>
        <button class="alert-flash__close" onclick="this.parentElement.style.display='none'" aria-label="Tutup">&times;</button>
    </div>
@endif

@if (session('warning'))
    <div class="alert-flash alert-flash--warning" role="alert" id="flashAlert">
        <span class="alert-flash__icon">⚠️</span>
        <span class="alert-flash__message">{{ session('warning') }}</span>
        <button class="alert-flash__close" onclick="this.parentElement.style.display='none'" aria-label="Tutup">&times;</button>
    </div>
@endif

@if (session('info'))
    <div class="alert-flash alert-flash--info" role="alert">
        <span class="alert-flash__icon">ℹ️</span>
        <span class="alert-flash__message">{{ session('info') }}</span>
        <button class="alert-flash__close" onclick="this.parentElement.style.display='none'" aria-label="Tutup">&times;</button>
    </div>
@endif

<style>
.alert-flash {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 16px;
    font-size: 0.9rem;
    font-weight: 500;
    animation: slideIn 0.3s ease;
    border: 1px solid transparent;
}

.alert-flash--success {
    background: #f0fdf4;
    border-color: #86efac;
    color: #166534;
}

.alert-flash--error {
    background: #fef2f2;
    border-color: #fca5a5;
    color: #991b1b;
}

.alert-flash--warning {
    background: #fffbeb;
    border-color: #fcd34d;
    color: #92400e;
}

.alert-flash--info {
    background: #eff6ff;
    border-color: #93c5fd;
    color: #1e40af;
}

[data-theme="dark"] .alert-flash--success {
    background: rgba(22, 101, 52, 0.2);
    border-color: rgba(134, 239, 172, 0.3);
    color: #86efac;
}

[data-theme="dark"] .alert-flash--error {
    background: rgba(153, 27, 27, 0.2);
    border-color: rgba(252, 165, 165, 0.3);
    color: #fca5a5;
}

[data-theme="dark"] .alert-flash--warning {
    background: rgba(146, 64, 14, 0.2);
    border-color: rgba(252, 211, 77, 0.3);
    color: #fcd34d;
}

[data-theme="dark"] .alert-flash--info {
    background: rgba(30, 64, 175, 0.2);
    border-color: rgba(147, 197, 253, 0.3);
    color: #93c5fd;
}

.alert-flash__icon { font-size: 1rem; flex-shrink: 0; }
.alert-flash__message { flex: 1; }
.alert-flash__close {
    background: none;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    padding: 0 4px;
    line-height: 1;
    opacity: 0.6;
    color: inherit;
    flex-shrink: 0;
}
.alert-flash__close:hover { opacity: 1; }

@keyframes slideIn {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}
</style>

<script>
// Auto-dismiss flash message setelah 5 detik
document.addEventListener('DOMContentLoaded', function () {
    const flash = document.getElementById('flashAlert');
    if (flash) {
        setTimeout(() => {
            flash.style.transition = 'opacity 0.4s';
            flash.style.opacity = '0';
            setTimeout(() => flash.style.display = 'none', 400);
        }, 5000);
    }
});
</script>
