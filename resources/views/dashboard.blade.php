<x-app-layout>
    <x-slot name="header">
        <!--Tady bude foreach co vypise do tlacitka vzdycky kazdou uzivatelovu private skupinu a
            kdyz se na tlacitko klikne tak hlavni content bude jen ta skupina-->
        @if (isset($user))
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Vaše soukromé skupiny
            </h2>
            <div class="flex space-x-2 justify-start py-4">
                @foreach ($user->groups as $group)
                    <div class="px-2">
                        <button type="button"
                            class="inline-block px-6 py-2 bg-gray-200 text-gray-700 font-medium leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">{{ $group->name }}</button>
                    </div>
                @endforeach
            </div>
        @endif

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    <form action="add" method="POST">
                        @csrf
                        <label for="name">Group name:</label><br>
                        <input type="text" id="name" name="name"><br>
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" id="workingWith" name="workingWith" value="group">
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
                        <input type="hidden" id="workingWith" name="workingWith" value="post">
                        <input type="submit" value="Submit">
                    </form>
                    <form action="join" method="POST">
                        @csrf
                        <label for="invite_key">Invite key:</label><br>
                        <input type="text" id="invite_key" name="invite_key"><br>
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" id="workingWith" name="workingWith" value="invite_key">
                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>


    @if (isset($user))
        @foreach ($posts as $postss)
            @foreach ($postss as $post)
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-2 lg:px-2">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <div class="grid grid-cols-5">
                                    <!-- HLAVNÍ ČÁST POSTU -->
                                    <div class="col-span-3 ">
                                        <div class="grid grid-rows-6 max-h-100 h-80">
                                            <div class="row-start-1">
                                                {{ $post->user->name }} ve
                                                skupině {{ $post->group->name }}
                                                <!-- TADY JE ROZKLIKAVACI MENU NA MAZANI & UPRAVU POSTU-->
                                                @if ($user->id == $post->group->user_id)
                                                    <div class="hidden sm:flex sm:items-center sm:m-1">
                                                        <x-dropdown align="left" width="48">
                                                            <x-slot name="trigger">
                                                                <button
                                                                    class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                                    <div><i class="fa-solid fa-gear"></i></div>
                                                                </button>
                                                            </x-slot>

                                                            <x-slot name="content">
                                                                <x-dropdown-link>
                                                                    <i class="fa-solid fa-trash pr-4"></i>{{'Smazat'}}
                                                                </x-dropdown-link>
                                                            </x-slot>
                                                        </x-dropdown>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row-span-4 row-start-2 py-2">{{ $post->content }}</div>
                                            <div class="row-start-6">
                                                <p class="pt-8 text-slate-600 italic">
                                                    Nahráno {{ $post->created_at->format('d. m. Y ') }} v
                                                    {{ $post->created_at->format('H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- KOMENTÁŘOVÁ ČÁST POSTU -->
                                    <div class="col-span-2 max-h-100 h-80">
                                        <div class="max-h-80 h-80 overflow-auto">
                                            @foreach ($post->comments as $comment)
                                                <p><b>{{ $comment->user->name }}</b></p>
                                                <p>{{ $comment->content }}</p>
                                            @endforeach

                                            <form action="add" method="POST" class="p-4 flex justify-between">
                                                @csrf
                                                <textarea class="p-2 min-h-60 min-w-60 h-wax w-max resize-none rounded-md bg-slate-100" id="content"
                                                    name="content"></textarea>
                                                <input type="hidden" id="post_id" name="post_id"
                                                    value="{{ $post->id }}">
                                                <input type="hidden" id="user_id" name="user_id"
                                                    value="{{ Auth::user()->id }}">
                                                <input type="hidden" id="workingWith" name="workingWith"
                                                    value="comment">
                                                <input type="submit" value="Přidat komentář" type="button"
                                                    class="p-2 rounded-md border border-1 border-slate-300">
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    @endif


</x-app-layout>
