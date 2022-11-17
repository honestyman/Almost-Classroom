@if (isset($user))
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
            </div>
        </x-slot>

        <div class="py-6 sm:pt-8 max-w-5xl mx-auto">
            <div class="mx-0 sm:mx-5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-8 bg-white border-b border-gray-200">
                        <div class="flex justify-start p-1 md:p-10">
                            <img src="https://images.pexels.com/photos/3278968/pexels-photo-3278968.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                                class="h-24 md:h-80 w-24 md:w-80 rounded-full object-cover mt-6 md:mt-0" alt="username" />
                            <div class="mx-auto my-2 md:my-8">
                                <div class="flex justify-end md:justify-start items-center">
                                    <h2 class="block leading-relaxed font-light text-gray-700 text-4xl md:text-5xl">
                                        {{ $user->name }}</h2>
                                </div>
                                <ul class="flex justify-end md:justify-start items-center pl-0 p-1 md:p-4">
                                    <li>
                                        <span class="block text-base"><span
                                                class="font-bold mr-1">{{ $user->posts->count() }}</span>
                                            @if ($user->posts->count() == 1)
                                                úkol
                                            @endif
                                            @if ($user->posts->count() >= 2 && $user->posts->count() <= 4)
                                                úkoly
                                            @endif
                                            @if ($user->posts->count() > 4)
                                                úkolů
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <span class="block text-base ml-5"><span
                                                class="font-bold mr-1">{{ $user->groups->count() }}</span>
                                            @if ($user->groups->count() == 1)
                                                skupina
                                            @endif
                                            @if ($user->groups->count() >= 2 && $user->groups->count() <= 4)
                                                skupiny
                                            @endif
                                            @if ($user->groups->count() > 4)
                                                skupin
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                                <a class="text-base flex justify-end md:justify-start" href="mailto:{{$user->email}}">{{$user->email}}</a>
                                <br>
                                <div class="flex justify-end max-w-md">
                                    <span class="text-base hidden md:block">{{$user->bio}}</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="flex justify-end">
                            <span class="text-base block md:hidden">{{$user->bio}}</span>
                        </div>

                    </div>
                </div>
            </div>




    </x-app-layout>
@endif
