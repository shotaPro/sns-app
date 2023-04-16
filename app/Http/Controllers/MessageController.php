<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    public function talk_room($id)
    {
        $other_id = $id;
        $user_id = Auth::user()->id;

        ////////////////////////////////////////////////
        //メッセージのやりとり情報の取得
        ////////////////////////////////////////////////
        $message_data = Message::Where('sender_id', '=', $user_id)
        ->Where('receiver_id', '=', $other_id)
        ->orWhere('sender_id', '=', $other_id)
        ->Where('receiver_id', '=', $user_id)->get();
        ////////////////////

        return view('user.talk_room', compact('user_id', 'other_id', 'message_data'));
    }

    public function post_message(Request $request)
    {
        $other_id = $request->input('other_id');
        $user_id = Auth::user()->id;

        $message_data = new Message();
        $message_data->sender_id = $user_id;
        $message_data->receiver_id = $other_id;
        $message_data->message = $request->message;

        $message_data->save();

        return redirect()->back();
    }
}
