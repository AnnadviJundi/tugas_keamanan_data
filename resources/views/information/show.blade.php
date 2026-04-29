<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Informasi Kampus</p>
            <h1 class="text-2xl font-bold text-slate-950">Detail Informasi</h1>
        </div>
    </x-slot>

    <article class="max-w-4xl overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
            <div class="flex flex-wrap items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-500">
                <span class="rounded-md bg-emerald-100 px-2 py-1 text-emerald-700">Published</span>
                <span class="rounded-md bg-slate-100 px-2 py-1 text-slate-700">{{ $post->category }}</span>
                <span>{{ $post->published_at?->format('d M Y H:i') }}</span>
                <span class="text-slate-300">/</span>
                <span>{{ $post->author?->name ?? 'Unknown' }}</span>
            </div>
            <h2 class="mt-4 text-3xl font-bold leading-tight text-slate-950">{{ $post->title }}</h2>
            <p class="mt-4 text-base leading-7 text-slate-600">{{ $post->excerpt }}</p>
        </div>

        <div class="px-6 py-6">
            <div class="space-y-4 text-sm leading-7 text-slate-700">
                @foreach (preg_split('/\r\n|\r|\n/', $post->content) as $paragraph)
                    @if (trim($paragraph) !== '')
                        <p>{{ $paragraph }}</p>
                    @endif
                @endforeach
            </div>

            <div class="mt-8 border-t border-slate-200 pt-5">
                <a href="{{ route('information.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold hover:bg-slate-100">Kembali ke List Informasi</a>
            </div>
        </div>
    </article>
</x-app-layout>
