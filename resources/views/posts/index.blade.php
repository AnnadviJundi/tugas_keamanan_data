<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Content</p>
            <h1 class="text-2xl font-bold text-slate-950">Post Management</h1>
        </div>
    </x-slot>

    <div class="mb-5 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
        <form class="grid gap-2 sm:grid-cols-[1fr_auto_auto_auto_auto]" method="GET">
            <input name="search" value="{{ request('search') }}" class="rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500" placeholder="Search posts">
            <select name="category" class="rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
                <option value="">All categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
            <select name="status" class="rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
                <option value="">All status</option>
                <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                <option value="published" @selected(request('status') === 'published')>Published</option>
            </select>
            <button class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-100">Filter</button>
            @if (request()->hasAny(['search', 'category', 'status']))
                <a href="{{ route('posts.index') }}" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-center text-sm font-semibold hover:bg-slate-100">Reset</a>
            @endif
        </form>

        @canPermission('create-post')
            <a href="{{ route('posts.create') }}" class="rounded-lg bg-slate-950 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Create Post</a>
        @endcanPermission
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-6 py-3">Post</th>
                    <th class="px-6 py-3">Category</th>
                    <th class="px-6 py-3">Author</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Published</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($posts as $post)
                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-slate-100">
                        <td class="px-6 py-4">
                            <p class="font-semibold">{{ $post->title }}</p>
                            <p class="text-slate-500">{{ $post->slug }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="rounded-md bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-700">{{ $post->category }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $post->author?->name ?? 'Unknown' }}</td>
                        <td class="px-6 py-4">
                            <span class="rounded-md px-2 py-1 text-xs font-semibold {{ $post->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ str($post->status)->title() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500">{{ $post->published_at?->format('d M Y H:i') ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                @canPermission('publish-post')
                                    @if (! $post->isPublished())
                                        <form method="POST" action="{{ route('posts.publish', $post) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="rounded-lg border border-emerald-200 px-3 py-2 font-semibold text-emerald-700 hover:bg-emerald-50">Publish</button>
                                        </form>
                                    @endif
                                @endcanPermission
                                @canPermission('edit-post')
                                    <a href="{{ route('posts.edit', $post) }}" class="rounded-lg border border-slate-200 px-3 py-2 font-semibold hover:bg-white">Edit</a>
                                @endcanPermission
                                @canPermission('delete-post')
                                    <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Hapus post ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-lg border border-rose-200 px-3 py-2 font-semibold text-rose-700 hover:bg-rose-50">Delete</button>
                                    </form>
                                @endcanPermission
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">Belum ada post.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $posts->links() }}</div>
</x-app-layout>
