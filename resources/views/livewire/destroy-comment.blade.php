<div class="p-8">
    <div>
        <form action="{{ route('post.comment.destroy', [$comment->post->id, $comment->id]) }}" method="POST">
            @method('DELETE')
            @csrf

            <span class="text-xl">Smazat komentář?</span>

            <!-- CONTENT -->
            <div class="my-3">
                <x-input-label for="content" :value="__('Obsah')" />
                <x-text-input id="content" class="block mt-1 w-full" type="text" name="content" :value="old('content', isset($comment) ? $comment->content : '')"
                    disabled autofocus autocomplete="content" />
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
