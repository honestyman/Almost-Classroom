<x-app-layout>
    <x-slot name="header">
        @if (isset($user))
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Vaše skupiny
                    </h2>
                    <div class="flex flex-col md:flex-row py-4">
                        @if ($user->groups->count() >= 5)
                            <button id="dropdownDefault" data-dropdown-toggle="dropdownGroups"
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                                type="button"><i class="fa-solid fa-caret-down mr-2"></i>Všechny skupiny</button>
                            <div id="dropdownGroups"
                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownDefault">
                                    @foreach ($user->groups as $group)
                                        <li>
                                            <a href="/group/{{ $group->id }}"
                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $group->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            @foreach ($user->groups as $group)
                                <div class="flex justify-center p-2 items-center">
                                    <form action="/group/{{ $group->id }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{ $group->id }}">
                                        <button type="submit"
                                            class="inline-block px-6 py-2 w-32 bg-gray-200 text-gray-700 font-medium leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">{{ $group->name }}</button>
                                    </form>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div>
                    <div class="block md:flex flex-col md:flex-row justify-between">
                        <div class="mx-2 py-2">
                            <label for="groups"
                                class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Zobrazení
                                skupin</label>
                            <select id="groups" name="groups"
                                class="p-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="1" selected>Všechny skupiny</option>
                                <option value="2">Pouze soukromé skupiny</option>
                                <option value="3">Pouze veřejné skupiny</option>
                            </select>
                        </div>
                        <div class="mx-2 py-2">
                            <label for="sort"
                                class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Třídit
                                obsah podle</label>
                            <select id="sort" name="sort"
                                class="p-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="1">Od nejstaršího</option>
                                <option value="2">Od nejnovějšího</option>
                                <option value="3">Nejvzdálenější termín odevzdání</option>
                                <option value="4" selected>Nejbližší termín odevzdání</option>
                                <option value="5">Názvu skupiny (A-Z)</option>
                                <option value="6">Názvu skupiny (Z-A)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mx-2">
                        <label for="simple-search" class="sr-only">Search</label>
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
                </div>
            </div>
        @endif

    </x-slot>

    <div class="obsah" id="orderContent">
        @include('posts')
    </div>
    <center>
        <div class="lds-ring mt-32 sm:mt-40 md:mt-56" id="loadingImage">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </center>

    <script>
        $(document).ready(function() {

            fetch_customer_data();

            function fetch_customer_data(sort = '', groups = '', search = '', url) {
                $.ajax({
                    url: "{{ route('sort') }}",
                    method: 'GET',
                    data: {
                        sort: sort,
                        groups: groups,
                        search: search,
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
                var sort = $('#sort').val();
                var groups = $('#groups').val();
                var search = $('#search').val();
                fetch_customer_data(sort, groups, search);
            });
            $(document).on('input', '#search', function() {
                var sort = $('#sort').val();
                var groups = $('#groups').val();
                var search = $('#search').val();
                fetch_customer_data(sort, groups, search);
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
                getArticles(sort, groups, search, url);
            });
            function getArticles(sort = '', groups = '', search = '', url) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        sort: sort,
                        groups: groups,
                        search: search,
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



</x-app-layout>
