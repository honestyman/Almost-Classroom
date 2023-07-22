@if (isset($group))
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between">
                <div>
                    <button id="dropdownDefault" data-dropdown-toggle="dropdownGroups"
                        class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-200 hover:text-gray-700 dark:hover:text-white hover:border-gray-300 focus:outline-none focus:text-gray-700 dark:focus:text-white focus:border-gray-300 transition duration-150 ease-in-out"
                        type="button">Skupiny <i class="fa-solid fa-caret-down ml-2"></i></button>
                    <div id="dropdownGroups"
                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                            <li>
                                <a href="{{ route('home') }}"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Všechny
                                    skupiny</a>
                            </li>
                            @foreach (auth()->user()->groups as $group)
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
                        @if (Auth::id() == $group->user_id || Auth::user()->admin == 1)
                            {{ $group->invite_key }}
                        @endif
                    </h2>
                </div>
                <div>
                    <button id="dropdownDefault" data-dropdown-toggle="dropdownThisGroup"
                        class="flex items-center text-sm font-medium text-gray-500 dark:text-slate-300 hover:text-gray-700 dark:hover:text-white hover:border-gray-300 focus:outline-none focus:text-gray-700 dark:focus:text-white focus:border-gray-300 transition duration-150 ease-in-out"
                        type="button"><i class="fa-solid fa-caret-down mr-2"></i>{{ $group->name }}</button>
                    <div id="dropdownThisGroup"
                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                            <li>
                                <a href="/group/{{ $group->id }}"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Úkoly</a>
                            </li>
                            <li>
                                <a href="/group/{{ $group->id }}/users"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Členové</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </x-slot>

        <div class="py-6 sm:pt-8">
            <div class="mx-0 sm:mx-5">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6 border-b border-gray-200 dark:border-0">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-2xl sm:text-xl md:text-lg">
                            @foreach ($group->users as $user)
                                <a href="/user/{{ $user->id }}" class="flex justify-center">
                                    <img src="{{ $user->image ? asset('storage/images/' . $user->image) : asset('storage/images/default.svg') }}"
                                        class="h-10 sm:h-8 md:h-6 w-10 sm:w-8 md:w-6 mx-2 md:mt-0.5 rounded-full object-cover"
                                        alt="username" /><span class="mt-0.5 md:mt-0">{{ $user->name }}</span></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </x-app-layout>
@endif
