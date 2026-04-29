<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(Request $request): View
    {
        $logs = ActivityLog::with('user')
            ->when($request->user_id, fn ($query, $userId) => $query->where('user_id', $userId))
            ->when($request->date, fn ($query, $date) => $query->whereDate('created_at', $date))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('activity-logs.index', [
            'logs' => $logs,
            'users' => User::withTrashed()->orderBy('name')->get(),
        ]);
    }
}
