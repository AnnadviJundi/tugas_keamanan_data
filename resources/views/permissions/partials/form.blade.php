@csrf

<div class="grid gap-5">
    <div>
        <label class="text-sm font-semibold text-slate-700" for="name">Name</label>
        <input id="name" name="name" value="{{ old('name', $permission?->name) }}" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
        @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="text-sm font-semibold text-slate-700" for="slug">Slug</label>
        <input id="slug" name="slug" value="{{ old('slug', $permission?->slug) }}" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
        @error('slug') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-3">
    <a href="{{ route('permissions.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold hover:bg-slate-100">Cancel</a>
    <button class="rounded-lg bg-slate-950 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Save</button>
</div>
