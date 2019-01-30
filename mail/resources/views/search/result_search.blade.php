<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <title>Kollab</title>
</head>

<body>
    @include('components.header')

    <div id="search_room">
        <form id="search_form" action="{{ action('SearchController@user_search') }}" method="GET">
            <img id="search_img" src="{{ asset('image_ui/searching-magnifying-glass.png') }}" alt="">
            <input id="search_text" type="text" value="{{ $keyword }}" name="keyword">
        </form>
    </div>

    <main>
        @if($users == null)
            <p class="not_find_search_msg">{{ $not_find_search_msg }}</p>
        @endif

        @if(isset($follow_users_profile))
            @foreach($follow_users_profile as $follow_user_profile)
                <div class="users_form">
                    <img src="{{ $follow_user_profile->icon }}" alt="icon" class="user_image">
                    <a href="{{ action('ProfileController@otherUserProfileView', $follow_user_profile->user_id) }}" class="user_name">
                        {{ $follow_user_profile->name }}
                    </a>
                    <p class="profile">{{ $follow_user_profile->text }}</p>
                </div>
            @endforeach
        @endif

        @if(isset($follow_requesting_users_profile))
            @foreach($follow_requesting_users_profile as $follow_requesting_user_profile)
                <div class="users_form">
                    <img src="{{ $follow_requesting_user_profile->icon }}" alt="icon" class="user_image">
                    <a href="{{ action('ProfileController@otherUserProfileView', $follow_requesting_user_profile->user_id) }}" class="user_name">
                        {{ $follow_requesting_user_profile->name }}
                    </a>
                    <p class="profile">{{ $follow_requesting_user_profile->text }}</p>
                    <button class="requ_buttom_me" disabled>フレンドリクエストが届いています</button>
                </div>
            @endforeach
        @endif

        @if(isset($follow_requested_users_profile))
            @foreach($follow_requested_users_profile as $follow_requested_user_profile)
                <div class="users_form">
                    <img src="{{ $follow_requested_user_profile->icon }}" alt="icon" class="user_image">
                    <a href="{{ action('ProfileController@otherUserProfileView', $follow_requested_user_profile->user_id) }}" class="user_name">
                        {{ $follow_requested_user_profile->name }}
                    </a>
                    <p class="profile">{{ $follow_requested_user_profile->text }}</p>
                    <button class="requ_buttom_me" disabled>フレンドリクエスト中</button>
                </div>
            @endforeach
        @endif

        @if(isset($not_follow_users_array))
            @foreach($not_follow_users_array as $not_follow_user_array)
                <div class="users_form">
                    <img src="{{ $not_follow_user_array["icon"] }}" alt="icon" class="user_image">
                    <a href="{{ action('ProfileController@otherUserProfileView', $not_follow_user_array["user_id"]) }}" class="user_name">
                        {{ $not_follow_user_array["name"] }}
                    </a>
                    <p class="profile">{{ $not_follow_user_array["text"] }}</p>
                    <input type="hidden" value="{{ $not_follow_user_array["user_id"]}}" class="follow_id">
                    <input type="hidden" value="{{ csrf_token() }}" id="token">
                    <button class="follow requ_buttom_me" onclick="this.disabled = true;">フォロー</button>
                </div>
            @endforeach
        @endif
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/follow.js') }}"></script>
</body>

</html>
