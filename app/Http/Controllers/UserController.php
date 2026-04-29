<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::with('roles.permissions')
            ->when($request->search, fn ($query, $search) => $query
                ->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create', [
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $user = User::create($request->safe()->only(['name', 'email', 'password']));
        $user->roles()->sync($request->validated('roles', []));

        log_activity('create-user', "Created user {$user->email}");

        if ($request->filled('roles')) {
            log_activity('assign-role', "Assigned roles to {$user->email}");
        }

        return redirect()->route('users.index')->with('success', 'User berhasil dibuat.');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(User $user): View
    {
        $user->load('roles');

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $data = $request->safe()->only(['name', 'email']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        $user->roles()->sync($request->validated('roles', []));

        log_activity('update-user', "Updated user {$user->email}");
        log_activity('assign-role', "Synced roles for {$user->email}");

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->is(auth()->user())) {
            return back()->with('error', 'Anda tidak bisa menghapus akun yang sedang digunakan.');
        }

        $email = $user->email;
        $user->delete();

        log_activity('delete-user', "Deleted user {$email}");

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
