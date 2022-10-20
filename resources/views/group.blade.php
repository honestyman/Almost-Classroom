@if (isset($site))
    <x-app-layout>

        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $site->name }}
                </h2>
                <h2>
                    @if (Auth::user()->id == $site->user_id)
                        {{ $site->invite_key }}
                    @endif
                </h2>
                <div>

                    <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                        type="button">Skupiny <i class="fa-solid fa-caret-down ml-2"></i></button>
                    <div id="dropdown"
                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                            <li>
                                <a href="/test"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Všechny
                                    skupiny</a>
                            </li>
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

        @if (Auth::user()->id == $site->user_id)
            <div class="pt-6 sm:pt-8">
                <div class="mx-0 sm:mx-5">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 sm:p-6 bg-white border-b border-gray-200">
                            <div>
                                <button id="mega-menu-full-dropdown-button"
                                    data-collapse-toggle="mega-menu-full-dropdown"
                                    class="flex justify-between items-center py-2 pr-4 pl-3 w-full font-medium text-gray-700 rounded md:w-auto hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">Vytvořit
                                    nový úkol
                                    <svg class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg></button>
                                <div id="mega-menu-full-dropdown"
                                    class="hidden mt-1 bg-gray-50 border-gray-200 shadow-sm md:bg-white border-y dark:bg-gray-800 dark:border-gray-600">
                                    <div
                                        class="grid py-5 px-4 mx-auto max-w-screen-xl text-gray-900 dark:text-white sm:grid-cols-2 md:px-6">
                                        <form action="/add" method="POST">
                                            @csrf
                                            <input type="text" id="name" name="name"
                                                class="mb-2 sm:mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Název úkolu" required>
                                            <textarea name="content" id="content" rows="10" cols="20"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 resize-none"
                                                placeholder="Úkol" required></textarea>
                                            <input type="hidden" id="group_id" name="group_id"
                                                value="{{ $site->id }}">
                                            <input type="hidden" id="user_id" name="user_id"
                                                value="{{ Auth::user()->id }}">
                                            <input type="hidden" id="workingWith" name="workingWith" value="post">
                                            <button type="submit"
                                                class="inline-flex justify-center p-2 text-slate-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                                <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                                    </path>
                                                </svg>Přidat Úkol</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        @foreach ($site->posts as $post)
            <div class="pt-6 sm:pt-8">
                <div class="mx-0 sm:mx-5">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 sm:p-6 bg-white border-b border-gray-200">
                            <div class="sm:grid sm:grid-cols-5">
                                <!-- HLAVNÍ ČÁST POSTU -->
                                <div class="sm:col-span-3">
                                    <div class="flex">
                                        <p class="text-xl">
                                            <b>{{ $post->name }}</b>
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
                                                                        <i class="fa-solid fa-trash pr-4 pt-0.5"></i>
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
                                                </button>

                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>
                            <div class="flex justify-between">
                                <div class="text-slate-600 italic">
                                    {{ $post->user->name }} nahrál {{ $post->created_at->format('d. m. Y ') }} v
                                    {{ $post->created_at->format('H:i') }} @if ($post->created_at != $post->updated_at)
                                        (Upraveno {{ $post->updated_at->format('d. m. Y ') }} v
                                        {{ $post->updated_at->format('H:i') }})
                                    @endif
                                </div>
                                <div class="sm:mr-8">
                                    <form method="POST" action="/finished">
                                        @csrf
                                        <input type="hidden" id="post_id" name="post_id"
                                            value="{{ $post->id }}">
                                        <input type="hidden" id="user_id" name="user_id"
                                            value="{{ Auth::user()->id }}">
                                        @foreach ($post->postusers as $postuser)
                                            @if ($postuser->user_id == Auth::user()->id and $postuser->post_id == $post->id)
                                                @if ($postuser->finished == 1)
                                                    <input type="hidden" id="finished" name="finished"
                                                        value="0">
                                                    <button type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                                        onChange="this.form.submit()">
                                                        Zrušit odevzdání
                                                    </button>
                                                @else
                                                    <input type="hidden" id="finished" name="finished"
                                                        value="1">
                                                    <button type="submit"
                                                        class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                                        onChange="this.form.submit()">
                                                        Odevzdat
                                                    </button>
                                                @endif
                                            @break
                                        @endif
                                        @if ($loop->remaining == 0 and $postuser->user_id != Auth::user()->id)
                                            <input type="hidden" id="finished" name="finished" value="1">
                                            <button type="submit"
                                                class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                                onChange="this.form.submit()">
                                                Odevzdat
                                            </button>
                                        @endif
                                    @endforeach
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-app-layout>
@endif
