<div class="p-8 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-300">
    <div>
        <form action="{{ route('group.destroy', $group->id) }}" method="POST">
            @method('DELETE')
            @csrf

            <span class="text-xl font-bold">Smazat skupinu?</span>

            <!-- Name -->
            <div class="my-3">
                <x-input-label for="name" :value="__('Název')" />
                <x-text-input id="name"
                    class="block mt-1 w-full text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" name="name" :value="old('name', isset($group) ? $group->name : '')" disabled autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="flex flex-col gap-3">
                <p>Ve skupině je celkem:</p>
                <p><span class="font-bold">{{ $group->users()->count() }}</span> uživatelů</p>
                <p><span class="font-bold">{{ $group->posts()->count() }}</span> příspěvků</p>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Smazat') }}
                </x-primary-button>
            </div>

        </form>
    </div>
</div>
