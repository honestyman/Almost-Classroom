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

        <div class="py-6 sm:pt-8 max-w-xs sm:max-w-xl md:max-w-5xl mx-auto">
            <div class="mx-0 sm:mx-5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-8 bg-white border-b border-gray-200">
                        <div class="flex flex-col-reverse sm:flex-row justify-start p-1 md:p-10">
                            <div class="flex justify-center">
                                <img src="https://images.pexels.com/photos/3278968/pexels-photo-3278968.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                                class="h-48 sm:h-60 md:h-80 w-48 sm:w-60 md:w-80 rounded-full object-cover mt-6 md:mt-0"
                                alt="username" />
                            </div>
                            <div class="mx-auto my-2 md:my-8 mr-4">
                                <div class="flex justify-center md:justify-start items-center">
                                    <h2 class="block leading-relaxed font-light text-gray-700 text-4xl md:text-5xl">
                                        <a href="mailto:{{ $user->email }}">{{ $user->name }}</a></h2>
                                </div>
                                <ul class="flex justify-center md:justify-start items-center pl-0 p-1 md:p-4">
                                    <li>
                                        <span class="block text-base"><span
                                                class="font-bold mr-1">{{ count($hotove_prispevky) }}</span>
                                            @if (count($hotove_prispevky) == 1)
                                                hotový úkol
                                            @endif
                                            @if (count($hotove_prispevky) >= 2 && count($hotove_prispevky) <= 4)
                                                hotové úkoly
                                            @endif
                                            @if (count($hotove_prispevky) > 4 || count($hotove_prispevky) == 0)
                                                hotových úkolů
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <span class="block text-base ml-5"><span
                                                class="font-bold mr-1">{{ count($private_skupiny) }}</span>
                                            @if (count($private_skupiny) == 1)
                                                soukromá skupina
                                            @endif
                                            @if (count($private_skupiny) >= 2 && count($private_skupiny) <= 4)
                                                soukromé skupiny
                                            @endif
                                            @if (count($private_skupiny) > 4 || count($private_skupiny) == 0)
                                                soukromých skupin
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                                <div class="flex justify-between hover:cursor-pointer mt-4 mx-2" type="button"
                                    data-modal-toggle="popup-modal-bio-{{ $user->id }}">
                                    <i class="fa-solid fa-pen pr-4 pt-2"></i>
                                    <span class="text-base block max-w-sm">{{ $user->bio }}</span>
                                </div>
                                
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div id="popup-modal-bio-{{ $user->id }}" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center"
            aria-hidden="true">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="popup-modal-bio-{{ $user->id }}">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="p-6 text-center">
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Upravit?<i
                                class="fa-solid fa-pen pl-4"></i></h3>

                        <form action="/add" method="POST" class="p-4">
                            @csrf
                            <textarea name="content" id="content" rows="4" cols="20"
                                class="block p-2.5 mb-5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 resize-none"
                                required>{{ $user->bio }}</textarea>
                            <input type="hidden" id="workingWith" name="workingWith" value="bio">
                            <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                            <button data-modal-toggle="popup-modal-bio-{{ $user->id }}" type="submit"
                                class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Ano, upravit
                            </button>
                            <button data-modal-toggle="popup-modal-bio-{{ $user->id }}" type="button"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Ne,
                                zrušit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
