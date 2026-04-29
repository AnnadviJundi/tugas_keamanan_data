<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Management</p>
            <h1 class="text-2xl font-bold text-slate-950">Users</h1>
        </div>
    </x-slot>

    <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form class="flex gap-2" method="GET">
            <input name="search" value="{{ request('search') }}" class="rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500" placeholder="Search users">
            <button class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-100">Filter</button>
        </form>
        <a href="{{ route('users.create') }}" class="rounded-lg bg-slate-950 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Create User</a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Roles</th>
                    <th class="px-6 py-3">Permissions</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($users as $user)
                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-slate-100">
                        <td class="px-6 py-4 font-semibold">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $user->role_names ?: '-' }}</td>
                        <td class="px-6 py-4 text-slate-600">
                            <div class="flex max-w-xl flex-wrap gap-2">
                                @forelse ($user->roles->flatMap->permissions->unique('slug')->sortBy('name') as $permission)
                                    <span class="rounded-md bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-700">{{ $permission->slug }}</span>
                                @empty
                                    <span>-</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('users.edit', $user) }}" class="rounded-lg border border-slate-200 px-3 py-2 font-semibold hover:bg-white">Edit</a>
                                <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg border border-rose-200 px-3 py-2 font-semibold text-rose-700 hover:bg-rose-50">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $users->links() }}</div>
</x-app-layout>
