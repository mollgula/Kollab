<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signinView(Request $request) {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            return view('login.signin');
            // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function signin(LoginRequest $request) {
        $userData = [
            'mail' => $request->mail,
            // passwordは暗号化しないでください
            // Auth::attemptで暗号化されて比較されます
            'password' => $request->password,
        ];

        $rememberMe = (bool)$request->remember_me;

        if(isset($rememberMe)) {
            if (Auth::attempt($userData, $rememberMe)) {
                return redirect('home');
            } else {
                return view('login.signin', ['msg' => 'メールアドレスまたはパスワードが違います']);
            }
        } else {
            if (Auth::attempt($userData)) {
                return redirect('home');
            } else {
                return view('login.signin', ['msg' => 'メールアドレスまたはパスワードが違います']);
            }
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('login');
    }
}
