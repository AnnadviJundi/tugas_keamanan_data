<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Panduan Presentasi</p>
            <h1 class="text-2xl font-bold text-slate-950">Demo Guide RBAC</h1>
        </div>
    </x-slot>

    <div class="grid gap-6 xl:grid-cols-[1fr_1fr]">
        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold">Project Ini Buat Apa?</h2>
            <p class="mt-3 text-sm leading-6 text-slate-600">
                Project ini adalah simulasi sistem manajemen konten kampus. Admin kampus dapat mengelola user dan role, editor dapat membuat konten, manager dapat melihat laporan dan melakukan approval publish, viewer dapat membaca informasi dan laporan. Semua pembatasan akses dibuat manual tanpa package RBAC eksternal.
            </p>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="mt-6 text-sm font-bold uppercase tracking-wide text-slate-500">Skenario demo singkat</h3>
            <ol class="mt-3 space-y-3 text-sm text-slate-600">
                <li>1. Login sebagai role <strong>super-admin</strong> untuk menunjukkan semua menu.</li>
                <li>2. Login sebagai role <strong>editor</strong> untuk membuat draft post dari Post Management.</li>
                <li>3. Login sebagai role <strong>manager</strong> untuk publish draft dari Approval Posts.</li>
                <li>4. Login sebagai role <strong>viewer</strong> untuk membaca informasi yang sudah published.</li>
                <li>5. Login sebagai admin/super-admin, lalu lihat Activity Logs sebagai bukti audit.</li>
            </ol>
        </section>
    </div>

    <section class="mt-6 overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 px-6 py-4">
            <h2 class="text-lg font-bold">Role Permission Matrix</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3">Permission utama</th>
                        <th class="px-6 py-3">Makna di aplikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr>
                        <td class="px-6 py-4 font-semibold">super-admin</td>
                        <td class="px-6 py-4 text-slate-600">Semua permission</td>
                        <td class="px-6 py-4 text-slate-600">Pemilik sistem, bisa mengelola seluruh data.</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-semibold">admin</td>
                        <td class="px-6 py-4 text-slate-600">manage-users, manage-roles, view-activity-logs</td>
                        <td class="px-6 py-4 text-slate-600">Petugas administrasi user dan role.</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-semibold">manager</td>
                        <td class="px-6 py-4 text-slate-600">view-reports, publish-post, view-activity-logs</td>
                        <td class="px-6 py-4 text-slate-600">Melihat performa konten dan melakukan approval publish.</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-semibold">editor</td>
                        <td class="px-6 py-4 text-slate-600">create-post, edit-post</td>
                        <td class="px-6 py-4 text-slate-600">Membuat dan mengubah konten kampus.</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-semibold">viewer</td>
                        <td class="px-6 py-4 text-slate-600">view-dashboard, view-reports</td>
                        <td class="px-6 py-4 text-slate-600">Hanya melihat informasi tanpa mengubah data.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="mt-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">Alur RBAC di Project Ini</h2>
        <p class="mt-2 text-sm leading-6 text-slate-600">
            Diagram ini menjelaskan kenapa menu setiap user berbeda. Sistem tidak mengecek nama role secara langsung untuk memberi akses aksi, tetapi mengecek permission yang dimiliki role user.
        </p>

        <div class="mt-6 grid gap-4 md:grid-cols-4">
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-bold text-slate-950">1. User</p>
                <p class="mt-2 text-sm text-slate-600">Contoh: Manager login ke sistem.</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-bold text-slate-950">2. Role</p>
                <p class="mt-2 text-sm text-slate-600">Manager memiliki role manager.</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-bold text-slate-950">3. Permission</p>
                <p class="mt-2 text-sm text-slate-600">Role manager punya publish-post dan view-reports.</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-bold text-slate-950">4. Menu/Aksi</p>
                <p class="mt-2 text-sm text-slate-600">Manager melihat Approval Posts dan Reports.</p>
            </div>
        </div>
    </section>

    <section class="mt-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">ERD Sederhana</h2>
        <p class="mt-2 text-sm leading-6 text-slate-600">
            Struktur database utama dibuat untuk memperlihatkan relasi RBAC dan konten. Tabel pivot dipakai karena user bisa punya banyak role, dan role bisa punya banyak permission.
        </p>

        <div class="mt-6 grid gap-4 lg:grid-cols-4">
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-bold text-slate-950">users</p>
                <p class="mt-2 text-xs leading-5 text-slate-600">id, name, email, password</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-bold text-slate-950">roles</p>
                <p class="mt-2 text-xs leading-5 text-slate-600">id, name, slug</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-bold text-slate-950">permissions</p>
                <p class="mt-2 text-xs leading-5 text-slate-600">id, name, slug</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-bold text-slate-950">posts</p>
                <p class="mt-2 text-xs leading-5 text-slate-600">id, user_id, title, category, status</p>
            </div>
        </div>

        <div class="mt-6 grid gap-4 lg:grid-cols-3">
            <div class="rounded-lg border border-slate-200 p-4">
                <p class="text-sm font-semibold text-slate-950">users -> role_user -> roles</p>
                <p class="mt-2 text-sm text-slate-600">Relasi many-to-many antara user dan role.</p>
            </div>
            <div class="rounded-lg border border-slate-200 p-4">
                <p class="text-sm font-semibold text-slate-950">roles -> permission_role -> permissions</p>
                <p class="mt-2 text-sm text-slate-600">Relasi many-to-many antara role dan permission.</p>
            </div>
            <div class="rounded-lg border border-slate-200 p-4">
                <p class="text-sm font-semibold text-slate-950">users -> posts / activity_logs</p>
                <p class="mt-2 text-sm text-slate-600">User menjadi author post dan pelaku aktivitas audit.</p>
            </div>
        </div>
    </section>
</x-app-layout>
