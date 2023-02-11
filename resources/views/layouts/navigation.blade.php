<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="mx-4 md:mx-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-graduation-cap text-xl"></i>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Domů') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <i class="fa-solid fa-caret-down ml-1"></i>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link>
                            <div class="flex justify-between hover:cursor-pointer" type="button"
                                data-modal-toggle="popup-modal-group-add">
                                {{ 'Vytvořit skupinu' }}
                                <i class="fa-solid fa-user-group fa-fw pr-4 pt-0.5"></i>
                            </div>
                        </x-dropdown-link>
                        <x-dropdown-link>
                            <div class="flex justify-between hover:cursor-pointer" type="button"
                                data-modal-toggle="popup-modal-group-join">
                                {{ 'Připojit do skupiny' }}
                                <i class="fa-solid fa-user-plus fa-fw pr-4 pt-0.5"></i>
                            </div>
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('user', Auth::id()) }}">
                            <div class="flex justify-between hover:cursor-pointer">
                                <p class="flex justify-between">
                                    {{ __('Profil') }}
                                </p>
                                <i class="fa-solid fa-user fa-fw pr-4 pt-0.5"></i>
                            </div>
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <p class="flex justify-between">
                                    {{ __('Odhlásit') }}
                                    <i class="fa-solid fa-user-minus fa-fw pr-4 pt-0.5"></i>
                                </p>
                            </x-dropdown-link>

                        </form>

                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div>
                <div class="hover:cursor-pointer block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
                    type="button" onclick="window.location='/user/{{ Auth::id() }}'">
                    <div class="font-medium text-base">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

            </div>
            <div class="mt-3 space-y-1 hover:cursor-pointer">
                <div class="hover:cursor-pointer block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
                    type="button" data-modal-toggle="popup-modal-group-add">
                    {{ 'Vytvořit skupinu' }}
                </div>
            </div>
            <div class="mt-3 space-y-1 hover:cursor-pointer">
                <div class="hover:cursor-pointer block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
                    type="button" data-modal-toggle="popup-modal-group-join">
                    {{ 'Připojit do skupiny' }}
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Odhlásit') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL K VYTVÁŘENÍ SKUPIN -->
    <div id="popup-modal-group-add" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center"
        aria-hidden="true">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="popup-modal-group-add">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="p-6 text-center">
                    <h3 class="mb-1 sm:mb-2 text-lg font-normal text-gray-500 dark:text-gray-400">Vytvořit novou
                        skupinu?<i class="fa-solid fa-people-group pl-4"></i></h3>

                    <form action="{{ route('group.add') }}" method="POST" class="p-4">
                        @csrf
                        <input
                            class="p-2 h-12 w-max rounded-md mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            type="text" id="name" name="name" required placeholder="Název skupiny">
                        <div class="flex justify-center mb-4">
                            <input type="checkbox" value="1" id="public" name="public"
                                class="mt-1 appearance-none checked:bg-green-500" />
                            <i class="pl-2">Veřejná skupina</i>
                        </div>
                        <button data-modal-toggle="popup-modal-group-add" type="submit"
                            class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Ano, vytvořit
                        </button>
                        <button data-modal-toggle="popup-modal-group-add" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Ne,
                            zrušit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL K PŘIPOJOVÁNÍ DO SKUPIN -->
    <div id="popup-modal-group-join" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center"
        aria-hidden="true">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="popup-modal-group-join">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="p-6 text-center">
                    <h3 class="mb-1 sm:mb-2 text-lg font-normal text-gray-500 dark:text-gray-400">Připojit se do nové
                        skupiny?<i class="fa-solid fa-people-group pl-4"></i></h3>
                    <form action="{{ route('group.join') }}" method="POST" class="p-4">
                        @csrf
                        <input type="text" id="invite_key" name="invite_key"
                            class="mb-4 sm:mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Kód pro připojení do skupiny" required>
                        <button data-modal-toggle="popup-modal-group-join" type="submit"
                            class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Ano, připojit se
                        </button>
                        <button data-modal-toggle="popup-modal-group-join" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Ne,
                            zrušit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</nav>
