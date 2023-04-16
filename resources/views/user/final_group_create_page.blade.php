@php
    use Illuminate\Support\Facades\Auth;

    $user_id = Auth::user()->id;

    $friend_data = [];

    ////////////////////////////////////////////////////////////////////////
    //取り消しユーザー以外のデータ取得処理
    ////////////////////////////////

    if(isset($selected_friend_data)){
        ///取り消しユーザーがある時の処理

    }else {
 ///取り消しユーザーがない時の処理


        foreach ($selected_friend_list as $list) {
        $friend_data[] = $list->getOriginal();

        }
    }

    ////////////////////////////////////////////////////////////////////////



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

        <h1 style="font-size: 30px" class="text-center">グループ名を選択</h1>
        @if(isset($selected_friend_data))
        <form action="{{ url('create_group') }}" method="POST">
            @csrf
            <div class="text-center">
                <input class="mx-auto" name="group_name" />
            </div>            <div class="flex justify-center mt-4">
                <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($selected_friend_data as $list)
                        <li class="pb-3 sm:pb-4">
                            <input type="hidden" name="selected_user[]" value="{{ $list['user_id'] }}">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="/picture/" alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        <a href="">{{ $list['user_name'] }}</a>
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        email@flowbite.com
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $320
                                </div>
                                <a class="bg-red-600 hover:bg-red-500 text-white rounded px-4 py-2"
                                    href="{{ url('cancel_group_create_user', $list['user_id']) }}/?{{ http_build_query(['group_user_data' => $friend_data]) }}">取り消し</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="text-center">
                <button class="bg-blue-600 hover:bg-blue-500 text-white rounded px-4 py-2">このメンバーで作成する</button>
            </div>
        </form>
        @else
        <form action="{{ url('create_group') }}" method="POST">
            @csrf
            <div class="text-center">
                <input class="mx-auto" name="group_name" />
            </div>
            <div class="flex justify-center mt-4">
                <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($selected_friend_list as $list)
                        <li class="pb-3 sm:pb-4">
                            <input type="hidden" name="selected_user[]" value="{{ $list->user_id }}">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="/picture/" alt="Neil image">
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
                                <a class="bg-red-600 hover:bg-red-500 text-white rounded px-4 py-2"
                                    href="{{ url('cancel_group_create_user', $list->user_id) }}/?{{ http_build_query(['group_user_data' => $friend_data]) }}">取り消し</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white rounded px-4 py-2">このメンバーで作成する</button>
            </div>
        </form>
        @endif


    </body>

    </html>
</x-app-layout>
