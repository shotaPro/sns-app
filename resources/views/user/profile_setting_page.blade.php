<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
<!-- component -->
<nav class="flex items-center justify-between flex-wrap bg-blue-300 p-6">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
      <a href="{{ url('home') }}" class="font-semibold text-xl tracking-tight">戻る</a>
    </div>
  </nav>
<body class="bg-gray-300 antialiased">

    <div class="container mx-auto my-60">
        <div>
            @if (session('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('message') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 6.357 5.652a.5.5 0 0 0-.707.707L9.293 10l-3.643 3.643a.5.5 0 1 0 .707.707L10 10.707l3.643 3.643a.5.5 0 0 0 .707-.707L10.707 10l3.641-3.648a.5.5 0 0 0 0-.7z"/></svg>
                    </span>
                </div>
            @endif
            <div class="bg-white relative shadow rounded-lg w-5/6 md:w-5/6  lg:w-4/6 xl:w-3/6 mx-auto">
                @if($profile_info)
                <form action="{{ url('profile_update') }}" method="POST" enctype="multipart/form-data">
                @else
                <form action="{{ url('profile_edit') }}" method="POST" enctype="multipart/form-data">
                @endif
                    @csrf
                    <div>
                        <h2 style="font-size:20px;">ユーザー名</h2>
                        @if($profile_info)
                        <img class="h-16" src="/picture/{{ $profile_info->image }}">
                        @else
                        <img class="h-16" src="https://avatars0.githubusercontent.com/u/35900628?v=4">
                        @endif
                        <input type="file" name="image">
                    </div>
                    <div class="mt-16">
                        <div class="w-full">
                            <div class="mt-5 w-full flex flex-col items-center overflow-hidden text-sm">
                                <a href="#"
                                    class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                    <h2 style="font-size:20px;">ユーザー名</h2>
                                    <input type="text" name="user_name" placeholder="{{ $profile_info ? $profile_info->user_name : '' }}">
                                </a>

                                <a href="#"
                                    class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                    <h2 style="font-size:20px;">メッセージ</h2>
                                    <textarea name="message" id="" cols="30" rows="5" placeholder="{{ $profile_info ? $profile_info->message : '' }}"></textarea>
                                </a>

                                <a href="#"
                                    class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                    <h2 style="font-size:20px;">アカウントID</h2>
                                    <input type="text" name="account_id" placeholder="{{ $profile_info ? $profile_info->my_id : '' }}">
                                </a>

                                <a href="#"
                                    class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                    <h2 style="font-size:20px;">アカウントIDからの友達追加を許可する</h2>
                                    <select name="permission_status" id="">
                                        @if($profile_info)
                                        <option value="">-------</option>
                                        <option {{ $profile_info->permission_flg == 1 ? 'selected' : '' }} value="1">許可</option>
                                        <option {{ $profile_info->permission_flg == 2 ? 'selected' : '' }} value="2">不許可</option>
                                        @else
                                        <option value="">-------</option>
                                        <option value="1">許可</option>
                                        <option value="2">不許可</option>
                                        @endif
                                    </select>
                                </a>
                                <button class="bg-blue-700 hover:bg-blue-600 text-white rounded px-4 py-2"
                                    type="submit">編集する</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
