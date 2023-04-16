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
        @if (session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('message') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 6.357 5.652a.5.5 0 0 0-.707.707L9.293 10l-3.643 3.643a.5.5 0 1 0 .707.707L10 10.707l3.643 3.643a.5.5 0 0 0 .707-.707L10.707 10l3.641-3.648a.5.5 0 0 0 0-.7z" />
                    </svg>
                </span>
            </div>
        @endif
        <h1 class="flex justify-center">友達検索</h1>
        <div class="flex justify-center mt-4">
            <form action="{{ url('search_friend') }}" method="POST">
                @csrf
                <input name="search_id" type="text" placeholder="アカウントIDを入力">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">検索</button>
            </form>
        </div>
        <div class="flex justify-center">

            @if (session('search_result_data'))
                @php
                    $search_friend_data = session('search_result_data');
                    $friend_flg_array = session('friend_flg_array');
                @endphp
                <a href="">
                    <table class="border-emerald-950 table-auto">
                        <tbody>
                            <tr>
                                <div>

                                </div>
                                <td class="border-emerald-950 border px-4 py-2"><img src="" alt=""></td>
                                <td class="border-emerald-950 border px-4 py-2 w-48">{{ $search_friend_data['name'] }}
                                </td>
                                @if (isset($friend_flg_array))
                                    <td class="border-emerald-950 border px-4 py-2">
                                        <button
                                            class="shadow-lg bg-orange-500 shadow-orange-500/50 text-white rounded px-2 py-1">追加済み</button>
                                    </td>
                                @else
                                    <td class="border-emerald-950 border px-4 py-2">
                                        <form action="{{ url('add_friend') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="friend_id"
                                                value="{{ $search_friend_data['user_id'] }}">
                                            <button type="submit"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">友達追加する</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </a>
            @endif
        </div>

        <div class="flex justify-center">
            <a href="{{ url('create_group_page') }}" class="text-center w-50 mt-10 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                グループを作成する
            </a>
        </div>

    </html>




</x-app-layout>
