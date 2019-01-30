<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Password_reset;
use App\User;
use App\Mail\MailSender;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordChangeRequest;

class PasswordResetController extends Controller
{
    public function index()
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            $token = str_random(40);
            return view('password_reset.password_reset_mail', ['token' => $token]);
                // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function post(PasswordResetRequest $request)
    {
        $option = [
            'to' => $request->mail,
            'subject' => 'Kollabパスワードの変更のメール',
            'template' => 'emails.passwordResetMail',
        ];

        $data = [
            'token' => $request->token,
        ];

        $password_reset = new Password_reset;
        $password_reset->fill([
            'mail' => $request->mail,
            'token' => $request->token
        ])->save();
        Mail::to($option['to'])->send(new MailSender($option, $data));
        return redirect('password_reset_main_mail');
    }

    public function password_reset_main_mail_view()
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            return view('emails.password_reset_main_mail');
            // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function edit($resetToken)
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            $get_token_record = Password_reset::where('token', $resetToken)->first();

            if (isset($get_token_record)) {
                $now = new Carbon;
                $created_at_time = $get_token_record->created_at;
                $expiration_date_time = $now->diffInHours($created_at_time);

                if ($expiration_date_time <= 1) {
                    return view('password_reset.password_reset');
                } else {
                    return redirect('no_expiration_date');
                }
            } else {
                abort('404');
            }
                // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }

    public function update(PasswordChangeRequest $request, $resetToken)
    {
        $token_check_record = Password_Reset::where('token', $resetToken)->first();
        if (isset($token_check_record)) {
            $record_token = $token_check_record->token;
            $mail = Password_Reset::where('token', $resetToken)->first()->mail;

            if (isset($resetToken) && ($resetToken == $record_token))
            {
                $user = User::mail($mail)->first();
                $user->fill([
                    'password' => Hash::make($request->password),
                ])->save();
                return redirect('login');
            } else {
                return redirect('password_reset.not_password_reset');
            }
        } else {
            abort('404');
        }
    }

    public function not_password_reset_view() {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // user agent が iPhone か iPod か Android の場合
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'Android') !== false)) {
            return view('password_reset.not_password_reset');
            // SP版TOPにリダイレクト
        } else { // user agent が それ以外 (例: iPad, PC) の場合
            return redirect('pc_page'); // PC版TOPを表示
        }
    }
}
