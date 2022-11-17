<x-app-layout>
    <x-slot name="header">
        @if (isset($user))
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Vaše skupiny
            </h2>
            <div class="flex space-x-2 justify-start py-4">
                @foreach ($user->groups as $group)
                    <div class="px-2">

                        <form action="/group/{{ $group->id }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $group->id }}">
                            <button type="submit"
                                class="inline-block px-6 py-2 bg-gray-200 text-gray-700 font-medium leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">{{ $group->name }}</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

    </x-slot>

    @if (isset($user))
        @foreach ($posts as $postss)
            @foreach ($postss as $post)
                <div class="pt-6 sm:pt-8 pb-6">
                    <div class="mx-0 sm:mx-5">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                            <div class="p-2 sm:p-4 bg-white border-b border-gray-200"
                                onmouseover="this.style.cursor='pointer'"
                                onclick="window.location='group/{{ $post->group->id }}/post/{{ $post->id }}'"">
                                <div class="grid grid-cols-1 md:grid-cols-3">
                                    <div class="flex justify-start p-3">
                                        <b class="text-xl">{{ $post->name }}</b>
                                    </div>

                                    <div class="text-slate-600 italic p-3 align-middle flex justify-center">
                                        {{ $post->user->name }} nahrál {{ $post->created_at->format('d. m. Y ') }} v
                                        {{ $post->created_at->format('H:i') }} @if ($post->created_at != $post->updated_at)
                                            (Upraveno {{ $post->updated_at->format('d. m. Y ') }} v
                                            {{ $post->updated_at->format('H:i') }})
                                        @endif
                                    </div>

                                    <div class="flex justify-end align-middle">
                                        @foreach ($post->postusers as $postuser)
                                            @if ($postuser->user_id == Auth::user()->id and $postuser->post_id == $post->id)
                                                @if ($postuser->finished == 1)
                                                    <i
                                                        class="fa-solid fa-square-check text-5xl text-green-600 mr-2"></i>
                                                @else
                                                    <i class="fa-solid fa-square-xmark text-5xl text-red-600 mr-2"></i>
                                                @endif
                                            @break
                                        @endif
                                        @if ($loop->remaining == 0 and $postuser->user_id != Auth::user()->id)
                                            <i class="fa-solid fa-square-xmark text-5xl text-red-600 mr-2"></i>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    @endforeach
@endif


</x-app-layout>
