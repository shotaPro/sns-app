@php
    use Illuminate\Support\Facades\Auth;

    $user_id = Auth::user()->id;

@endphp
<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script src="https://cdn.tailwindcss.com"></script>

    </head>

    <body>

        <h1 style="font-size: 30px" class="text-center">友達を選択</h1>

        <form action="{{ url('select_group_friend') }}" method="POST">
            @csrf
            <div class="flex justify-center mt-4">
                <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($Friend_data_list as $list)
                        <li class="pb-3 sm:pb-4">
                            <div class="flex items-center space-x-4">
                                <input type="checkbox" name="check[]" value="{{ $list->user_id }}">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="/picture/{{ $list->image }}"
                                        alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        <a href="">{{ $list->user_name }}</a>
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        email@flowbite.com
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $320
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="text-center">
                <button class="bg-blue-600 hover:bg-blue-500 text-white rounded px-4 py-2">次へ</button>
            </div>
        </form>

    </body>

    </html>
</x-app-layout>
