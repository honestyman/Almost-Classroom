@if ($function == 'add')
    <div id="popup-modal-{{ $type }}-{{ $item_id }}-{{ $function }}" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center"
        aria-hidden="true">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="popup-modal-{{ $type }}-{{ $item_id }}-{{ $function }}">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="p-6 text-center">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Upravit?<i
                            class="fa-solid fa-pen pl-4"></i></h3>

                    <form action="/{{ $type }}/add/{{ $item_id }}" method="POST" class="p-4">
                        @csrf
                        @if (isset($name))
                            <input type="text" id="name" name="name"
                                class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $name }}" required>
                        @endif
                        <textarea name="content" id="content" rows="4" cols="20"
                            class="block p-2.5 mb-5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 resize-none"
                            required>{{ $content }}</textarea>
                        <input type="hidden" id="workingWith" name="workingWith" value="{{ $type }}">
                        <button
                            data-modal-toggle="popup-modal-{{ $type }}-{{ $item_id }}-{{ $function }}"
                            type="submit"
                            class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Ano, upravit
                        </button>
                        <button
                            data-modal-toggle="popup-modal-{{ $type }}-{{ $item_id }}-{{ $function }}"
                            type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Ne,
                            zrušit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@elseif ($function == 'edit')
    <div id="popup-modal-{{ $type }}-{{ $item_id }}-{{ $function }}" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center"
        aria-hidden="true">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="popup-modal-{{ $type }}-{{ $item_id }}-{{ $function }}">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="p-6 text-center">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Upravit?<i
                            class="fa-solid fa-pen pl-4"></i></h3>

                    <form action="/{{ $type }}/edit/{{ $item_id }}" method="POST" class="p-4">
                        @csrf
                        @if (isset($name))
                            <input type="text" id="name" name="name"
                                class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $name }}" required>
                        @endif
                        <textarea name="content" id="content" rows="4" cols="20"
                            class="block p-2.5 mb-5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 resize-none"
                            required>{{ $content }}</textarea>
                        <input type="hidden" id="workingWith" name="workingWith" value="{{ $type }}">
                        <button
                            data-modal-toggle="popup-modal-{{ $type }}-{{ $item_id }}-{{ $function }}"
                            type="submit"
                            class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Ano, upravit
                        </button>
                        <button
                            data-modal-toggle="popup-modal-{{ $type }}-{{ $item_id }}-{{ $function }}"
                            type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Ne,
                            zrušit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <div id="popup-modal-{{ $type }}-{{ $item_id }}-{{ $function }}" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center"
        aria-hidden="true">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="popup-modal-{{ $type }}-{{ $item_id }}-{{ $function }}">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="p-6 text-center">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Smazat?<i
                            class="fa-solid fa-trash pl-4"></i></h3>

                    <form action="/{{ $type }}/delete/{{ $item_id }}" method="POST" class="p-4">
                        @csrf
                        @if (isset($name))
                            <p class="h-wax w-max rounded-md text-lg">{{ $name }}</p>
                        @endif
                        <p class="p-2 mb-5 h-wax w-max rounded-md">{{ $content }}</p>
                        <input type="hidden" id="workingWith" name="workingWith" value="{{ $type }}">
                        <button
                            data-modal-toggle="popup-modal-{{ $type }}-{{ $item_id }}-{{ $function }}"
                            type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Ano, smazat
                        </button>
                        <button
                            data-modal-toggle="popup-modal-{{ $type }}-{{ $item_id }}-{{ $function }}"
                            type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Ne,
                            zrušit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
