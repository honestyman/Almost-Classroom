@if (isset($group))
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between">
                <div>
                    <div>
                        @if ($user->groups_count >= 5)
                            <x-dropdown align="left" width="40">
                                <x-slot name="trigger">
                                    <button
                                        class="flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div class="text-xl"><i class="fa-solid fa-caret-down mr-2"></i>Vaše skupiny</div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    @foreach ($user->groups as $groupp)
                                        <x-dropdown-link href="{{ route('group.show', $groupp->id) }}">
                                            <div class="flex justify-between hover:cursor-pointer">
                                                <p class="flex justify-between">
                                                    {{ $groupp->name }}
                                                </p>
                                            </div>
                                        </x-dropdown-link>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>
                        @else
                            <div>
                                <h2 class="font-semibold text-xl leading-tight">
                                    Vaše skupiny
                                </h2>
                            </div>
                            <div class="flex flex-col md:flex-row py-4">
                                @foreach ($user->groups as $group)
                                    <div class="flex justify-center p-2 items-center">
                                        <form action="{{ route('group.show', $group->id) }}">
                                            @csrf
                                            <button type="submit"
                                                class="inline-block px-6 py-2 w-32 bg-gray-200 dark:bg-gray-700 font-medium leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:dark:bg-gray-800 hover:shadow-lg focus:bg-gray-300 focus:dark:bg-gray-800 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:dark:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out">{{ $group->name }}</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col md:flex-row py-4">
                        <x-dropdown align="left" width="24">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 hover:border-gray-300 dark:hover:text-white dark:focus:text-white focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div class="text-medium"><i
                                            class="fa-solid fa-caret-down mr-2"></i>{{ $group->name }}</div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="/group/{{ $group->id }}">
                                    <div class="flex justify-between hover:cursor-pointer">
                                        <p class="flex justify-between">
                                            {{ __('Úkoly') }}
                                        </p>
                                    </div>
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('group.user.index', $group->id) }}">
                                    <div class="flex justify-between hover:cursor-pointer">
                                        <p class="flex justify-between">
                                            {{ __('Členové') }}
                                        </p>
                                    </div>
                                </x-dropdown-link>
                                <x-dropdown-link onclick="showInvite()">
                                    <div class="flex justify-between hover:cursor-pointer">
                                        <p class="flex justify-between">
                                            {{ __('Pozvat') }}
                                        </p>
                                    </div>
                                </x-dropdown-link>
                                @can('delete', $group)
                                    <x-dropdown-link>
                                        <div class="flex justify-between hover:cursor-pointer" type="button"
                                        onclick="Livewire.emit('openModal', 'destroy-group', {{ json_encode(['group' => $group]) }})">
                                            <p class="flex justify-between">
                                                {{ __('Smazat') }}
                                            </p>
                                        </div>
                                    </x-dropdown-link>
                                @endcan
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>

                <div>
                    <div class="block md:flex flex-col md:flex-row justify-between">
                        <div class="mx-2 py-2">
                            <label for="search"
                                class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Vyhledat
                                obsah</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-4 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="search" name="search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full h-10 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Vyhledat">
                            </div>
                        </div>
                        <div class="mx-2 py-2">
                            <label for="sort"
                                class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Třídit
                                obsah podle</label>
                            <select id="sort" name="sort"
                                class="p-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="1">Od nejstaršího</option>
                                <option value="2" selected>Od nejnovějšího</option>
                                <option value="3">Nejvzdálenější termín odevzdání</option>
                                <option value="4">Nejbližší termín odevzdání</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="slot">
            @can('delete', $group)
                <div class="pt-6 sm:pt-8">
                    <div class="mx-0 sm:mx-5">
                        <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-4 sm:p-6 border-b dark:border-0 border-gray-200">
                                <div>
                                    <button id="mega-menu-full-dropdown-button"
                                        data-collapse-toggle="mega-menu-full-dropdown"
                                        class="flex justify-between items-center py-2 pr-4 pl-3 w-full font-medium rounded md:w-auto hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">Vytvořit
                                        nový úkol
                                        <svg class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg></button>
                                    <div id="mega-menu-full-dropdown"
                                        class="hidden mt-1 transition ease-in-out duration-200 bg-gray-50 border-gray-200 shadow-sm border-y dark:bg-gray-800 dark:border-gray-600">
                                        <div
                                            class="py-5 px-4 mx-auto max-w-screen-xl text-gray-900 dark:text-white sm:grid-cols-2 md:px-6">
                                            <form action="{{ route('group.post.store', $group->id) }}" method="POST"
                                                class="grid grid-cols-2">
                                                @csrf
                                                <div>
                                                    <input type="text" id="name" name="name"
                                                        class="mb-2 sm:mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Název úkolu" required maxlength="32">
                                                    <textarea name="content" id="content" rows="10" cols="20"
                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 resize-none"
                                                        placeholder="Úkol" maxlength="1023"></textarea>
                                                </div>
                                                <div class="flex flex-col ml-4">
                                                    <select required name="type" id="type"
                                                        class="block mb-2 sm:mb-4 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        <option value="" disabled selected>Zvolte typ úkolu
                                                        </option>
                                                        <option value="0">Bez odevzdání</option>
                                                        <option value="1">Pouze odkliknutí 'Splněno'</option>
                                                        <option value="2">'Splněno' doplněno textovým polem
                                                        </option>
                                                    </select>
                                                    <div class="py-2 my-2">
                                                        <input type="checkbox" id="deadline_switcher"
                                                            onclick="selectItem(this.checked)"
                                                            class="mb-0.5 w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="deadline_switcher" class="ml-1">S termínem
                                                            odevzdání</label>
                                                    </div>
                                                    <input type="datetime-local" id="deadline" name="deadline"
                                                        class="hidden p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <div class="flex justify-end mt-auto align-bottom">
                                                        <button type="submit"
                                                            class="inline-flex justify-center text-lg p-2 px-4 mt-4 bg-gray-200 text-slate-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-slate-300 dark:hover:bg-gray-600 dark:bg-gray-700">
                                                            Přidat Úkol</button>
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
            @endcan

            <div class="obsah" id="orderContent">
                @include('app.post.index')
            </div>
            <center>
                <div class="lds-ring mt-32 sm:mt-40 md:mt-56" id="loadingImage">
                </div>
            </center>

            <div id="toast-bottom-right"
                class="transition ease-in-out duration-200 absolute flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-gray-50 divide-x divide-gray-200 rounded-lg shadow right-5 bottom-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
                role="alert"
                style="visibility: hidden; transition: visibility 0s, opacity 0.5s linear; opacity: 0;">
                <div class="flex w-full">
                    <div class="text-sm font-normal">
                        <p>Kód pro připojení je:</p>
                        <p><b>{{ $group->invite_key }}</b></p>
                    </div>
                    <div class="flex items-center ml-auto space-x-2">
                        <button type="button"
                            class="bg-gray-50 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
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


        </x-slot>

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

    <script>
        $(document).ready(function() {
            var sort = $('#sort').val();
            var groups = $('#groups').val();
            var search = $('#search').val();
            var address = {{ $group->id }};
            fetch_customer_data(sort, groups, search, address);

            function fetch_customer_data(sort = '', groups = '', search = '', address = '', url) {
                $.ajax({
                    url: "{{ route('sort') }}",
                    method: 'GET',
                    data: {
                        sort: sort,
                        groups: groups,
                        search: search,
                        address: address,
                    },
                    beforeSend: function() {
                        $('#loadingImage').show();
                        $('#orderContent').hide();
                    },
                    complete: function() {
                        $('#loadingImage').hide();
                    },
                    success: function(data) {
                        $('.obsah').html(data);
                        $('#orderContent').show();
                    }
                });
            }
            $(document).on('change', '#sort, #groups', function() {
                sort = $('#sort').val();
                groups = $('#groups').val();
                search = $('#search').val();
                fetch_customer_data(sort, groups, search, address);
            });
            $(document).on('input', '#search', function() {
                sort = $('#sort').val();
                groups = $('#groups').val();
                search = $('#search').val();
                fetch_customer_data(sort, groups, search, address);
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $('body').on('click', '#pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var sort = $('#sort').val();
                var groups = $('#groups').val();
                var search = $('#search').val();
                var address = {{ $group->id }};
                getArticles(sort, groups, search, address, url);
            });

            function getArticles(sort = '', groups = '', search = '', address = '', url) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        sort: sort,
                        groups: groups,
                        search: search,
                        address: address,
                    },
                    beforeSend: function() {
                        $('#loadingImage').show();
                        $('#orderContent').hide();
                    },
                    complete: function() {
                        $('#loadingImage').hide();
                    },
                    success: function(data) {
                        $('.obsah').html(data);
                        $('#orderContent').show();
                    },
                });
            }
        });
    </script>

@endif
