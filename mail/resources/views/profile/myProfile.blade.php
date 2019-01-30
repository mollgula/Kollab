<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>Kollab</title>
</head>

<body>
    @include('components.header')

    <main>
        <div class="home_form">
            <img class="user_image" src="{{ $profile_info->icon }}" alt="icon">
            <p class="user_name">{{ $profile_info->name }}</p>
        </div>
        @if(isset($profile_info->name))
            <p class="profile_d">ニックネーム</p>
            <p class="profile_h">{{ $profile_info->name }}</p>
        @endif
        @if(isset($department_name))
            <p class="profile_d">学科</p>
            <p class="profile_h">{{ $department_name }}</p>
        @endif
        @if(isset($course))
            <p class="profile_d">コース・専攻</p>
            <p class="profile_h">{{ $course }}</p>
        @endif
        @if(isset($profile_info->schoolYear))
            <p class="profile_d">学年</p>
            <p class="profile_h">{{ $profile_info->schoolYear }}年</p>
        @endif
        @if(isset($profile_info->age))
            <p class="profile_d">年齢</p>
            <p class="profile_h">{{ $profile_info->age }}歳</p>
        @endif
        @if(isset($profile_info->sex))
            <p class="profile_d">性別</p>
            <p class="profile_h">{{ $profile_info->sex }}</p>
        @endif
        @if(isset($profile_info->text))
            <p class="profile_d">自己紹介文</p>
            <p class="profile_h">{{ $profile_info->text }}</p>
        @endif
        <a href="{{ action('ProfileController@editProfileView') }}">
            <button id="edit_btn">プロフィールを編集する</button>
        </a>
        <a href="{{ action('LoginController@logout') }}">
            <button class="logout_button">ログアウト</button>
        </a>
    </main>

</body>

</html>