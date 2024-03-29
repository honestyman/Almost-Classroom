@if (isset($posts))
    @foreach ($posts as $post)
        <div class="pt-6 sm:pt-8 pb-6">
            <div class="mx-0 sm:mx-5">
                <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden sm:rounded-lg shadow-md">
                    <div class="p-2 sm:p-4" onmouseover="this.style.cursor='pointer'"
                        onclick="window.location='/group/{{ $post->group->id }}/post/{{ $post->id }}'">
                        <div class="grid grid-cols-1 md:grid-cols-3">
                            <div class="flex justify-start p-3">
                                <span class="text-sm pt-1 capitalise mx-1">{{ $post->group->name }}</span>
                                <b class="text-xl uppercase mx-1">{{ $post->name }}</b>
                            </div>

                            <div class="italic p-3 align-middle flex justify-center">
                                @if (isset($post->deadline) || $post->deadline != null)
                                    Termín odevzdání
                                    {{ date('Y-m-d-H-i') > date_create_from_format('Y-m-d H:i:s', $post->deadline)->format('Y-m-d-H-i') ? 'byl' : 'je' }}
                                    {{ date_create_from_format('Y-m-d H:i:s', $post->deadline)->format('d. m. Y ') }}
                                    ve
                                    {{ date_create_from_format('Y-m-d H:i:s', $post->deadline)->format('H:i') }}
                                @else
                                    Bez termínu odevzdání
                                @endif
                            </div>

                            <div class="flex justify-end align-middle">
                                @if ($post->user_id === auth()->id() || auth()->user()->admin === 1 || $post->type === 0)
                                    <i class="fa-solid fa-square-up-right text-5xl text-blue-500 mr-2"></i>
                                @else
                                    @forelse ($post->postusers as $postuser)
                                        @if ($postuser->user_id === auth()->id() && $postuser->post_id === $post->id)
                                            @if ($postuser->finished === 1)
                                                @if (isset($post->deadline) || $post->deadline != null)
                                                    @if (date_create_from_format('Y-m-d H:i:s', $postuser->updated_at)->format('d. m. Y H:i') >
                                                            date_create_from_format('Y-m-d H:i:s', $post->deadline)->format('d. m. Y H:i'))
                                                        <i
                                                            class="fa-solid fa-square-check text-5xl text-yellow-300 mr-2"></i>
                                                    @else
                                                        <i
                                                            class="fa-solid fa-square-check text-5xl text-green-600 mr-2"></i>
                                                    @endif
                                                @else
                                                    <i
                                                        class="fa-solid fa-square-check text-5xl text-green-600 mr-2"></i>
                                                @endif
                                            @else
                                                <i class="fa-solid fa-square-xmark text-5xl text-red-600 mr-2"></i>
                                            @endif
                                        @endif
                                    @empty
                                        <i class="fa-solid fa-square-xmark text-5xl text-red-600 mr-2"></i>
                                    @endforelse
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="p-8" id="pagination">
        {{ $posts->onEachSide(1)->links() }}
    </div>
@endif
