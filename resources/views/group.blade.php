@if (isset($site))
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{$site->name}}
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
                                    <a href="/group/{{$group->id}}"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $group->name }}</a>
                                </li>
                            @endforeach
                    </div>
                </div>
            </div>


        </x-slot>
    </x-app-layout>
@endif
