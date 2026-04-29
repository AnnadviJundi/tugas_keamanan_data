<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Campus Content RBAC') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <script>
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-50 font-sans text-slate-900 antialiased">
        <div class="min-h-screen lg:flex">
            <aside class="bg-slate-950 text-white lg:fixed lg:inset-y-0 lg:w-72">
                <div class="flex h-full flex-col">
                    <div class="border-b border-white/10 px-6 py-6">
                        <a href="{{ route('dashboard') }}" class="text-xl font-bold tracking-tight">Campus Content RBAC</a>
                        <p class="mt-1 text-sm text-slate-400">Sistem role & permission manual</p>
                    </div>

                    <nav class="flex-1 space-y-1 px-4 py-6">
                        <a href="{{ route('dashboard') }}" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('dashboard', '*.dashboard') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('demo-guide') }}" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('demo-guide') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            Demo Guide
                        </a>
                        <a href="{{ route('information.index') }}" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('information.*') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            Informasi Kampus
                        </a>
                        @canPermission('manage-users')
                            <a href="{{ route('users.index') }}" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('users.*') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                                Users
                            </a>
                        @endcanPermission
                        @canPermission('manage-roles')
                            <a href="{{ route('roles.index') }}" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('roles.*') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                                Roles
                            </a>
                        @endcanPermission
                        @canPermission('manage-permissions')
                            <a href="{{ route('permissions.index') }}" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('permissions.*') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                                Permissions
                            </a>
                        @endcanPermission
                        @if (auth()->user()->hasPermission('create-post') || auth()->user()->hasPermission('edit-post') || auth()->user()->hasPermission('delete-post'))
                            <a href="{{ route('posts.index') }}" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('posts.*') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                                Post Management
                            </a>
                        @endif
                        @canPermission('publish-post')
                            <a href="{{ route('posts.approvals') }}" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('posts.approvals') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                                Approval Posts
                            </a>
                        @endcanPermission
                        @canPermission('view-reports')
                            <a href="{{ route('reports.index') }}" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('reports.*') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                                Reports
                            </a>
                        @endcanPermission
                        @canPermission('view-activity-logs')
                            <a href="{{ route('activity-logs.index') }}" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('activity-logs.*') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                                Activity Logs
                            </a>
                        @endcanPermission
                    </nav>

                    <div class="border-t border-white/10 px-6 py-5 text-sm">
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                        <p class="mt-1 text-slate-400">{{ auth()->user()->role_names ?: 'No role' }}</p>
                    </div>
                </div>
            </aside>

            <div class="min-h-screen flex-1 lg:pl-72">
                <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/90 backdrop-blur">
                    <div class="flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                        <div>
                            @isset($header)
                                {{ $header }}
                            @else
                                <h1 class="text-xl font-semibold">Dashboard</h1>
                            @endisset
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="button" data-theme-toggle class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-100" aria-label="Toggle dark mode">
                                <svg data-theme-icon="moon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A8.5 8.5 0 1 1 11.2 3a6.5 6.5 0 0 0 9.8 9.8Z" />
                                </svg>
                                <svg data-theme-icon="sun" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="4" />
                                    <path stroke-linecap="round" d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
                                </svg>
                            </button>
                            <a href="{{ route('profile.edit') }}" class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="rounded-lg bg-slate-950 px-3 py-2 text-sm font-semibold text-white hover:bg-slate-800">Logout</button>
                            </form>
                        </div>
                    </div>
                </header>

                <main class="px-4 py-8 sm:px-6 lg:px-8">
                    @if (session('success'))
                        <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">{{ session('error') }}</div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
