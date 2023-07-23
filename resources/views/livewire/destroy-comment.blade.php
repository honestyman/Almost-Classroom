<div class="p-8 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-300">
    <div>
        <form action="{{ route('post.comment.destroy', [$comment->post->id, $comment->id]) }}" method="POST">
            @method('DELETE')
            @csrf

            <span class="text-xl font-bold">Smazat komentář?</span>

            <!-- CONTENT -->
            <div class="my-3">
                <x-input-label for="content" :value="__('Obsah')" />
                <x-text-input id="content"
                    class="block mt-1 w-full text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" name="content" :value="old('content', isset($comment) ? $comment->content : '')" disabled autofocus autocomplete="content" />
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Smazat') }}
                </x-primary-button>
            </div>

        </form>
    </div>
</div>
