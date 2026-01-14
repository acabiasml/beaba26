<?php

namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditObserver
{
    protected function audit(
        string $action,
        Model $model,
        ?array $oldValues = null,
        ?array $newValues = null
    ): void {
        if (! Auth::check()) {
            return;
        }

        AuditLog::create([
            'user_id'    => Auth::id(),
            'action'     => $action,
            'table_name' => $model->getTable(),
            'record_id'  => $model->getKey(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'created_at' => now(),
        ]);
    }

    public function created(Model $model): void
    {
        $this->audit(
            'create',
            $model,
            null,
            $model->getAttributes()
        );
    }

    public function updated(Model $model): void
    {
        $this->audit(
            'update',
            $model,
            $model->getOriginal(),
            $model->getChanges()
        );
    }

    public function deleted(Model $model): void
    {
        $this->audit(
            'delete',
            $model,
            $model->getOriginal(),
            null
        );
    }
}
