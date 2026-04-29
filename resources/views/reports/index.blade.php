<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Laporan Pembaca</p>
            <h1 class="text-2xl font-bold text-slate-950">Reports</h1>
        </div>
    </x-slot>

    <div class="mb-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">Isi Laporan</h2>
        <p class="mt-2 max-w-4xl text-sm leading-6 text-slate-600">
            Reports menjelaskan kondisi konten di portal kampus. Viewer dapat membaca laporan ini untuk mengetahui berapa informasi yang sudah dipublish, berapa yang masih draft, dan informasi terbaru apa saja yang tersedia untuk dibaca.
        </p>
    </div>

    <div class="grid gap-6 md:grid-cols-4">
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Posts</p>
            <p class="mt-3 text-3xl font-bold">{{ $totalPosts }}</p>
            <p class="mt-2 text-xs text-slate-500">Semua konten, termasuk draft.</p>
        </div>
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Published</p>
            <p class="mt-3 text-3xl font-bold">{{ $publishedPosts }}</p>
            <p class="mt-2 text-xs text-slate-500">Sudah bisa dibaca viewer.</p>
        </div>
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Draft</p>
            <p class="mt-3 text-3xl font-bold">{{ $draftPosts }}</p>
            <p class="mt-2 text-xs text-slate-500">Belum tampil di informasi.</p>
        </div>
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Active Users</p>
            <p class="mt-3 text-3xl font-bold">{{ $activeUsers }}</p>
            <p class="mt-2 text-xs text-slate-500">User aktif dalam sistem.</p>
        </div>
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-[0.9fr_1.4fr]">
        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold">Kesimpulan Laporan</h2>
            <div class="mt-4 space-y-3 text-sm leading-6 text-slate-600">
                @foreach ($reportNotes as $note)
                    <p class="rounded-lg bg-slate-50 p-3">{{ $note }}</p>
                @endforeach
            </div>
        </section>

        <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="text-lg font-semibold">Informasi Terbaru yang Sudah Dipublish</h2>
            </div>
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-6 py-3">Informasi</th>
                        <th class="px-6 py-3">Author</th>
                        <th class="px-6 py-3">Published</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($latestPublishedPosts as $post)
                        <tr class="odd:bg-white even:bg-slate-50 hover:bg-slate-100">
                            <td class="px-6 py-4">
                                <p class="font-semibold">{{ $post->title }}</p>
                                <p class="mt-1 text-slate-500">{{ $post->excerpt }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $post->author?->name ?? 'Unknown' }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $post->published_at?->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('information.show', $post) }}" class="rounded-lg border border-slate-200 px-3 py-2 font-semibold hover:bg-white">Baca</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada post yang dipublish.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>
</x-app-layout>
