<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Roles</p>
            <h1 class="text-2xl font-bold text-slate-950">Edit Role</h1>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('roles.update', $role) }}" class="max-w-3xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @method('PUT')
        @include('roles.partials.form', ['role' => $role, 'permissions' => $permissions])
    </form>
</x-app-layout>
