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
        <p class="password_change_msg">パスワード変更</p>
        <form action="" method="post">
            @csrf
            @if ($errors->has('password'))
                <p class="error_password_text">{{ $errors->first('password') }}</p>
            @endif
            <input type="password" id="mail_form" class="login_form" name="password" value="{{ old('password') }}" />
            <button id="login_buttom">変更する</button>
        </form>
    </body>
</html>