<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vybrat skupinu
        </h2>
        <!--Tady bude foreach co vypise do tlacitka vzdycky kazdou uzivatelovu private skupinu a
            kdyz se na tlacitko klikne tak hlavni content bude jen ta skupina-->
        <div class="flex space-x-2 justify-start py-4">
            <div class="px-2">
                <button type="button"
                    class="inline-block px-6 py-2 bg-gray-200 text-gray-700 font-medium leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">Skupina</button>
            </div>
            <div class="px-2">
                <button type="button"
                    class="inline-block px-6 py-2 bg-gray-200 text-gray-700 font-medium leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">Skupina</button>
            </div>
            <div class="px-2">
                <button type="button"
                    class="inline-block px-6 py-2 bg-gray-200 text-gray-700 font-medium leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">Skupina</button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    <i class="fa-solid fa-gear"></i>
                    <form action="add" method="POST">
                        @csrf
                        <label for="name">Group name:</label><br>
                        <input type="text" id="name" name="name"><br>
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="submit" value="Submit">
                    </form>
                    <form action="add" method="POST">
                        @csrf
                        <label for="name">Post name:</label><br>
                        <input type="text" id="name" name="name"><br>
                        <label for="content">Post content:</label><br>
                        <input type="text" id="content" name="content"><br>
                        <label for="group_id">Group id:</label><br>
                        <input type="number" id="group_id" name="group_id"><br><br>
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="submit" value="Submit">
                    </form>
                    <form action="join" method="POST">
                        @csrf
                        <label for="invite_key">Invite key:</label><br>
                        <input type="text" id="invite_key" name="invite_key"><br>
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-5">
                        <div class="col-span-3 ">
                            <div class="grid grid-rows-6 max-h-100 h-80">
                                <div class="row-start-1">
                                    <p><i class="fa-solid fa-gear pr-4"></i>Název autora + skupina</p>
                                    
                                </div>
                                <div class="row-span-4 row-start-2 py-2">Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Nisi necessitatibus, optio quasi mollitia nam reiciendis fugiat,
                                    eaque consectetur deserunt ea nemo. Distinctio, molestias! Voluptas exercitationem
                                    minima distinctio modi ullam in?</div>
                                <div class="row-start-6">
                                    {{ now()->toDateTimeString() }}
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 max-h-100 h-80">
                            <div class="grid grid-rows-6">
                                <div class="row-start-1">
                                    <p>Komentáře</p>
                                </div>
                                <div class="row-span-5 row-start-2 max-h-100 h-80 overflow-auto">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur doloremque,
                                    aspernatur quam deserunt cupiditate commodi aliquam autem numquam quas suscipit
                                    blanditiis eligendi ea voluptate fugiat reiciendis saepe recusandae facere est.
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur doloremque,
                                    aspernatur quam deserunt cupiditate commodi aliquam autem numquam quas suscipit
                                    blanditiis eligendi ea voluptate fugiat reiciendis saepe recusandae facere est.
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur doloremque,
                                    aspernatur quam deserunt cupiditate commodi aliquam autem numquam quas suscipit
                                    blanditiis eligendi ea voluptate fugiat reiciendis saepe recusandae facere est.
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur doloremque,
                                    aspernatur quam deserunt cupiditate commodi aliquam autem numquam quas suscipit
                                    blanditiis eligendi ea voluptate fugiat reiciendis saepe recusandae facere est.
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>
