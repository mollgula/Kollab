<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Follow_request;
use App\Follow;
use App\Chat;

class FollowController extends Controller
{
    public function follow_request(Request $request) {
        $user_id = Auth::id();
        $follow_id = $request->follow_id;

        $follow_request = new Follow_request;
        $follow_request->fill([
            'user_id' => $user_id,
            'follow_id' => $follow_id,
        ])->save();
    }

    public function allow_follow_requests(Request $request) {
        $user_id = Auth::id();
        $follow_id = $request->id;

        if(isset($user_id) && isset($follow_id)) {
            $follow_request = Follow_request::where('user_id', $follow_id)
                                                ->where('follow_id', $user_id)
                                                ->where('request_permission', false)
                                                ->first();
            $follow_request->fill([
                'request_permission' => true
            ])->save();

            $following = new Follow;
            $following->fill([
                'user_id' => $user_id,
                'follow_id' => $follow_id,
            ])->save();

            $follower = new Follow;
            $follower->fill([
                'user_id' => $follow_id,
                'follow_id' =>$user_id
            ])->save();

            // Chat tableに$user_idと$follow_idを保存する
            $chat = new Chat;
            $chat->fill([
                'user1_id' => $user_id,
                'user2_id' => $follow_id
            ])->save();
            return redirect('home');
        } else {
            $msg = "フォローリクエストを承認できませんでした";
            return view('search.search', compact('msg'));
        }
    }


    public function do_not_allow_follow_requests(Request $request) {
        $user_id = Auth::id();
        $follow_id = $request->id;
        Follow_request::where('user_id', $follow_id)
                        ->where('follow_id', $user_id)
                        ->where('request_permission', false)
                        ->first()
                        ->delete();
        return redirect('home');
    }

    public function delete_follow_user(Request $request) {
        $user_id = Auth::id();
        $follow_id = $request->id;

        if(isset($user_id) && isset($follow_id)) {
            $delete_follow_users_column = Follow::whereIn('user_id', [$user_id, $follow_id])
                    ->whereIn('follow_id', [$user_id, $follow_id])
                    ->get();
            foreach ($delete_follow_users_column as $delete_follow_user_column) {
                $delete_follow_user_column->delete();
            }

            $delete_chat_users_column = Chat::whereIn('user1_id', [$user_id, $follow_id])
                                                ->whereIn('user2_id', [$user_id, $follow_id])
                                                ->first();

            if (isset($delete_chat_users_column)) {
                $delete_chat_users_column->delete();
            }
        }
        return redirect('home');
    }

    /*
    public function delete_follow_request(Request $request) {
        // follow requestを送ったユーザを削除する
    }
    */
}
