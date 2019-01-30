<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <link rel="stylesheet" href="{{ asset('css/password_reset.css') }}">
    <title>Kollab</title>
</head>
<body>
    <img id="icon" src="{{ asset('image_ui/Icon2.png') }}" alt="アイコン">
        <p class="password_mail_send_msg">パスワード変更メールを送ります</p>
        <form action="password_reset" method="post">
            @csrf
            @if($errors->has('mail'))
                <p class="error_mail_text">{{ $errors->first('mail') }}</p>
            @endif
            <input type="text" id="mail_form" class="login_form" placeholder="KDメールアドレス" value="@st.kobedenshi.ac.jp" name='mail'/>
            @if ($errors->has('token'))
                <p class="error_password_text">{{ $errors->first('token') }}</p>
            @endif
            <input type="hidden" name="token" value="{{ $token }}" />
            <button id="login_buttom">送信する</button>
        </form>
    </body>
</html>
