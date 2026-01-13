<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Request;

class LogUserLogout
{
    public function handle(Logout $event): void
    {
        if (! $event->user) {
            return;
        }

        AuditLog::create([
            'user_id'    => $event->user->id,
            'action'     => 'logout',
            'table_name' => 'users',
            'record_id'  => $event->user->id,
            'old_values' => null,
            'new_values' => [
                'ip'         => Request::ip(),
                'user_agent' => Request::userAgent(),
            ],
            'created_at' => now(),
        ]);
    }
}
