@csrf

<div class="grid gap-5">
    <div>
        <label class="text-sm font-semibold text-slate-700" for="title">Title</label>
        <input id="title" name="title" value="{{ old('title', $post?->title) }}" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
        @error('title') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="text-sm font-semibold text-slate-700" for="slug">Slug</label>
        <input id="slug" name="slug" value="{{ old('slug', $post?->slug) }}" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500" placeholder="Auto-generated when empty">
        @error('slug') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="text-sm font-semibold text-slate-700" for="category">Category</label>
        <select id="category" name="category" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
            @foreach (['Akademik', 'Beasiswa', 'Kegiatan', 'Layanan Mahasiswa', 'IT', 'Keamanan', 'Karier', 'Umum'] as $category)
                <option value="{{ $category }}" @selected(old('category', $post?->category ?? 'Umum') === $category)>{{ $category }}</option>
            @endforeach
        </select>
        @error('category') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="text-sm font-semibold text-slate-700" for="excerpt">Excerpt</label>
        <textarea id="excerpt" name="excerpt" rows="3" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">{{ old('excerpt', $post?->excerpt) }}</textarea>
        @error('excerpt') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="text-sm font-semibold text-slate-700" for="content">Content</label>
        <textarea id="content" name="content" rows="8" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">{{ old('content', $post?->content) }}</textarea>
        @error('content') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="text-sm font-semibold text-slate-700" for="status">Status</label>
        <select id="status" name="status" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
            <option value="draft" @selected(old('status', $post?->status ?? 'draft') === 'draft')>Draft</option>
            @canPermission('publish-post')
                <option value="published" @selected(old('status', $post?->status) === 'published')>Published</option>
            @endcanPermission
        </select>
        @error('status') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-3">
    <a href="{{ route('posts.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold hover:bg-slate-100">Cancel</a>
    <button class="rounded-lg bg-slate-950 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Save</button>
</div>
