<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Portal Pembaca</p>
            <h1 class="text-2xl font-bold text-slate-950">Informasi Kampus</h1>
        </div>
    </x-slot>

    <section class="mb-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-3xl">
                <h2 class="text-lg font-bold">Daftar Informasi Resmi</h2>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Semua user yang sudah login dapat membaca informasi published. Konten yang masih draft tidak muncul di sini sampai dipublish oleh user yang memiliki permission approval.
                </p>
            </div>
            <div class="rounded-lg bg-slate-50 px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Published</p>
                <p class="mt-1 text-2xl font-bold text-slate-950">{{ $publishedCount }}</p>
            </div>
        </div>

        <form method="GET" class="mt-5 grid gap-3 lg:grid-cols-[1fr_auto_auto_auto]">
            <input name="search" value="{{ request('search') }}" class="w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500" placeholder="Cari judul atau ringkasan informasi">
            <select name="category" class="rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
                <option value="">Semua kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
            <button class="rounded-lg bg-slate-950 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Cari</button>
            @if (request()->hasAny(['search', 'category']))
                <a href="{{ route('information.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-center text-sm font-semibold hover:bg-slate-100">Reset</a>
            @endif
        </form>
    </section>

    <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 px-6 py-4">
            <h2 class="text-lg font-semibold">List Informasi</h2>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse ($posts as $post)
                <article class="p-6 transition hover:bg-slate-50">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                <span class="rounded-md bg-emerald-100 px-2 py-1 text-emerald-700">Published</span>
                                <span class="rounded-md bg-slate-100 px-2 py-1 text-slate-700">{{ $post->category }}</span>
                                <span>{{ $post->published_at?->format('d M Y') }}</span>
                                <span class="text-slate-300">/</span>
                                <span>{{ $post->author?->name ?? 'Unknown' }}</span>
                            </div>
                            <h3 class="mt-3 text-xl font-bold text-slate-950">{{ $post->title }}</h3>
                            <p class="mt-2 max-w-3xl text-sm leading-6 text-slate-600">{{ $post->excerpt }}</p>
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <a href="{{ route('information.show', $post) }}" class="rounded-lg bg-slate-950 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                                Baca
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="p-8 text-center text-slate-500">
                    Tidak ada informasi yang cocok.
                </div>
            @endforelse
        </div>
    </section>

    <div class="mt-6">{{ $posts->links() }}</div>
</x-app-layout>
