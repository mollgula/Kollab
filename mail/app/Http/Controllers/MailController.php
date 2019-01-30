<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Register;
use App\User;
use App\Profile;
use App\Mail\MailSender;
use App\Http\Requests\MailRequest;
use App\Http\Requests\initProfileRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{

    public function index()
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            $token = str_random(40);
            return view('register.index', compact('token'));
            // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function provisional_registration()
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            return view('emails.provisional_registration');
            // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function confirm() {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            return view('register.confirm');
            // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function already_mail_address_registered() {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            return view('errors.already_mail_address_registered');
            // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function no_expiration_date() {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            return view('errors.no_expiration_date');
            // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function post(MailRequest $request)
    {
        $options = [
            'to' => $request->mail,
            'subject' => 'Kollabの本登録について',
            'template' => 'emails.mail',
        ];

        $data = [
            'token' => $request->token
        ];

        $register = new Register;
        $register->fill([
            'mail' => $request->mail,
            'password' => Hash::make($request->password),
            'confirm_password' => Hash::make($request->confirm_password),
            'token' => $request->token,
        ])->save();

        Mail::to($options['to'])->send(new MailSender($options, $data));
        return redirect('provisional_registration');
        // 復号化
        // $aaa = decrypt(Register::where('mail', 'tanaka0825masa@gmail.com')->first()->password);
    }

    public function getToken($token) {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            if (empty($token)) {
                abort('404');
            } else {
                $token_record = Register::token($token)->first();
                if (isset($token_record)) {
                    // 大丈夫
                    $register_token = Register::where('token', $token)->first()->token;
                    $mail = Register::where('token', $token)->first()->mail;
                    $password = Register::where('token', $token)->first()->password;
                    $created_at = Register::where('token', $token)->first()->created_at;
                    $users_mail_record = User::where('mail', $mail)->first();

                    if ($token == $register_token) {
                        // 大丈夫
                        $timeNow = new Carbon;
                        $created_at_time = Register::where('token', $token)->first()->created_at;
                        $expiration_date_time = $timeNow->diffInHours($created_at_time);

                        if ($expiration_date_time <= 2) {
                            if ($users_mail_record == null) {
                                // おなじKDメールアドレスは存在しない
                                $user = new User;
                                $user->fill([
                                    'mail' => $mail,
                                    'password' => $password,
                                ])->save();
                                $user_id = $user->id;
                                return view('register.initProfile', compact('user_id'));
                            } else {
                                // 同じKDメールアドレスが存在している
                                // すでに同じメールアドレスが存在している
                                return redirect('already_mail_address_registered'); // エラーページに飛ばす
                            }
                        } else {
                            // 有効期限が切れていますページへ
                            return redirect('no_expiration_date');
                        }
                    } else {
                        abort('404');
                    }
                } else {
                    abort('404');
                }
            }
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function writeProfile(initProfileRequest $request) {
        $profile = new Profile;
        $default_image = 'images/'.'default_image.png';
        $form = $request->all();
        $profile->fill([
            'user_id' => (int)$request->user_id,
            'name' => $request->name,
            'department' => $request->department,
            'course' => $request->course,
            'schoolYear' => $request->schoolYear,
            'icon' => $default_image,
            'text' => $request->text
        ])->save();
        return redirect('login');
    }
}