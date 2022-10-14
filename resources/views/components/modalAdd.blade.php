<div id="popup-modal-{{$type}}-{{$item_id}}" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center"
    aria-hidden="true">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-toggle="popup-modal-{{$type}}-{{$item_id}}">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="p-6 text-center">
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Upravit komentář?<i
                        class="fa-solid fa-pen pl-4"></i></h3>

                <form action="add" method="POST" class="p-4">
                    @csrf
                    <textarea class="p-2 h-wax w-max rounded-md mb-5" id="content" name="content" cols="30" rows="10">{{ $content }}</textarea>
                    <input type="hidden" id="workingWith" name="workingWith" value="{{ $type }}">
                    <input type="hidden" id="{{ $type }}_id" name="{{ $type }}_id"
                        value="{{ $item_id }}">
                    <button data-modal-toggle="popup-modal-{{$type}}-{{$item_id}}" type="submit"
                        class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Ano, upravit
                    </button>
                    <button data-modal-toggle="popup-modal-{{$type}}-{{$item_id}}" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Ne,
                        zrušit</button>
                </form>
            </div>
        </div>
    </div>
</div>
