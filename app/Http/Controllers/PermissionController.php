<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionStoreRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
    public function index(Request $request): View
    {
        $permissions = Permission::withCount('roles')
            ->when($request->search, fn ($query, $search) => $query
                ->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        return view('permissions.create');
    }

    public function store(PermissionStoreRequest $request): RedirectResponse
    {
        $permission = Permission::create($request->validated());

        log_activity('create-permission', "Created permission {$permission->slug}");

        return redirect()->route('permissions.index')->with('success', 'Permission berhasil dibuat.');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(Permission $permission): View
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(PermissionUpdateRequest $request, Permission $permission): RedirectResponse
    {
        $permission->update($request->validated());

        log_activity('update-permission', "Updated permission {$permission->slug}");

        return redirect()->route('permissions.index')->with('success', 'Permission berhasil diperbarui.');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $slug = $permission->slug;
        $permission->delete();

        log_activity('delete-permission', "Deleted permission {$slug}");

        return redirect()->route('permissions.index')->with('success', 'Permission berhasil dihapus.');
    }
}
