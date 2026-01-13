<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Request;

class LogUserLogin
{
    public function handle(Login $event): void
    {
        AuditLog::create([
            'user_id'    => $event->user->id,
            'action'     => 'login',
            'table_name' => 'users',
            'record_id'  => $event->user->id,
            'old_values' => null,
            'new_values' => [
                'auth_provider' => $event->user->auth_provider,
                'ip'            => Request::ip(),
                'user_agent'    => Request::userAgent(),
            ],
            'created_at' => now(),
        ]);
    }
}
