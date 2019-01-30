<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Department;
use App\Course;
use App\Follow_request;
use App\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function homeView() {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            if(Auth::check()) {
                $user_id = Auth::id();
                $user_info = Profile::where('user_id', $user_id)->first();
                $request_user_profiles = array();
                $follow_user_profiles = array();
                /*
                フォローリクエストのユーザを取得
                */
                $request_users = Follow_request::where('follow_id', $user_id)
                                                    ->where('request_permission', false)
                                                    ->get();

                foreach($request_users as $request_user) {
                    array_push($request_user_profiles, Profile::where('user_id', $request_user->user_id)->first());
                }

                /*
                フォロー済みのユーザを取得
                */
                $follow_users = Follow::where('user_id', $user_id)->get();

                foreach($follow_users as $follow_user) {
                    array_push($follow_user_profiles, Profile::where('user_id', $follow_user->follow_id)->first());
                }

                if(isset($user_info))
                {
                    return view('home', compact('user_info', 'request_user_profiles', 'follow_user_profiles'));
                } else {
                    abort('403');
                }
            } else {
                return redirect('login');
            }
            // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function still_add_function() {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            return view('next_add_function');
            // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }
}