<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Friends;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use PhpParser\Node\Stmt\GroupUse;

class UserController extends Controller
{
    public function talk_list_page()
    {
        if (Auth::user()->id != 1) {

            $user_id = Auth::user()->id;
            $talk_history_list = User::join('messages', 'users.id', 'messages.sender_id')
                ->join('profiles', 'users.id', 'profiles.user_id')
                ->Where('messages.sender_id', '=', $user_id)
                ->orWhere('messages.receiver_id', '=', $user_id)
                ->get();


            return view('user.talk_list_page', compact('talk_history_list', 'user_id'));
        } else {

            return view('admin.home');
        }
    }

    public function home()
    {

        ////////////////////////////////////////////////////////////////////////
        //友達一覧の情報取得
        ////////////////////////////////////////////////////////////////
        $user_id = Auth::user()->id;
        $friend_list = Friends::join('profiles', 'friends.friend_id', 'profiles.user_id')
            ->join('users', 'profiles.user_id', 'users.id')
            ->Where('friends.user_id', '=', $user_id)
            ->get();
        /////////

        return view('user.home', compact('friend_list'));
    }

    public function add_friend_page()
    {
        return view('user.add_friend_page');
    }

    public function profile_setting_page()
    {
        $user_id = Auth::user()->id;
        $profile_info = Profile::Where('user_id', '=', $user_id)->first();

        if ($profile_info != NULL) {
        } else {

            $profile_info = false;
        }

        return view('user.profile_setting_page', compact('profile_info'));
    }

    public function profile_edit(Request $request)
    {
        $user_id = Auth::user()->id;
        $profile_info = new Profile();
        $image = $request->image;

        if ($image) {

            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('picture', $imagename);
            $profile_info->image = $imagename;
        }
        $profile_info->user_id = $user_id;
        $profile_info->user_name = $request->user_name;
        $profile_info->message = $request->message;
        $profile_info->my_id = $request->account_id;

        $profile_info->permission_flg = $request->input('permission_status');

        $profile_info->save();

        return redirect()->back()->with('message', 'プロフィールの編集が完了しました。');
    }

    public function profile_update(Request $request)
    {
        $user_id = Auth::user()->id;
        $profile_data = Profile::Where('user_id', '=', $user_id)->first();
        $profile_data->user_name = $request->user_name;
        $image = $request->image;
        if ($image != NULL) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('profile_picture', $imagename);
            $profile_data->image = $imagename;
        }
        $profile_data->message = $request->message;
        $profile_data->my_id = $request->account_id;
        $profile_data->permission_flg = $request->permission_status;

        $profile_data->save();

        return redirect()->back()->with("message", "プロフィールの更新が正常に完了しました。");
    }

    public function search_friend(Request $request)
    {
        $user_id = Auth::user()->id;
        $search_friend_data = Profile::join('users', 'users.id', 'profiles.user_id')
            ->Where('users.id', '!=', $user_id)
            ->Where('profiles.my_id', '=', $request->search_id)
            ->first();

        ////////////////////////////////
        //友達追加済みか判断するフラグ
        ////////////////////////////////
        $friend_flg_array = Friends::Where('user_id', '=', $user_id)
            ->Where('friend_id', '=', $search_friend_data['user_id'])
            ->first();
        $friend_flg_array = $friend_flg_array ? $friend_flg_array : NULL;
        ////////////////////////////////

        return redirect()->back()->with([
            'search_result_data' => $search_friend_data,
            'friend_flg_array' => $friend_flg_array
        ]);
    }

    public function add_friend(Request $request)
    {
        $user_id = Auth::user()->id;
        $add_friend_id = $request->friend_id;

        $Friend_data = new Friends();
        $Friend_data->user_id = $user_id;
        $Friend_data->friend_id = $add_friend_id;
        $Friend_data->save();

        return redirect()->back()->with('message', '友達追加しました');
    }

    public function create_group_page()
    {
        $user_id = Auth::user()->id;
        $Friend_data_list = Friends::join('profiles', 'friends.friend_id', 'profiles.user_id')
            ->join('users', 'profiles.user_id', 'users.id')
            ->Where('friends.user_id', '=', $user_id)->get();

        return view('user.create_group_page', compact('user_id', 'Friend_data_list'));
    }

    public function create_group(Request $request)
    {
        $selected_friend = $request->input('selected_user');
        $group_name = $request->input('group_name');
        $user_id = Auth::user()->id;

        $Group_name = new Group();
        $Group_name->name = $group_name;
        $Group_name->save();


        array_push($selected_friend, $user_id);

        $group_user_data = array();

        foreach ($selected_friend as $friend_id){
            $group_user_data[] =['group_id' => $Group_name->id,'user_id' => $friend_id];
        }
        GroupUser::insert($group_user_data);

        return view('user.success');
        
    }

    public function select_group_friend(Request $request)
    {
        $selected_friend = $request->input('check');

        $selected_friend_list = array();

        foreach ($selected_friend as $friend_id) {

            $selected_friend_list[] = User::join('profiles', 'profiles.user_id', 'users.id')
                ->Where('users.id', '=', $friend_id)->first();
        }

        return view('user.final_group_create_page', compact('selected_friend_list'));
    }

    public function cancel_group_create_user(Request $request, $id)
    {
        $delete_user_data = $id;
        $friend_data = $request->input('group_user_data');
        $selected_friend_data = array();
        foreach ($friend_data as $data) {

            if ($data['user_id'] != $delete_user_data) {
                $selected_friend_data[] = $data;
            }
        }

        return view('user.final_group_create_page', compact('selected_friend_data'));
    }
}
