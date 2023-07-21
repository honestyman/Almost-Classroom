<x-app-layout>
    <x-slot name="header">
        @if (isset($user))
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
                                    @foreach ($user->groups as $group)
                                        <x-dropdown-link href="{{ route('group.show', $group->id) }}">
                                            <div class="flex justify-between hover:cursor-pointer">
                                                <p class="flex justify-between">
                                                    {{ $group->name }}
                                                </p>
                                            </div>
                                        </x-dropdown-link>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>
                        @else
                            <div>
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    Vaše skupiny
                                </h2>
                            </div>
                            <div class="flex flex-col md:flex-row py-4">
                                @foreach ($user->groups as $group)
                                    <div class="flex justify-center p-2 items-center">
                                        <form action="{{ route('group.show', $group->id) }}">
                                            @csrf
                                            <button type="submit"
                                                class="inline-block px-6 py-2 w-32 bg-gray-200 text-gray-700 font-medium leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">{{ $group->name }}</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
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
    <x-slot name="slot">
        <div class="obsah" id="orderContent">
            @include('posts')
        </div>
        <div class="w-screen mt-20 text-center align-center">
            <div class="lds-ring" id="loadingImage">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </x-slot>
</x-app-layout>

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
