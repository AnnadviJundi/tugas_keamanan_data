<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Permissions</p>
            <h1 class="text-2xl font-bold text-slate-950">Create Permission</h1>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('permissions.store') }}" class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @include('permissions.partials.form', ['permission' => null])
    </form>
</x-app-layout>
