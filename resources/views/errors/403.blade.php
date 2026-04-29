<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Akses Ditolak</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-950 text-white">
        <main class="flex min-h-screen items-center justify-center px-6">
            <div class="max-w-lg text-center">
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-400">403 Forbidden</p>
                <h1 class="mt-3 text-4xl font-bold">Anda tidak punya izin.</h1>
                <p class="mt-4 text-sm leading-6 text-slate-300">
                    Halaman ini dibatasi oleh permission. Coba login dengan akun yang memiliki hak akses sesuai menu tersebut, atau kembali ke dashboard.
                </p>
                <div class="mt-8 flex justify-center gap-3">
                    <a href="{{ route('dashboard') }}" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-950 hover:bg-slate-200">Dashboard</a>
                    <a href="{{ route('demo-guide') }}" class="rounded-lg border border-white/20 px-4 py-2 text-sm font-semibold text-white hover:bg-white/10">Demo Guide</a>
                </div>
            </div>
        </main>
    </body>
</html>
