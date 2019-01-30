<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Chat;
use App\Message;
use App\Events\ChatEvent;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chat($id) {
        if (Auth::check()) { // ◯
            $user_id = Auth::id();
            $chat_id = Chat::whereIn('user1_id', [$user_id, $id])
                                ->whereIn('user2_id', [$user_id, $id])
                                ->first();
            if ($chat_id != null) {
                $partner_user_profile = Profile::where('user_id', $id)->first();
                $partner_user_icon = asset($partner_user_profile->icon);
                $messages = Message::where('chat_id', $chat_id->id)->get();
                return view('chat.chat', compact('chat_id', 'messages', 'user_id', 'partner_user_profile', 'partner_user_icon'));
            } else {
                abort(404); // ◯
            }
        } else {
            abort(403);
        }
    }

    public function send_message(Request $request) {
        $user_id = Auth::id();
        $message = new Message;
        $message->fill([
            'chat_id' => $request->chat_id,
            'user_id' => $user_id,
            'content' => $request->send_message
        ])->save();
    }

    public function chat_member_list_view() {
        if (Auth::check()) {
            $user_id = Auth::id();
            $chat_members_list = array();
            $chat_members = Chat::where('user1_id', $user_id)
                                    ->orWhere('user2_id', $user_id)
                                    ->get();
            foreach ($chat_members as $chat_member) {
                if ($chat_member->user1_id == $user_id) {
                    array_push($chat_members_list, Profile::where('user_id', $chat_member->user2_id)->first());
                } else {
                    array_push($chat_members_list, Profile::where('user_id', $chat_member->user1_id)->first());
                }
            }
            return view('chat.chat_member_list', compact('chat_members_list', 'user_id'));
        } else {
            abort(403);
        }
    }

    public function chat_message() {
        return view('chat.chat_message');
    }
}
