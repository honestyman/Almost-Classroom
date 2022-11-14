<x-app-layout>
    <x-slot name="header">
        @if (isset($user))
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Vaše soukromé skupiny
            </h2>
            <div class="flex space-x-2 justify-start py-4">
                @foreach ($user->groups as $group)
                    <div class="px-2">

                        <form action="/group/{{ $group->id }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $group->id }}">
                            <button type="submit"
                                class="inline-block px-6 py-2 bg-gray-200 text-gray-700 font-medium leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">{{ $group->name }}</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

    </x-slot>
    
    @if (isset($user))
        @foreach ($posts as $postss)
            @foreach ($postss as $post)
                <div class="pt-6 sm:pt-8">
                    <div class="mx-0 sm:mx-5">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-4 sm:p-6 bg-white border-b border-gray-200">
                                <div class="sm:grid sm:grid-cols-5">
                                    <!-- HLAVNÍ ČÁST POSTU -->
                                    <div class="sm:col-span-3">
                                        <div class="flex">
                                            <p class="text-xl">
                                                <b>{{ $post->user->name }}</b> ve skupině <b>{{ $post->group->name }}</b>
                                            </p>
                                            <!-- TADY JE ROZKLIKAVACI MENU NA MAZANI & UPRAVU POSTU-->
                                            @if (Auth::user()->id == $post->group->user_id)
                                                <div class="flex items-center ml-2 sm:m-1">
                                                    <x-dropdown align="left" width="48">
                                                        <x-slot name="trigger">
                                                            <button
                                                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                                <div><i class="fa-solid fa-gear"></i></div>
                                                            </button>
                                                        </x-slot>

                                                        <x-slot name="content">
                                                            <x-dropdown-link>
                                                                <p class="flex justify-between">
                                                                    {{ 'Upravit' }}
                                                                    <i class="fa-solid fa-pen pr-4 pt-0.5"></i>
                                                                </p>
                                                            </x-dropdown-link>
                                                            <x-dropdown-link>
                                                                <p class="flex justify-between">
                                                                    {{ 'Smazat' }}
                                                                    <i class="fa-solid fa-trash pr-4 pt-0.5"></i>
                                                                </p>
                                                            </x-dropdown-link>
                                                        </x-slot>
                                                    </x-dropdown>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-2 border-b-2 sm:border-b-0 border-slate-500 text-lg">
                                            {{ $post->content }}
                                        </div>




                                    </div>
                                    <!-- KOMENTÁŘOVÁ ČÁST POSTU -->
                                    <div class="mt-2 max-h-80 h-60 sm:max-h-100 sm:h-80 sm:col-span-2">
                                        <div class="max-h-80 h-60 sm:h-80 overflow-auto">
                                            @foreach ($post->comments as $comment)
                                                <div class="flex">
                                                    <b class="mr-2">{{ $comment->user->name }}</b>
                                                    <!-- TADY JE ROZKLIKAVACI MENU NA MAZANI & UPRAVU KOMENTÁŘŮ-->
                                                    @if (Auth::user()->id == $comment->user_id)
                                                        <div class="sm:flex items-center pt-1 sm:pt-0 sm:m-1">
                                                            <x-dropdown align="left" width="48">
                                                                <x-slot name="trigger">
                                                                    <button
                                                                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                                        <div><i class="fa-solid fa-gear"></i></div>
                                                                    </button>
                                                                </x-slot>
                                                                <x-slot name="content">
                                                                    <x-dropdown-link>
                                                                        <div class="flex justify-between hover:cursor-pointer"
                                                                            type="button"
                                                                            data-modal-toggle="popup-modal-comment-{{ $comment->id }}-add">
                                                                            {{ 'Upravit' }}
                                                                            <i class="fa-solid fa-pen pr-4 pt-0.5"></i>
                                                                        </div>
                                                                    </x-dropdown-link>
                                                                    <x-dropdown-link>
                                                                        <div class="flex justify-between hover:cursor-pointer"
                                                                            type="button"
                                                                            data-modal-toggle="popup-modal-comment-{{ $comment->id }}-del">
                                                                            {{ 'Smazat' }}
                                                                            <i
                                                                                class="fa-solid fa-trash pr-4 pt-0.5"></i>
                                                                        </div>
                                                                    </x-dropdown-link>
                                                                </x-slot>

                                                            </x-dropdown>
                                                        </div>
                                                    @endif
                                                </div>
                                                <x-modal :id="$comment->id" type="comment" :content="$comment->content"
                                                    function="add">
                                                </x-modal>
                                                <x-modal :id="$comment->id" type="comment" :content="$comment->content"
                                                    function="del">
                                                </x-modal>
                                                <p>{{ $comment->content }}</p>
                                            @endforeach



                                            <form action="/add" method="POST" class="mt-2">
                                                @csrf
                                                <input type="hidden" id="post_id" name="post_id"
                                                    value="{{ $post->id }}">
                                                <input type="hidden" id="user_id" name="user_id"
                                                    value="{{ Auth::user()->id }}">
                                                <input type="hidden" id="workingWith" name="workingWith"
                                                    value="comment">
                                                <div class="flex items-center py-2 rounded-lg dark:bg-gray-700">
                                                    <textarea name="content" id="content" rows="1"
                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 resize-none"
                                                        placeholder="Přidejte komentář"></textarea>
                                                    <button type="submit"
                                                        class="inline-flex justify-center p-2 text-slate-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                                        <svg aria-hidden="true" class="w-6 h-6 rotate-90"
                                                            fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                                            </path>
                                                        </svg>
                                                        <span class="sr-only">Pridejte komentář</span>
                                                    </button>

                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                                <p class="text-slate-600 italic">
                                    Nahráno {{ $post->created_at->format('d. m. Y ') }} v
                                    {{ $post->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    @endif


</x-app-layout>
