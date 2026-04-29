<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Posts</p>
            <h1 class="text-2xl font-bold text-slate-950">Edit Post</h1>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('posts.update', $post) }}" class="max-w-4xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @method('PUT')
        @include('posts.partials.form', ['post' => $post])
    </form>
</x-app-layout>
