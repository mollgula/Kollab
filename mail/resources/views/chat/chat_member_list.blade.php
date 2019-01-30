<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/chathome.css') }}">
    <title>Kollab</title>
</head>

<body>
    @include('components.header')
    <main>
        @if(isset($chat_members_list))
            @foreach($chat_members_list as $chat_member_list)
                    <div class="chat_form">
                        <a href="{{ action('ProfileController@otherUserProfileView', $chat_member_list->user_id) }}">
                            <img class="user_image" src="{{ $chat_member_list->icon }}" alt="ユーザ画像">
                        </a>
                        <a href="{{ action('ChatController@chat', $chat_member_list->user_id) }}">
                            <p class="user_name">{{ $chat_member_list->name }}</p>
                        </a>
                    </div>
            @endforeach
        @else
            <p id="not_frient">現在、友達は登録されていません。気になった人にリクエストを送りましょう </p>
        @endif
    </main>
</body>
</html>