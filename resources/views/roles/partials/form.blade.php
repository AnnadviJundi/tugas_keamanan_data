@csrf

<div class="grid gap-5">
    <div>
        <label class="text-sm font-semibold text-slate-700" for="name">Name</label>
        <input id="name" name="name" value="{{ old('name', $role?->name) }}" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
        @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="text-sm font-semibold text-slate-700" for="slug">Slug</label>
        <input id="slug" name="slug" value="{{ old('slug', $role?->slug) }}" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
        @error('slug') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <fieldset>
        <legend class="text-sm font-semibold text-slate-700">Permissions</legend>
        <div class="mt-3 grid gap-3 sm:grid-cols-2">
            @foreach ($permissions as $permission)
                <label class="flex items-center gap-3 rounded-lg border border-slate-200 px-4 py-3 text-sm hover:bg-slate-50">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="rounded border-slate-300 text-slate-950 focus:ring-slate-500" @checked(in_array($permission->id, old('permissions', $role?->permissions->pluck('id')->all() ?? [])))>
                    <span>
                        <span class="block font-semibold">{{ $permission->name }}</span>
                        <span class="text-slate-500">{{ $permission->slug }}</span>
                    </span>
                </label>
            @endforeach
        </div>
    </fieldset>
</div>

<div class="mt-6 flex items-center justify-end gap-3">
    <a href="{{ route('roles.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold hover:bg-slate-100">Cancel</a>
    <button class="rounded-lg bg-slate-950 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Save</button>
</div>
