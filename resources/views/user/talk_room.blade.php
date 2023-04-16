<x-app-layout>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />


    <div class="flex flex-col h-screen justify-between">

        @foreach ($message_data as $data)
            @if ($data->sender_id != $user_id)
                <div class="flex items-start mb-4">
                    <div class="bg-gray-300 rounded-lg p-2 text-gray-700 text-sm leading-snug max-w-xs">
                        {{ $data->message }}
                    </div>
                </div>
            @else
                <div class="flex items-end mb-4 justify-end">
                    <div class="bg-blue-500 rounded-lg p-2 text-white text-sm leading-snug max-w-xs">
                        {{ $data->message }}
                    </div>
                </div>
            @endif
        @endforeach
        <div class="text-center  mb-40">
            <div class="my-auto">
                <form action="{{ url('post_message') }}" method="POST">
                    @csrf
                    <input name="other_id" type="hidden" value="{{ $other_id }}">
                    <textarea name="message" id="" cols="50" rows="5" placeholder="メッセージを入力してください。"></textarea><br>
                    <button type="submit"
                        class="shadow-lg bg-blue-500 shadow-blue-500/50 text-white rounded px-2 py-1">送信</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
</x-app-layout>
