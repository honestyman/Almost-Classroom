@if (isset($prispevky))
    @foreach ($prispevky as $prispevek)
        <div class="pt-6 sm:pt-8 pb-6">
            <div class="mx-0 sm:mx-5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 sm:p-4 bg-white border-b border-gray-200" onmouseover="this.style.cursor='pointer'"
                        onclick="window.location='group/{{ $prispevek->group->id }}/post/{{ $prispevek->id }}'"">
                        <div class="grid grid-cols-1 md:grid-cols-3">
                            <div class="flex justify-start p-3">
                                <span class="text-sm pt-1 capitalise mx-1">{{ $prispevek->group->name }}</span>
                                <b class="text-xl uppercase mx-1">{{ $prispevek->name }}</b>
                            </div>

                            <div class="text-slate-600 italic p-3 align-middle flex justify-center">
                                @if (isset($prispevek->deadline) || $prispevek->deadline != null)
                                    Termín odevzdání
                                    @if (date('Y-m-d-H-i') > date_create_from_format('Y-m-d H:i:s', $prispevek->deadline)->format('Y-m-d-H-i'))
                                        byl
                                    @else
                                        je
                                    @endif
                                    {{ date_create_from_format('Y-m-d H:i:s', $prispevek->deadline)->format('d. m. Y ') }}
                                    ve
                                    {{ date_create_from_format('Y-m-d H:i:s', $prispevek->deadline)->format('H:i') }}
                                @else
                                    Bez termínu odevzdání
                                @endif
                            </div>

                            <div class="flex justify-end align-middle">
                                @if ($prispevek->user_id == Auth::user()->id || Auth::user()->admin == 1)
                                    <i class="fa-solid fa-square-up-right text-5xl text-blue-500 mr-2"></i>
                                @else
                                    @foreach ($prispevek->postusers as $postuser)
                                        @if ($postuser->user_id == Auth::user()->id and $postuser->post_id == $prispevek->id)
                                            @if ($postuser->finished == 1)
                                                @if (isset($prispevek->deadline) || $prispevek->deadline != null)
                                                    @if (date_create_from_format('Y-m-d H:i:s', $postuser->updated_at)->format('d. m. Y H:i') >
                                                            date_create_from_format('Y-m-d H:i:s', $prispevek->deadline)->format('d. m. Y H:i'))
                                                        <i
                                                            class="fa-solid fa-square-check text-5xl text-yellow-300 mr-2"></i>
                                                    @else
                                                        <i
                                                            class="fa-solid fa-square-check text-5xl text-green-600 mr-2"></i>
                                                    @endif
                                                @else
                                                    <i
                                                        class="fa-solid fa-square-check text-5xl text-green-600 mr-2"></i>
                                                @endif
                                            @else
                                                <i class="fa-solid fa-square-xmark text-5xl text-red-600 mr-2"></i>
                                            @endif
                                        @break
                                    @endif
                                    @if ($loop->remaining == 0 and $postuser->user_id != Auth::user()->id)
                                        <i class="fa-solid fa-square-xmark text-5xl text-red-600 mr-2"></i>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="p-8" id="pagination">
    {{ $prispevky->links() }}
</div>

@endif
