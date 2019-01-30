<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Users;
use App\Profile;
use App\Department;
use App\Course;
use App\Http\Requests\editProfileRequest;

class ProfileController extends Controller
{
    public function profileGet() {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            if (Auth::check()) {
                $userId = Auth::id();
                $profile_info = Profile::where('user_id', $userId)->first();
                $department = Department::where('id', $profile_info->department)->first();
                $course_record = Course::where('id', $profile_info->course)->first();

                if(isset($userId) && isset($course_record) && isset($department)) {
                    $department_name = $department->departmentName;
                    $course = $course_record->courseName;
                    return view('profile.myProfile', compact('profile_info', 'department_name', 'course'));
                } elseif(isset($userId) && isset($department)) {
                    $department_name = $department->departmentName;
                    $course = 'なし';
                    return view('profile.myProfile', compact('profile_info', 'department_name', 'course'));
                } elseif(isset($userId)) {
                    $department_name = 'なし';
                    $course = 'なし';
                    return view('profile.myProfile', compact('profile_info', 'department_name', 'course'));
                } else {
                    abort('403');
                }
            } else {
                abort('403');
            }
                // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function editProfileView() {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            if (Auth::check()) {
                $userId = Auth::id();
                $profile_info = Profile::where('user_id', $userId)->first();
                $department = Department::where('id', $profile_info->department)->first();
                $course_record = Course::where('id', $profile_info->course)->first();

                if(isset($userId) && isset($course_record) && isset($department)) {
                    $department_name = $department->departmentName;
                    $course = $course_record->courseName;
                    return view('profile.editProfile', compact('userId', 'profile_info', 'department_name', 'course'));
                } elseif(isset($userId) && isset($department)) {
                    $department_name = $department->departmentName;
                    $course = 'なし';
                    return view('profile.editProfile', compact('userId', 'profile_info', 'department_name', 'course'));
                } elseif($userId) {
                    $department = 'なし';
                    $course = 'なし';
                    return view('profile.editProfile', compact('userId', 'profile_info', 'department_name', 'course'));
                } else {
                    abort('403');
                }
            } else {
                abort('403');
            }
                // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function updateProfile(editProfileRequest $request)
    {
        $image = $request->file('icon');
        // デフォルト画像
        $default_image = 'images/'.'default_image.png';
        // 設定済みのアイコン画像
        $now_set_icon = Profile::where('user_id', Auth::id())->first()->icon;
        $token = str_random(20);
        $file_path = 'public/images';

        if (isset($image)) {
            $image->move('images', $token.$image->getClientOriginalName());
            $icon = 'images/'.$token.$image->getClientOriginalName();

            DB::table('profiles')->where('user_id', $request->id)->update([
                'name' => $request->name,
                'department' => $request->department,
                'course' => $request->course,
                'schoolYear' => (int)$request->schoolYear,
                'age' => (int)$request->age,
                'icon' => $icon,
                'sex' => $request->sex,
                'text' => $request->text,
            ]);
            File::delete($file_path, $now_set_icon);
            return redirect('myProfile');
        } elseif (isset($now_set_icon)) {

            DB::table('profiles')->where('user_id', $request->id)->update([
                'name' => $request->name,
                'department' => $request->department,
                'course' => $request->course,
                'schoolYear' => (int)$request->schoolYear,
                'age' => (int)$request->age,
                'icon' => $now_set_icon,
                'sex' => $request->sex,
                'text' => $request->text,
            ]);
            return redirect('myProfile');

        } else {

            DB::table('profiles')->where('user_id', $request->id)->update([
                'name' => $request->name,
                'department' => $request->department,
                'course' => $request->course,
                'schoolYear' => (int)$request->schoolYear,
                'age' => (int)$request->age,
                'icon' => $default_image, // デフォルト画像
                'sex' => $request->sex,
                'text' => $request->text,
            ]);
            return redirect('myProfile');
        }
    }

    public function otherUserProfileView(Request $request) {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            $otherUserProfileInfo = Profile::where('user_id', (int)$request->id)->first();

            if(($otherUserProfileInfo != null) && ($otherUserProfileInfo->department != null) && ($otherUserProfileInfo->course != null)) {
                $department = Department::where('id', $otherUserProfileInfo->department)->first()->departmentName;
                $course = Course::where('id', $otherUserProfileInfo->course)->first()->courseName;
                $otherUserProfileIcon = asset($otherUserProfileInfo->icon);
                return view('profile.otherUserProfile', compact('otherUserProfileInfo', 'department', 'course', 'otherUserProfileIcon'));
            } elseif($otherUserProfileInfo != null) {
                $department = Department::where('id', $otherUserProfileInfo->department)->first()->departmentName;
                $otherUserProfileIcon = asset($otherUserProfileInfo->icon);
                return view('profile.otherUserProfile', compact('otherUserProfileInfo', 'department', 'otherUserProfileIcon'));
            } else {
                abort('404');
            }
                // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }
}
