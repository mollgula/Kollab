<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
    <title>Kollab</title>
</head>

<body>
    <img id="icon" src="{{ asset('image_ui/Icon2.png') }}" alt="アイコン">
    <p id="error">権限がありません</p>
    <a href="{{ action('LoginController@signinView') }}"><button class="buttoms">ログイン画面へ</button></a>
    <a id="rep_problem" href="https://docs.google.com/forms/d/e/1FAIpQLSenZQSihjkS4W9LP86OwSd2CGmAYlvowEgwpBq7GC6jlrf7OA/viewform?usp=sf_link">問題を報告する</a>
</body>

</html>