<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use App\Listeners\LogUserLogin;
use App\Listeners\LogUserLogout;
use Illuminate\Support\Facades\Gate;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            Login::class,
            LogUserLogin::class
        );

        Event::listen(
            Logout::class,
            LogUserLogout::class
        );

        Gate::define('administrador', fn ($user) => $user->role === 'administrador');
        Gate::define('gestor', fn ($user) => $user->role === 'gestor');
        Gate::define('professor', fn ($user) => $user->role === 'professor');
        Gate::define('aluno', fn ($user) => $user->role === 'aluno');
        Gate::define('apoio', fn ($user) => $user->role === 'apoio');

        // Auditoria
        Grade::observe(AuditObserver::class);
        Attendance::observe(AuditObserver::class);
        Diary::observe(AuditObserver::class);
        SchoolYear::observe(AuditObserver::class);
        User::observe(AuditObserver::class);
    }
}
