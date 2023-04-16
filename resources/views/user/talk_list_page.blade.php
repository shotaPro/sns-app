<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>

    </body>

    </html>


    <h1 class="flex justify-center">トーク</h1>
    <div class="flex justify-center mt-4">
        <input class="" type="text" placeholder="キーワードを検索">
    </div>

    @if ($talk_history_list->isNotEmpty())
        <div class="flex justify-center mt-4">
            <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($talk_history_list as $list)
                    @if ($list->user_name != null)
                            @if ($list->user_id != $user_id)
                                <li class="pb-3 sm:pb-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8 rounded-full" src="/picture/{{ $list->image }}"
                                                alt="Neil image">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                <a
                                                    href=" {{ url('talk_room', $list->sender_id != $user_id ? $list->sender_id : $list->receiver_id) }} ">{{ $list->user_name }}</a>
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
                            @else
                            
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    @else
        <h1 style="font-size: 30px" class="flex justify-center mt-6">トーク履歴がありません。</h1>
    @endif

</x-app-layout>
