<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Approval</p>
            <h1 class="text-2xl font-bold text-slate-950">Approval Posts</h1>
        </div>
    </x-slot>

    <div class="mb-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">Tugas Manager</h2>
        <p class="mt-2 max-w-3xl text-sm leading-6 text-slate-600">
            Halaman ini dipakai user dengan permission <strong>publish-post</strong> untuk melihat konten draft dan mempublish konten yang sudah layak tampil di Informasi Kampus.
        </p>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-6 py-3">Draft</th>
                    <th class="px-6 py-3">Category</th>
                    <th class="px-6 py-3">Author</th>
                    <th class="px-6 py-3">Created</th>
                    <th class="px-6 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($posts as $post)
                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-slate-100">
                        <td class="px-6 py-4">
                            <p class="font-semibold">{{ $post->title }}</p>
                            <p class="mt-1 text-slate-500">{{ $post->excerpt }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="rounded-md bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-700">{{ $post->category }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $post->author?->name ?? 'Unknown' }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $post->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('posts.preview', $post) }}" class="rounded-lg border border-slate-200 px-3 py-2 font-semibold hover:bg-white">Preview</a>
                                <form method="POST" action="{{ route('posts.publish', $post) }}">
                                @csrf
                                @method('PATCH')
                                    <button class="rounded-lg bg-emerald-600 px-3 py-2 font-semibold text-white hover:bg-emerald-700">Publish</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">Tidak ada draft yang menunggu approval.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $posts->links() }}</div>
</x-app-layout>
