@if (isset($site))
    <x-app-layout>

        <x-slot name="header">
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $site->name }}
                    </h2>
                </div>
                <div>

                    <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                        type="button">Skupiny <i class="fa-solid fa-caret-down ml-2"></i></button>
                    <div id="dropdown"
                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                            @foreach (Auth::user()->groups as $group)
                                <li>
                                    <a href="/group/{{ $group->id }}"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $group->name }}</a>
                                </li>
                            @endforeach
                    </div>
                </div>
            </div>
        </x-slot>


        @foreach ($site->posts as $post)
            <div class="pt-6 sm:pt-8">
                <div class="mx-0 sm:mx-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 sm:p-6 bg-white border-b border-gray-200">
                            <div class="sm:grid sm:grid-cols-5">
                                <!-- HLAVNÍ ČÁST POSTU -->
                                <div class="sm:col-span-3">
                                    <div class="flex">
                                        <b>{{ $post->user->name }}</b>
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
                                    <div class="p-2 pb-6 border-b-2 sm:border-b-0 border-slate-100">
                                        {{ $post->content }}
                                    </div>
                                    
                                    

                                    
                                </div>
                                <!-- KOMENTÁŘOVÁ ČÁST POSTU -->
                                <div class="max-h-80 h-60 sm:max-h-100 sm:h-80 sm:col-span-2">
                                    <div class="max-h-80 h-60 overflow-auto">
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
                                                                    <p class="flex justify-between" type="button"
                                                                        data-modal-toggle="popup-modal-comment-{{ $comment->id }}-add">
                                                                        {{ 'Upravit' }}
                                                                        <i class="fa-solid fa-pen pr-4 pt-0.5"></i>
                                                                    </p>
                                                                </x-dropdown-link>
                                                                <x-dropdown-link>
                                                                    <p class="flex justify-between" type="button"
                                                                        data-modal-toggle="popup-modal-comment-{{ $comment->id }}-del">
                                                                        {{ 'Smazat' }}
                                                                        <i class="fa-solid fa-trash pr-4 pt-0.5"></i>
                                                                    </p>
                                                                </x-dropdown-link>
                                                            </x-slot>

                                                        </x-dropdown>
                                                    </div>
                                                @endif
                                            </div>
                                            <x-modal :id="$comment->id" type="comment" :content="$comment->content" function="add">
                                            </x-modal>
                                            <x-modal :id="$comment->id" type="comment" :content="$comment->content" function="del">
                                            </x-modal>
                                            <p>{{ $comment->content }}</p>
                                        @endforeach

                                        <form action="/add" method="POST" class="p-4 flex justify-between">
                                            @csrf
                                            <textarea class="p-2 min-h-60 min-w-60 h-wax w-max resize-none rounded-md bg-slate-100" id="content" name="content"></textarea>
                                            <input type="hidden" id="post_id" name="post_id"
                                                value="{{ $post->id }}">
                                            <input type="hidden" id="user_id" name="user_id"
                                                value="{{ Auth::user()->id }}">
                                            <input type="hidden" id="workingWith" name="workingWith" value="comment">
                                            <input type="submit" value="Přidat komentář" type="button"
                                                class="p-2 rounded-md border border-1 border-slate-300">
                                        </form>

                                    </div>
                                </div>
                                
                            </div>
                            <div>
                                <p class="pt-8 text-slate-600 italic">
                                    Nahráno {{ $post->created_at->format('d. m. Y ') }} v
                                    {{ $post->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </x-app-layout>
@endif
