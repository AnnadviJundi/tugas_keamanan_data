<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Users</p>
            <h1 class="text-2xl font-bold text-slate-950">Create User</h1>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('users.store') }}" class="max-w-3xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @include('users.partials.form', ['user' => null, 'roles' => $roles])
    </form>
</x-app-layout>
