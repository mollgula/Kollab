<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <link rel="stylesheet" href="{{ asset('css/sign_up.css') }}">
    <title>Kollab</title>
</head>

<body>
    <img id="icon" src="image_ui/Icon2.png" alt="アイコン">
    <form action="{{ action('MailController@post') }}" method="post">
        @csrf
        @if ($errors->has('mail'))
            <p class="error_mail_text">{{ $errors->first('mail') }}</p>
        @endif
        <input type="text" class="signin_form" name="mail" id="mail_form" placeholder="KDメールアドレス" value="@st.kobedenshi.ac.jp">
        @if ($errors->has('password'))
            <p class="error_password_text">{{ $errors->first('password') }}</p>
        @endif
        <input type="password" class="signin_form" name="password" id="pass_form" placeholder="パスワード" value="{{ old('password') }}">
        @if ($errors->has('confirm_password'))
            <p class="error_confirm_password_text">{{ $errors->first('confirm_password') }}</p>
        @endif
        <input type="password" class="signin_form" name="confirm_password" id="pass2_form" placeholder="パスワード再確認" value="{{ old('confirm_password') }}">
        @if ($errors->has('token'))
            <p class="error_token_text">{{ $errors->first('token') }}</p>
        @endif
        <input type="hidden" name="token" value="{{ $token }}" />
        <button id="submit_button" class="button">新規登録</button>
    </form>
</body>
</html>