<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Users</p>
            <h1 class="text-2xl font-bold text-slate-950">Edit User</h1>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('users.update', $user) }}" class="max-w-3xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @method('PUT')
        @include('users.partials.form', ['user' => $user, 'roles' => $roles])
    </form>
</x-app-layout>
