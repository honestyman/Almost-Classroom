<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Všechny příspěvky
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    <form action="add" method="POST">
                        @csrf
                        <label for="name">Group name:</label><br>
                        <input type="text" id="name" name="name"><br>
                        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
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
                        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                        <input type="submit" value="Submit">
                    </form>
                    <form action="join" method="POST">
                        @csrf
                        <label for="invite_key">Invite key:</label><br>
                        <input type="text" id="invite_key" name="invite_key"><br>
                        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
