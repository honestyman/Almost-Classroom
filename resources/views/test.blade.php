<div class="w-full md:inset-0 md:h-full">
    <div class="relative p-4 w-full max-w-lg h-full md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 md:p-8">
            <div class="mb-4 text-sm font-light text-gray-500 dark:text-gray-400">
                <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Privacy info</h3>
                @if (isset($data))
                    @foreach ($data as $radek)
                        <p>{{$radek->name}}</p>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
  </div>