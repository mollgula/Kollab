<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Kollab</title>
</head>
<body>
    <img id="icon" src="{{ asset('image_ui/Icon2.png') }}" alt="アイコン">
        <form action="login" method="post">
            @csrf
            @if(isset($msg))
                <p class="error_mail_text">{{ $msg }}</p>
            @endif
            @if($errors->has('mail'))
                <p class="error_mail_text">{{ $errors->first('mail') }}</p>
            @endif
            <input type="text" name="mail" value="@st.kobedenshi.ac.jp" placeholder="KDメールアドレス" class="login_form" id="mail_form" />
            @if($errors->has('password'))
                <p class="error_password_text">{{ $errors->first('password') }}</p>
            @endif
            <input type="password" name="password" class="login_form" id="pass_form" placeholder="パスワード"/>
            <input type="checkbox" name="remember_me" value="true" class="remember_me" id="remember_me"/>
            <p class="remember_me_text" id="remember_me_text">ログインを保持する</p>
            <button id="login_buttom">ログイン</button>
            <span id="pass_forget">パスワードを<a href="password_reset">お忘れ</a>ですか？ ｜</span>
            <a id="signup_buttom" href="signup">新規登録</a>
            <span id="info_msg">お問い合わせは<a href="https://docs.google.com/forms/d/e/1FAIpQLSenZQSihjkS4W9LP86OwSd2CGmAYlvowEgwpBq7GC6jlrf7OA/viewform?usp=sf_link">こちら</a>から</span>
        </form>
    </body>
</html>