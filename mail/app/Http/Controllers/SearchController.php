<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Department;
use App\Follow_request;
use App\Follow;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller {

    public function user_search(Request $request) {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            $user_id = Auth::id();
            $keyword = $request->keyword;
            $msg = 'キーワードを入力してください';
            $not_find_search_msg = 'お探しのユーザは見つかりませんでした';

            if (isset($keyword)) {
                if(isset($user_id)) {
                    // keywordから取得したユーザ
                    $users = Profile::where('user_id', '!=', $user_id)->where('name', 'like', '%'. $keyword .'%')->orWhere('text', 'like', '%'. $keyword .'%')->get()->toArray();
                    // follow requestを送っているユーザ
                    $follow_requested_users = Follow_request::where('request_permission', false)->where('user_id', $user_id)->get();
                    // follow requestを送られているユーザ
                    $follow_requesting_users = Follow_request::where('request_permission', false)->where('follow_id', $user_id)->get();
                    // 相互にfollowしているユーザ
                    $follow_users = Follow::where('user_id', $user_id)->get();

                    $follow_users_profile = array();
                    $follow_requested_users_profile = array();
                    $follow_requesting_users_profile = array();
                    $not_follow_users_array = array();

                    $follow_requested_users_array = array();
                    $follow_requesting_users_array = array();
                    $follow_users_array = array();

                    // 相互にfollowしているユーザのプロフィールを取得
                    foreach ($follow_users as $follow_user) {
                        array_push($follow_users_array, Profile::where('user_id', $follow_user->follow_id)->first());
                    }

                    // usersと$follow_users_arrayを比較
                    foreach ($follow_users_array as $follow_user_array) {
                        $search = array_search($follow_user_array->user_id, array_column($users, "user_id"));
                        if ($search !== false) {
                            array_push($follow_users_profile, $follow_user_array);
                        }
                    }

                    // follow requestを送っているユーザのプロフィールを取得
                    foreach ($follow_requested_users as $follow_requested_user) {
                        array_push($follow_requested_users_array, Profile::where('user_id', $follow_requested_user->follow_id)->first());
                    }

                    foreach ($follow_requested_users_array as $follow_requested_user_array) {
                        $search = array_search($follow_requested_user_array['user_id'], array_column($users, "user_id"));
                        if ($search !== false) {
                            array_push($follow_requested_users_profile, $follow_requested_user_array);
                        }
                    }

                    // follow requestを送られているユーザのプロフィールを取得
                    foreach ($follow_requesting_users as $follow_requesting_user) {
                        array_push($follow_requesting_users_array, Profile::where('user_id', $follow_requesting_user->user_id)->first());
                    }

                    foreach ($follow_requesting_users_array as $follow_requesting_user_array) {
                        $search = array_search($follow_requesting_user_array->user_id, array_column($users, "user_id"));
                        if ($search !== false) {
                            array_push($follow_requesting_users_profile, $follow_requesting_user_array);
                        }
                    }

                    $other_users_array = array_merge($follow_users_array, $follow_requested_users_array, $follow_requesting_users_array);

                    foreach ($users as $user) {
                        $search = array_search($user["user_id"], array_column($other_users_array, "user_id"));
                        if ($search !== false) {
                            // 何もしない
                        } else {
                            array_push($not_follow_users_array, $user);
                        }
                    }
                    return view('search.result_search', compact('keyword', 'users', 'follow_users_profile', 'follow_requested_users_profile', 'follow_requesting_users_profile', 'not_follow_users_array', 'not_find_search_msg'));
                } else {
                    abort('403');
                }
            } else {
                return view('search.search', compact('msg', 'departments', 'keyword'));
            }
            // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function resultView() {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            return view('search.result_search');
            // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function department_search(Request $request) {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if((strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            $user_id = Auth::id();
            $department_id = $request->department_id;
            // var_dump($department_id);
            $not_find_search_msg = 'お探しのユーザは見つかりませんでした';

            if (isset($user_id)) {
            } else {
                abort('403');
            }
            if (isset($department_id)) {
                // department_idから取得したユーザ
                $users = Profile::where('user_id', '!=', $user_id)->where('department', $department_id)->get()->toArray();
                // follow requestを送っているユーザ
                $follow_requested_users = Follow_request::where('request_permission', false)->where('user_id', $user_id)->get();
                // follow requestを送られているユーザ
                $follow_requesting_users = Follow_request::where('request_permission', false)->where('follow_id', $user_id)->get();
                // 相互にfollowしているユーザ
                $follow_users = Follow::where('user_id', $user_id)->get();

                $follow_users_profile = array();
                $follow_requested_users_profile = array();
                $follow_requesting_users_profile = array();
                $not_follow_users_array = array();

                $follow_requested_users_array = array();
                $follow_requesting_users_array = array();
                $follow_users_array = array();

                // 相互にfollowしているユーザのプロフィールを取得
                foreach ($follow_users as $follow_user) {
                    array_push($follow_users_array, Profile::where('user_id', $follow_user->follow_id)->first());
                }

                // usersと$follow_users_arrayを比較
                foreach ($follow_users_array as $follow_user_array) {
                    $search = array_search($follow_user_array->user_id, array_column($users, "user_id"));
                    if ($search !== false) {
                        array_push($follow_users_profile, $follow_user_array);
                    }
                }

                // follow requestを送っているユーザのプロフィールを取得
                foreach ($follow_requested_users as $follow_requested_user) {
                    array_push($follow_requested_users_array, Profile::where('user_id', $follow_requested_user->follow_id)->first());
                }

                foreach ($follow_requested_users_array as $follow_requested_user_array) {
                    $search = array_search($follow_requested_user_array['user_id'], array_column($users, "user_id"));
                    if ($search !== false) {
                        array_push($follow_requested_users_profile, $follow_requested_user_array);
                    }
                }

                // follow requestを送られているユーザのプロフィールを取得
                foreach ($follow_requesting_users as $follow_requesting_user) {
                    array_push($follow_requesting_users_array, Profile::where('user_id', $follow_requesting_user->user_id)->first());
                }

                foreach ($follow_requesting_users_array as $follow_requesting_user_array) {
                    $search = array_search($follow_requesting_user_array->user_id, array_column($users, "user_id"));
                    if ($search !== false) {
                        array_push($follow_requesting_users_profile, $follow_requesting_user_array);
                    }
                }

                $other_users_array = array_merge($follow_users_array, $follow_requested_users_array, $follow_requesting_users_array);

                foreach ($users as $user) {
                    $search = array_search($user["user_id"], array_column($other_users_array, "user_id"));
                    if ($search !== false) {
                        // 何もしない
                    } else {
                        array_push($not_follow_users_array, $user);
                    }
                }
                return view('search.result_department_search', compact('users', 'follow_users_profile', 'follow_requested_users_profile', 'follow_requesting_users_profile', 'not_follow_users_array', 'not_find_search_msg'));
            } else {
                return view('search.result_department_search', compact('msg'));
            }
            // SP版TOPにリダイレクト
        } else {
            // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function result_depaerment_search_view() {
        return view('search.result_department_search');
    }

}