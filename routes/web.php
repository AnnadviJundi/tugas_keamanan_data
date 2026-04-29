<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin')
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard'))->name('dashboard');

    Route::get('/admin/dashboard', DashboardController::class)
        ->middleware('permission:view-dashboard')
        ->name('admin.dashboard');

    Route::get('/user/dashboard', DashboardController::class)
        ->middleware('permission:view-dashboard')
        ->name('user.dashboard');

    Route::view('demo-guide', 'demo-guide')
        ->middleware('permission:view-dashboard')
        ->name('demo-guide');

    Route::get('information', [InformationController::class, 'index'])
        ->name('information.index');
    Route::get('information/{post:slug}', [InformationController::class, 'show'])
        ->name('information.show');

    Route::resource('users', UserController::class)
        ->except('show')
        ->middleware('permission:manage-users');

    Route::resource('roles', RoleController::class)
        ->except('show')
        ->middleware('permission:manage-roles');

    Route::resource('permissions', PermissionController::class)
        ->except('show')
        ->middleware('permission:manage-permissions');

    Route::get('posts', [PostController::class, 'index'])
        ->middleware('permission:create-post')
        ->name('posts.index');
    Route::get('posts/create', [PostController::class, 'create'])
        ->middleware('permission:create-post')
        ->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])
        ->middleware('permission:create-post')
        ->name('posts.store');
    Route::get('post-approvals', [PostController::class, 'approvals'])
        ->middleware('permission:publish-post')
        ->name('posts.approvals');
    Route::get('post-approvals/{post}/preview', [PostController::class, 'preview'])
        ->middleware('permission:publish-post')
        ->name('posts.preview');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])
        ->middleware('permission:edit-post')
        ->name('posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])
        ->middleware('permission:edit-post')
        ->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])
        ->middleware('permission:delete-post')
        ->name('posts.destroy');
    Route::patch('posts/{post}/publish', [PostController::class, 'publish'])
        ->middleware('permission:publish-post')
        ->name('posts.publish');

    Route::get('reports', ReportController::class)
        ->middleware('permission:view-reports')
        ->name('reports.index');

    Route::get('activity-logs', [ActivityLogController::class, 'index'])
        ->middleware('permission:view-activity-logs')
        ->name('activity-logs.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
