<div class="p-8 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-300">
    <div>
        <form action="{{ route('group.post.update', [$post->group->id, $post->id]) }}" method="POST">
            @method('PUT')
            @csrf

            <span class="text-xl font-bold">Upravte příspěvek!</span>

            <!-- NAME -->
            <div class="my-3">
                <x-input-label for="name" :value="__('Nadpis')" />
                <x-text-input id="name"
                    class="block mt-1 w-full text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" name="name" :value="old('name', isset($post) ? $post->name : '')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- CONTENT -->
            <div class="my-3">
                <x-input-label for="content" :value="__('Obsah')" />
                <x-text-input id="content"
                    class="block mt-1 w-full text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" name="content" :value="old('content', isset($post) ? $post->content : '')" required autofocus autocomplete="content" />
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <!-- TYPE -->
            <div class="my-3">
                <select required name="type" id="type"
                    class="block mb-2 sm:mb-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" disabled {{ isset($post) ? '' : 'selected' }}>Zvolte typ úkolu
                    </option>
                    <option value="0" {{ $post->type === 0 ? 'selected' : '' }}>Bez odevzdání</option>
                    <option value="1" {{ $post->type === 1 ? 'selected' : '' }}>Pouze odkliknutí 'Splněno'</option>
                    <option value="2" {{ $post->type === 2 ? 'selected' : '' }}>'Splněno' doplněno textovým polem
                    </option>
                </select>
            </div>

            <!-- DEADLINE -->
            <div class="py-2 my-2">
                <input type="checkbox" id="deadline_switcher" wire:click="deadline" {{ $showDiv ? 'checked' : '' }}
                    class="mb-0.5 w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="deadline_switcher" class="ml-1">S termínem
                    odevzdání</label>
            </div>
            @if ($showDiv)
                <input type="datetime-local" id="deadline" name="deadline"
                    value="{{ old('deadline', isset($post) ? $post->deadline : '') }}"
                    class="p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @endif

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Upravit') }}
                </x-primary-button>
            </div>

        </form>
    </div>
</div>
