<?php

use App\Models\ActivityLog;
use App\Models\User;

if (! function_exists('user_has_permission')) {
    function user_has_permission(?User $user, string $permission): bool
    {
        return $user?->hasPermission($permission) ?? false;
    }
}

if (! function_exists('log_activity')) {
    function log_activity(string $action, ?string $description = null, ?User $user = null): void
    {
        ActivityLog::create([
            'user_id' => ($user ?? auth()->user())?->id,
            'action' => $action,
            'description' => $description,
            'ip_address' => request()?->ip(),
        ]);
    }
}
