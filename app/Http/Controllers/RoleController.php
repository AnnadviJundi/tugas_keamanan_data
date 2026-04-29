<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        $roles = Role::withCount(['users', 'permissions'])
            ->when($request->search, fn ($query, $search) => $query
                ->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('roles.index', compact('roles'));
    }

    public function create(): View
    {
        return view('roles.create', [
            'permissions' => Permission::orderBy('name')->get(),
        ]);
    }

    public function store(RoleStoreRequest $request): RedirectResponse
    {
        $role = Role::create($request->safe()->only(['name', 'slug']));
        $role->permissions()->sync($request->validated('permissions', []));

        log_activity('create-role', "Created role {$role->slug}");

        if ($request->filled('permissions')) {
            log_activity('assign-permission', "Assigned permissions to role {$role->slug}");
        }

        return redirect()->route('roles.index')->with('success', 'Role berhasil dibuat.');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(Role $role): View
    {
        $role->load('permissions');

        return view('roles.edit', [
            'role' => $role,
            'permissions' => Permission::orderBy('name')->get(),
        ]);
    }

    public function update(RoleUpdateRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->safe()->only(['name', 'slug']));
        $role->permissions()->sync($request->validated('permissions', []));

        log_activity('update-role', "Updated role {$role->slug}");
        log_activity('assign-permission', "Synced permissions for role {$role->slug}");

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($role->slug === 'admin') {
            return back()->with('error', 'Role admin tidak boleh dihapus.');
        }

        $slug = $role->slug;
        $role->delete();

        log_activity('delete-role', "Deleted role {$slug}");

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
    }
}
