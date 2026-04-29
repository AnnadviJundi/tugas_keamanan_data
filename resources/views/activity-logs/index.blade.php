<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Audit</p>
            <h1 class="text-2xl font-bold text-slate-950">Activity Logs</h1>
        </div>
    </x-slot>

    <section class="mb-5 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
        <div class="mb-4">
            <h2 class="text-lg font-bold">Filter Aktivitas</h2>
            <p class="mt-1 text-sm text-slate-600">Gunakan filter untuk melihat aktivitas berdasarkan user dan tanggal tertentu.</p>
        </div>

        <form method="GET" class="grid gap-4 md:grid-cols-[1fr_220px_auto_auto] md:items-end">
            <div>
                <label for="user_id" class="text-sm font-semibold text-slate-700">User</label>
                <select id="user_id" name="user_id" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    <option value="">Semua user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>{{ $user->name }} - {{ $user->email }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="date" class="text-sm font-semibold text-slate-700">Tanggal</label>
                <input id="date" name="date" type="date" value="{{ request('date') }}" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
            </div>

            <button class="rounded-lg bg-slate-950 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Terapkan</button>
            @if (request()->hasAny(['user_id', 'date']))
                <a href="{{ route('activity-logs.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-center text-sm font-semibold hover:bg-slate-100">Reset</a>
            @endif
        </form>
    </section>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Action</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">IP</th>
                    <th class="px-6 py-3">Created</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($logs as $log)
                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-slate-100">
                        <td class="px-6 py-4">{{ $log->user?->name ?? 'System' }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $log->action }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $log->description }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $log->ip_address }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $log->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">Tidak ada aktivitas yang cocok dengan filter.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $logs->links() }}</div>
</x-app-layout>
