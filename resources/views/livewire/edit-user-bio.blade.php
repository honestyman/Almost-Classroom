<div class="p-8 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-300">
    <div>
        <form action="{{ route('user.bio.update', $user->id) }}" method="POST">
            @method('PUT')
            @csrf

            <span class="text-xl font-bold">Upravte popisek uživatele!</span>

            <!-- BIO -->
            <div class="my-3">
                <x-input-label for="bio" :value="__('BIO')" />
                <x-text-input id="bio"
                    class="block mt-1 w-full text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" name="bio" :value="old('bio', isset($user) ? $user->bio : '')" required autofocus autocomplete="bio" />
                <x-input-error :messages="$errors->get('bio')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Upravit') }}
                </x-primary-button>
            </div>

        </form>
    </div>
</div>
