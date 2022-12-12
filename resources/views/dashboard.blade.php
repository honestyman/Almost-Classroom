<x-app-layout>
    <x-slot name="header">
        @if (isset($user))
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Vaše skupiny
                    </h2>
                    <div class="flex flex-col md:flex-row py-4">
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
                    </div>
                </div>

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
            </div>
        @endif

    </x-slot>

    <div class="razeni" id="orderContent">
        @include('prispevky')
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

            function fetch_customer_data(query = '', groups = '') {
                $.ajax({
                    url: "{{ route('sort') }}",
                    method: 'GET',
                    data: {
                        query: query,
                        groups: groups
                    },
                    beforeSend: function() {
                        $('#loadingImage').show();
                        $('#orderContent').hide();
                    },
                    complete: function() {
                        $('#loadingImage').hide();
                    },
                    success: function(data) {
                        console.log(data);
                        $('.razeni').html(data);
                        $('#orderContent').show();
                    }
                })
            }

            $(document).on('change', '#sort', function() {
                var query = $('#sort').val();
                var groups = $('#groups').val();
                fetch_customer_data(query, groups);
            });
            $(document).on('change', '#groups', function() {
                var query = $('#sort').val();
                var groups = $('#groups').val();
                fetch_customer_data(query, groups);
            });
        });
    </script>


</x-app-layout>
