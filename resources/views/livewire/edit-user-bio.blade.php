<div class="p-8">
    <div>
        <form action="{{ route('user.bio.update', $user->id) }}" method="POST">
            @method('PUT')
            @csrf

            <span class="text-xl">Upravte popisek uživaatele!</span>

            <!-- BIO -->
            <div class="my-3">
                <x-input-label for="bio" :value="__('BIO')" />
                <x-text-input id="bio" class="block mt-1 w-full" type="text" name="bio" :value="old('bio', isset($user) ? $user->bio : '')"
                    required autofocus autocomplete="bio" />
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
