<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/friend_profile.css') }}">
    <title>Kollab</title>
</head>

<body>
    @include('components.header')
    <main>
        @if(isset($otherUserProfileInfo))
            <div class="home_form">
                <img class="user_image" src="{{ $otherUserProfileIcon }}" alt="icon">
                <p class="user_name">{{ $otherUserProfileInfo->name }}</p>
            </div>
            @if(isset($otherUserProfileInfo->name))
                <p class="profile_d">ニックネーム</p>
                <p class="profile_h">{{ $otherUserProfileInfo->name }}</p>
            @endif
            @if(isset($department))
                <p class="profile_d">学科</p>
                <p class="profile_h">{{ $department }}</p>
            @endif
            @if(isset($course))
                <p class="profile_d">コース</p>
                <p class="profile_h">{{ $course }}</p>
            @endif
            @if(isset($otherUserProfileInfo->schoolYear))
                <p class="profile_d">学年</p>
                <p class="profile_h">{{ $otherUserProfileInfo->schoolYear }}年</p>
            @endif
            @if(isset($otherUserProfileInfo->age))
                <p class="profile_d">年齢</p>
                <p class="profile_h">{{ $otherUserProfileInfo->age }}歳</p>
            @endif
            @if(isset($otherUserProfileInfo->sex))
                <p class="profile_d">性別</p>
                <p class="profile_h">{{ $otherUserProfileInfo->sex }}</p>
            @endif
            @if(isset($otherUserProfileInfo->text))
                <p class="profile_d">自己紹介文</p>
                <p class="profile_h">{{ $otherUserProfileInfo->text }}</p>
            @endif
        @endif
    </main>

</body>

</html>