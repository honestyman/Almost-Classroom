@if (isset($post))
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between">
                <div>
                    <button id="dropdownDefault" data-dropdown-toggle="dropdownGroups"
                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                        type="button"><i class="fa-solid fa-caret-down mr-2"></i>Skupiny</button>
                    <div id="dropdownGroups"
                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                            <li>
                                <a href="/"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Všechny
                                    skupiny</a>
                            </li>
                            @foreach (Auth::user()->groups as $group)
                                <li>
                                    <a href="/group/{{ $group->id }}"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $group->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div>
                    <h2>
                        @if (Auth::user()->id == $post->group->user_id || Auth::user()->admin == 1)
                            {{ $post->group->invite_key }}
                        @endif
                    </h2>
                </div>
                <div>
                    <button id="dropdownDefault" data-dropdown-toggle="dropdownThisGroup"
                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                        type="button">{{ $group->name }}<i class="fa-solid fa-caret-down ml-2"></i></button>
                    <div id="dropdownThisGroup"
                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                            <li>
                                <a href="/group/{{ $post->group->id }}"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Úkoly</a>
                            </li>
                            <li>
                                <a href="/group/{{ $post->group->id }}/users"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Členové</a>
                            </li>
                            <li>
                                <a onclick="showInvite()" href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pozvat</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </x-slot>

        <!-- ZDE SE NACHAZI "ADMIN" STRANKA PRO ZOBRAZENI ODEVZDANYCH PRACI -->
        @if (Auth::user()->id == $post->user_id || Auth::user()->admin == 1)
            <!-- ČÁST PRO UŽIVATELE A JEJICH ÚKOLY-->
            <div class="py-6 sm:pt-8">
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
                                    </div>
                                    <div
                                        class="p-2 border-b-2 sm:border-b-0 border-slate-500 text-lg text-justify break-all">
                                        {{ $post->content }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($post->type != 0)
                <div class="py-6 sm:pt-8">
                    <div class="mx-0 sm:mx-5">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="bg-white border-b border-gray-200">
                                <div class="grid grid-cols-1 sm:grid-cols-3">
                                    @php
                                        $finished_users = 0;
                                    @endphp
                                    @foreach ($post->postusers as $postuser)
                                        @if ($postuser->finished == 1)
                                            @php
                                                $finished_users++;
                                            @endphp
                                            <div class="p-4 sm:p-6 odd:bg-white even:bg-slate-50">
                                                <a href="/user/{{ $postuser->user->id }}" class="flex justify-center">
                                                    <img src="{{ asset('/storage/images/' . $postuser->user->image) }}"
                                                        class="h-10 w-10 mr-2 md:mr-3 rounded-full object-cover"
                                                        alt="username" />
                                                    <span class="my-auto text-lg">
                                                        {{ $postuser->user->name }}
                                                    </span>
                                                </a>
                                                <p class="pt-4 flex justify-center">
                                                    @if ($postuser->post->type == 1)
                                                        @if ($postuser->post_answer == null)
                                                            <span>Odevzdáno</span>
                                                        @endif
                                                    @else
                                                        <span>{{ $postuser->post_answer }}</span>
                                                    @endif
                                                </p>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if ($finished_users < 1)
                                        </div>
                                        <div class="flex justify-center p-4 sm:p-6 bg-white">
                                            <h2>Nikdo nic neodevzdal!</h2>
                                        </div>
                                        @if ($finished_users % 3 != 0)
                                        <div class="p-4 sm:p-6 odd:bg-white even:bg-slate-50">
                                        </div>
                                        @endif
                                    @else
                                        </div>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- ČÁST PRO KOMENTÁŘE-->
            <div class="py-6 sm:pt-8">
                <div class="mx-0 sm:mx-5">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="bg-white border-b border-gray-200">
                            <div class="grid grid-cols-1">
                                @foreach ($post->comments as $comment)
                                    <div class="flex justify-start">
                                        <div class="px-6 py-3">
                                            <div class="flex">
                                                <b class="mr-2">{{ $comment->user->name }}</b>
                                                <!-- TADY JE ROZKLIKAVACI MENU NA MAZANI & UPRAVU KOMENTÁŘŮ-->
                                                @if (Auth::user()->id == $comment->user_id || Auth::user()->admin == 1)
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
                                            <x-modal :id="$comment->id" type="comment" :content="$comment->content" function="add">
                                            </x-modal>
                                            <x-modal :id="$comment->id" type="comment" :content="$comment->content" function="del">
                                            </x-modal>
                                            <p>{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="p-4">
                                    <form action="/add" method="POST" class="mt-2">
                                        @csrf
                                        <input type="hidden" id="post_id" name="post_id"
                                            value="{{ $post->id }}">
                                        <input type="hidden" id="user_id" name="user_id"
                                            value="{{ Auth::user()->id }}">
                                        <input type="hidden" id="workingWith" name="workingWith" value="comment">
                                        <div class="flex items-center py-2 rounded-lg dark:bg-gray-700">
                                            <textarea name="content" id="content" rows="1"
                                                class="block p-2.5 w-full text-sm bg-gray-50 text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Přidejte komentář"></textarea>
                                            <button type="submit"
                                                class="inline-flex justify-center p-2 text-slate-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                                <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                    </div>
                </div>
            </div>
        @else
            <div class="py-6 sm:pt-8">
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
                                    </div>
                                    <div
                                        class="p-2 border-b-2 sm:border-b-0 border-slate-500 text-lg text-justify break-all">
                                        {{ $post->content }}
                                    </div>
                                </div>

                                @if ($post->type != 0)
                                <div class="my-3 max-h-80 sm:max-h-100 sm:h-80 sm:col-span-2">
                                    <div class="max-h-80 sm:h-80 overflow-auto">
                                        <div class="sm:mr-6 flex">
                                            <form method="POST" action="/finished" class="w-full">
                                                @csrf
                                                <input type="hidden" id="post_id" name="post_id"
                                                    value="{{ $post->id }}">
                                                <input type="hidden" id="user_id" name="user_id"
                                                    value="{{ Auth::user()->id }}">
                                                <div class="flex justify-center md:justify-end mt-2">
                                                    @foreach ($post->postusers as $postuser)
                                                        @if ($postuser->user_id == Auth::user()->id and $postuser->post_id == $post->id)
                                                            @if ($postuser->finished == 1)
                                                                @php $finished = 1 @endphp
                                                                <input type="hidden" id="finished" name="finished"
                                                                    value="0">
                                                                <button type="submit"
                                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                                                    onChange="this.form.submit()">
                                                                    Zrušit odevzdání
                                                                </button>
                                                            @else
                                                                @php $finished = 0 @endphp
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
                                                        @php $finished = 0 @endphp
                                                        <input type="hidden" id="finished" name="finished"
                                                            value="1">
                                                        <button type="submit"
                                                            class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                                            onChange="this.form.submit()">
                                                            Odevzdat
                                                        </button>
                                                    @endif
                                                @endforeach
                                            </div>
                                                @if ($post->type == 2)
                                                    <div class="flex justify-center md:justify-end">
                                                        <textarea name="post_answer" rows="6"
                                                            class="block p-2.5 mt-4 w-10/12 text-sm bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            @if ($finished == 1) disabled @endif placeholder="Odpověď k úkolu..." required>@if($postuser->post_answer != ''){{ $postuser->post_answer }}@endif</textarea>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                        </div>
                        <div class="flex justify-between">
                            <div class="text-slate-600 italic text-left">
                                {{ $post->user->name }} zveřejnil {{ $post->created_at->format('d. m. Y ') }}
                                v
                                {{ $post->created_at->format('H:i') }} @if ($post->created_at != $post->updated_at)
                                    (Upraveno {{ $post->updated_at->format('d. m. Y ') }} v
                                    {{ $post->updated_at->format('H:i') }})
                                @endif
                            </div>
                            <div class="text-slate-600 italic text-right">
                                @if (isset($post->deadline))
                                    Termín odevzdání je
                                    {{ date_create_from_format('Y-m-d H:i:s', $post->deadline)->format('d. m. Y ') }}
                                    ve
                                    {{ date_create_from_format('Y-m-d H:i:s', $post->deadline)->format('H:i') }}
                                    @if (date('d. m. Y H:i') > date_create_from_format('Y-m-d H:i:s', $post->deadline)->format('d. m. Y H:i'))
                                        pozdě
                                    @endif
                                @else
                                    Bez termínu odevzdání
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 sm:p-6 pb-6 sm:pb-8 bg-white border-b border-gray-200">
                            <!-- KOMENTÁŘOVÁ ČÁST POSTU -->
                            @foreach ($post->comments as $comment)
                                <div class="flex justify-start">
                                    <div class="pb-4 ">
                                        <div class="flex">
                                            <b class="mr-2">{{ $comment->user->name }}</b>
                                            <!-- TADY JE ROZKLIKAVACI MENU NA MAZANI & UPRAVU KOMENTÁŘŮ-->
                                            @if (Auth::user()->id == $comment->user_id || Auth::user()->admin == 1)
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
                                    </div>
                                </div>
                            @endforeach
                            <form action="/add" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" id="post_id" name="post_id"
                                    value="{{ $post->id }}">
                                <input type="hidden" id="user_id" name="user_id"
                                    value="{{ Auth::user()->id }}">
                                <input type="hidden" id="workingWith" name="workingWith" value="comment">
                                <div class="flex items-center py-2 rounded-lg dark:bg-gray-700">
                                    <textarea name="content" id="content" rows="1"
                                        class="block p-2.5 w-full text-sm bg-gray-50 text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Přidejte komentář"></textarea>
                                    <button type="submit"
                                        class="inline-flex justify-center p-2 text-slate-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                        <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
            </div>
    @endif

    <div id="toast-bottom-right"
        class="transition ease-in-out duration-400 absolute flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow right-5 bottom-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
        role="alert" style="visibility: hidden; transition: visibility 0s, opacity 0.5s linear; opacity: 0;">
        <div class="flex w-full">
            <div class="text-sm font-normal">
                <p>Kód pro připojení je:</p>
                <p><b>{{ $post->group->invite_key }}</b></p>
            </div>
            <div class="flex items-center ml-auto space-x-2">
                <button type="button"
                    class="bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    onclick="hideInvite()" aria-label="Zavřít">
                    <span class="sr-only">Zavřít</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>


</x-app-layout>
@endif
