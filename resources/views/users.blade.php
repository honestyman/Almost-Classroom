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

        <div class="py-6 sm:pt-8">
            <div class="mx-0 sm:mx-5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6 bg-white border-b border-gray-200">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-2xl sm:text-xl md:text-lg">
                            @foreach ($site->users as $user)
                                <a href="/user/{{ $user->id }}" class="flex justify-center">
                                    <img src="{{ asset('/storage/images/' . $user->image) }}"
                                        class="h-10 sm:h-8 md:h-6 w-10 sm:w-8 md:w-6 mx-2 rounded-full object-cover"
                                        alt="username" />{{ $user->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>




    </x-app-layout>
@endif
