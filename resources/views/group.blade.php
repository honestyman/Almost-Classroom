@if (isset($site))
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between">
                <div>
                    <button id="dropdownDefault" data-dropdown-toggle="dropdownGroups"
                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                        type="button">Skupiny <i class="fa-solid fa-caret-down ml-2"></i></button>
                    <div id="dropdownGroups"
                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                            <li>
                                <a href="/dashboard"
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
                        @if (Auth::user()->id == $site->user_id)
                            {{ $site->invite_key }}
                        @endif
                    </h2>
                </div>
                <div>
                    <button id="dropdownDefault" data-dropdown-toggle="dropdownThisGroup"
                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                        type="button"><i class="fa-solid fa-caret-down mr-2"></i>{{ $site->name }}</button>
                    <div id="dropdownThisGroup"
                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                            <li>
                                <a href="/group/{{ $site->id }}"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Úkoly</a>
                            </li>
                            <li>
                                <a href="/group/{{ $site->id }}/users"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Členové</a>
                            </li>
                        </ul>
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
                                        class="py-5 px-4 mx-auto max-w-screen-xl text-gray-900 dark:text-white sm:grid-cols-2 md:px-6">
                                        <form action="/add" method="POST" class="grid grid-cols-2">
                                            @csrf
                                            <div>
                                                <input type="text" id="name" name="name"
                                                    class="mb-2 sm:mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Název úkolu" required maxlength="32">
                                                <textarea name="content" id="content" rows="10" cols="20"
                                                    class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 resize-none"
                                                    placeholder="Úkol" maxlength="256"></textarea>
                                                <input type="hidden" id="group_id" name="group_id"
                                                    value="{{ $site->id }}">
                                                <input type="hidden" id="user_id" name="user_id"
                                                    value="{{ Auth::user()->id }}">
                                                <input type="hidden" id="workingWith" name="workingWith"
                                                    value="post">
                                            </div>
                                            <div class="flex flex-col ml-4">
                                                <select required name="type" id="type"
                                                    class="block mb-2 sm:mb-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="" disabled selected>Zvolte typ úkolu</option>
                                                    <option value="1">Pouze odkliknutí 'Splněno'</option>
                                                    <option value="2">'Splněno' doplněno textovým polem</option>
                                                </select>
                                                <div class="py-2 my-2">
                                                    <input type="checkbox" id="deadline_switcher"
                                                        onclick="selectItem(this.checked)"
                                                        class="mb-0.5 w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="deadline_switcher">S termínem odevzdání</label>
                                                </div>
                                                <input type="datetime-local" id="deadline" name="deadline"
                                                    class="hidden p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <div class="flex justify-end mt-auto align-bottom">
                                                    <button type="submit"
                                                        class="inline-flex justify-center p-2 mt-4 text-slate-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                                        <svg aria-hidden="true" class="w-6 h-6 rotate-90"
                                                            fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                                            </path>
                                                        </svg>Přidat Úkol</button>
                                                </div>
                                            </div>
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
            <div class="pt-6 sm:pt-8 pb-6">
                <div class="mx-0 sm:mx-5">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                        <div class="p-2 sm:p-4 bg-white border-b border-gray-200"
                            onmouseover="this.style.cursor='pointer'"
                            onclick="window.location='{{ $post->group->id }}/post/{{ $post->id }}'"">
                            <div class="grid grid-cols-1 md:grid-cols-3">
                                <div class="flex justify-start p-3">
                                    <b class="text-xl">{{ $post->name }}</b>
                                </div>

                                <div class="text-slate-600 italic p-3 align-middle flex justify-center">
                                    @if (isset($post->deadline) || $post->deadline != null)
                                        Termín odevzdání 
                                        @if (date('d. m. Y H:i') > date_create_from_format('Y-m-d H:i:s', $post->deadline)->format('d. m. Y H:i'))
                                            byl
                                            @else
                                            je
                                        @endif
                                        {{ date_create_from_format('Y-m-d H:i:s', $post->deadline)->format('d. m. Y ') }}
                                        ve {{ date_create_from_format('Y-m-d H:i:s', $post->deadline)->format('H:i') }}
                                    @else
                                        Bez termínu odevzdání
                                    @endif
                                </div>

                                <div class="flex justify-end align-middle">
                                    @foreach ($post->postusers as $postuser)
                                        @if ($postuser->user_id == Auth::user()->id and $postuser->post_id == $post->id)
                                            @if ($postuser->finished == 1)
                                                @if (isset($post->deadline) || $post->deadline != null)
                                                    @if (date_create_from_format('Y-m-d H:i:s', $postuser->updated_at)->format('d. m. Y H:i') > date_create_from_format('Y-m-d H:i:s', $post->deadline)->format('d. m. Y H:i'))
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
                                        @break
                                    @endif
                                    @if ($loop->remaining == 0 and $postuser->user_id != Auth::user()->id)
                                        <i class="fa-solid fa-square-xmark text-5xl text-red-600 mr-2"></i>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
    </div>

</x-app-layout>

<script>
    function selectItem(isChecked) {
        if (isChecked) {
            document.getElementById('deadline').style.display = "block";
        } else {
            document.getElementById('deadline').style.display = "none";
        }
    }
</script>

@endif
