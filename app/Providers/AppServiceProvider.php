<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use App\Listeners\LogUserLogin;
use App\Listeners\LogUserLogout;
use Illuminate\Support\Facades\Gate;
use App\Support\SystemState;
use Illuminate\Support\Facades\View;
use App\Observers\AuditObserver;
use Illuminate\Support\Facades\Schema;



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
        if (class_exists(\App\Models\Grade::class)) {
            \App\Models\Grade::observe(AuditObserver::class);
        }

        if (class_exists(\App\Models\Attendance::class)) {
            \App\Models\Attendance::observe(AuditObserver::class);
        }

        if (class_exists(\App\Models\Diary::class)) {
            \App\Models\Diary::observe(AuditObserver::class);
        }

        if (class_exists(\App\Models\SchoolYear::class)) {
            \App\Models\SchoolYear::observe(AuditObserver::class);
        }

        if (class_exists(\App\Models\User::class)) {
            \App\Models\User::observe(AuditObserver::class);
        }


        View::share('isFirstAccess', SystemState::isFirstAccess());
    }
}
