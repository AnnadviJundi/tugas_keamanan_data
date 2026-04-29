<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Campus Content RBAC</p>
            <h1 class="text-2xl font-bold text-slate-950">Dashboard Sistem Manajemen Konten Kampus</h1>
        </div>
    </x-slot>

    <div class="mb-8 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <div class="max-w-4xl">
            <h2 class="text-lg font-bold text-slate-950">Tujuan Project</h2>
            <p class="mt-2 text-sm leading-6 text-slate-600">
                Aplikasi ini mensimulasikan sistem kampus untuk mengatur siapa yang boleh mengelola user, role, konten artikel/pengumuman, laporan, dan audit log. Fokus utamanya adalah RBAC manual berbasis database: user punya role, role punya permission, lalu menu dan aksi di aplikasi mengikuti permission tersebut.
            </p>
        </div>
        <div class="mt-5 grid gap-4 md:grid-cols-3">
            <div class="rounded-lg bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-500">Role aktif</p>
                <p class="mt-1 text-lg font-bold">{{ auth()->user()->role_names ?: 'Belum ada role' }}</p>
            </div>
            <div class="rounded-lg bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-500">Cara akses menu</p>
                <p class="mt-1 text-sm text-slate-600">Sidebar hanya menampilkan menu yang permission-nya dimiliki user login.</p>
            </div>
            <div class="rounded-lg bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-500">Untuk presentasi</p>
                <a href="{{ route('demo-guide') }}" class="mt-1 inline-block text-sm font-bold text-slate-950 underline">Buka Demo Guide</a>
            </div>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Users</p>
            <p class="mt-3 text-3xl font-bold">{{ $totalUsers }}</p>
            <p class="mt-2 text-sm text-slate-500">Akun aktor sistem: super-admin, admin, manager, editor, viewer.</p>
        </div>
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Roles</p>
            <p class="mt-3 text-3xl font-bold">{{ $totalRoles }}</p>
            <p class="mt-2 text-sm text-slate-500">Setiap role berisi kumpulan permission.</p>
        </div>
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Permissions</p>
            <p class="mt-3 text-3xl font-bold">{{ $totalPermissions }}</p>
            <p class="mt-2 text-sm text-slate-500">Permission menentukan menu dan aksi CRUD.</p>
        </div>
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-[1fr_1.2fr]">
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold">Alur Sistem</h2>
            <div class="mt-5 space-y-4 text-sm text-slate-600">
                <div>
                    <p class="font-semibold text-slate-950">1. Login sebagai user demo</p>
                    <p>Setiap akun punya role berbeda, sehingga sidebar dan tombol aksi ikut berubah.</p>
                </div>
                <div>
                    <p class="font-semibold text-slate-950">2. Cek menu yang muncul</p>
                    <p>Contoh: viewer hanya melihat Dashboard dan Reports, editor melihat Post Management.</p>
                </div>
                <div>
                    <p class="font-semibold text-slate-950">3. Lakukan aksi CRUD</p>
                    <p>Aksi penting seperti membuat user, mengubah role, dan publish post tersimpan di Activity Logs.</p>
                </div>
            </div>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="text-lg font-semibold">Recent Activity</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-6 py-3">User</th>
                            <th class="px-6 py-3">Action</th>
                            <th class="px-6 py-3">Description</th>
                            <th class="px-6 py-3">Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($latestLogs as $log)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4">{{ $log->user?->name ?? 'System' }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $log->action }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $log->description }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $log->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada aktivitas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
