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
                                <a href="/"
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
            </div>
        </x-slot>

        <div class="py-6 sm:pt-8 max-w-xs sm:max-w-4xl md:max-w-7xl mx-auto">
            <div class="mx-0 sm:mx-5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-8 bg-white border-b border-gray-200">
                        <div class="flex flex-col-reverse sm:flex-row justify-start p-1 md:p-10">
                            <div class="flex justify-center">
                                @if (Auth::id() == $user->id || Auth::user()->admin == 1)
                                    <form action="{{ route('user.image.update', $user->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="workingWith" name="workingWith" value="image">
                                        <input type="file" name="image" id="image" class="hidden"
                                            onchange="this.form.submit()">
                                        <img src="{{ asset('storage/images/' . $user->image) }}"
                                            onclick="document.querySelector('input#image').click()"
                                            class="h-48 sm:h-60 md:h-80 w-48 sm:w-60 md:w-80 rounded-full object-cover mt-6 hover:cursor-pointer"
                                            alt="username" />
                                    </form>
                                @else
                                    <img src="{{ asset('storage/images/' . $user->image) }}"
                                        class="h-48 sm:h-60 md:h-80 w-48 sm:w-60 md:w-80 rounded-full object-cover mt-6"
                                        alt="username" />
                                @endif
                            </div>
                            <div class="sm:mx-auto my-2 md:my-8 px-4">
                                <div class="flex justify-center md:justify-start items-center">
                                    <h2 class="block leading-relaxed font-light text-gray-700 text-4xl md:text-5xl">
                                        <a href="mailto:{{ $user->email }}">{{ $user->name }}</a>
                                    </h2>
                                </div>
                                <ul class="flex justify-center md:justify-start items-center pl-0 p-1 md:p-4">
                                    <li>
                                        <span class="block text-base"><span
                                                class="font-bold mr-1">{{ $finished_post_count }}</span>
                                            @if ($finished_post_count == 1)
                                                hotový úkol
                                            @elseif ($finished_post_count >= 2 && $finished_post_count <= 4)
                                                hotové úkoly
                                            @elseif ($finished_post_count > 4 || $finished_post_count == 0)
                                                hotových úkolů
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <span class="block text-base ml-5"><span
                                                class="font-bold mr-1">{{ $private_group_count }}</span>
                                            @if ($private_group_count == 1)
                                                soukromá skupina
                                            @elseif ($private_group_count >= 2 && $private_group_count <= 4)
                                                soukromé skupiny
                                            @elseif ($private_group_count > 4 || $private_group_count == 0)
                                                soukromých skupin
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                                @if (Auth::id() == $user->id || Auth::user()->admin == 1)
                                    <div class="flex flex-row hover:cursor-pointer mt-4 mx-2" type="button"
                                        onclick="Livewire.emit('openModal', 'edit-user-bio', {{ json_encode(['user' => $user]) }})">
                                        <i class="fa-solid fa-pen pr-4 pt-2"></i>
                                        <span class="text-base block max-w-xs overflow-clip">{{ $user->bio }}</span>
                                    </div>
                                @else
                                    <span class="text-base block max-w-xs overflow-clip">{{ $user->bio }}</span>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </x-app-layout>
@endif
