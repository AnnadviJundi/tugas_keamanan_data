@csrf

<div class="grid gap-5">
    <div>
        <label class="text-sm font-semibold text-slate-700" for="name">Name</label>
        <input id="name" name="name" value="{{ old('name', $user?->name) }}" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
        @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="text-sm font-semibold text-slate-700" for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user?->email) }}" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
        @error('email') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label class="text-sm font-semibold text-slate-700" for="password">Password</label>
            <input id="password" name="password" type="password" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
            @error('password') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700" for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-2 w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
        </div>
    </div>

    <fieldset>
        <legend class="text-sm font-semibold text-slate-700">Roles</legend>
        <div class="mt-3 grid gap-3 sm:grid-cols-2">
            @foreach ($roles as $role)
                <label class="flex items-center gap-3 rounded-lg border border-slate-200 px-4 py-3 text-sm hover:bg-slate-50">
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="rounded border-slate-300 text-slate-950 focus:ring-slate-500" @checked(in_array($role->id, old('roles', $user?->roles->pluck('id')->all() ?? [])))>
                    <span>
                        <span class="block font-semibold">{{ $role->name }}</span>
                        <span class="text-slate-500">{{ $role->slug }}</span>
                    </span>
                </label>
            @endforeach
        </div>
        @error('roles') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </fieldset>
</div>

<div class="mt-6 flex items-center justify-end gap-3">
    <a href="{{ route('users.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold hover:bg-slate-100">Cancel</a>
    <button class="rounded-lg bg-slate-950 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Save</button>
</div>
