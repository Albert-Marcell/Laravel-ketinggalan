<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * Daftarkan binding contract Fortify ke implementasi konkretnya.
     */
    public function register(): void
    {
        // Bind CreateNewUser agar Fortify tahu class mana yang menangani registrasi
        $this->app->bind(CreatesNewUsers::class, CreateNewUser::class);
    }

    /**
     * Bootstrap any application services.
     * Konfigurasi Fortify untuk autentikasi: login, register, logout.
     */
    public function boot(): void
    {
        // Definisikan Rate Limiter 'login' yang dibutuhkan Fortify
        // Membatasi percobaan login: maks 5 kali per menit per email + IP
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = strtolower($request->input(Fortify::username())) . '|' . $request->ip();

            return Limit::perMinute(5)->by($throttleKey);
        });

        // Tampilkan view login custom
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // Tampilkan view register custom
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // Konfigurasi otentikasi menggunakan email + password
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });
    }
}
