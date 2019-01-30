<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Kollab</title>
</head>
<body>
    @include('components.header')
    <main>
        <a href="{{ action('ProfileController@profileGet') }}">
            <div class="home_form">
                <img src="{{ $user_info->icon }}" class="user_image" alt="icon">
                <p class="user_name">{{ $user_info->name }}</p>
                <p class="profile">{{ $user_info->text }}</p>
            </div>
        </a>

        @if($request_user_profiles != null)
            <p class="users_line">フレンドリクエスト</p>
        @endif

        @foreach($request_user_profiles as $request_user_profile)
            <label for="change_curtain{{ $request_user_profile->user_id }}">
                <div class="home_form">
                    <img class="user_image" src="{{ $request_user_profile->icon }}" alt="ユーザ画像">
                    <p class="user_name">{{ $request_user_profile->name }}</p>
                    <p class="profile">{{ $request_user_profile->text }}</p>
                </div>
            </label>

            <!-- ポップアップ -->
            <div>
                <input type="checkbox" id="change_curtain{{ $request_user_profile->user_id }}" class="change_curtain" />
                <label id="brack_curtain" for="change_curtain{{ $request_user_profile->user_id }}">
                    <div id="request_form">
                        <img id="request_image" src="{{ $request_user_profile->icon }}" alt="リクエストユーザ画像">
                        <p id="request_name">{{ $request_user_profile->name }}</p>
                        <div id="request_profile">
                            <p class="profile_d">ニックネーム</p>
                            <p class="profile_h">{{ $request_user_profile->name }}</p>
                            <p class="profile_d">学科</p>
                            @switch($request_user_profile->department)
                                @case('1')
                                    <p class="profile_h">ITエキスパート学科</p>
                                    @break
                                @case('2')
                                    <p class="profile_h">ITスペシャリスト学科</p>
                                    @break
                                @case('3')
                                    <p class="profile_h">情報処理学科</p>
                                    @break
                                @case('4')
                                    <p class="profile_h">情報工学科</p>
                                    @break
                                @case('5')
                                    <p class="profile_h">情報ビジネス学科</p>
                                    @break
                                @case('6')
                                    <p class="profile_h">建築・インテリア</p>
                                    @break
                                @case('7')
                                    <p class="profile_h">インダストリアルデザイン学科</p>
                                    @break
                                @case('8')
                                    <p class="profile_h">グラフィックデザイン学科</p>
                                    @break
                                @case('9')
                                    <p class="profile_h">エンターテイメントソフト学科 </p>
                                    @break
                                @case('10')
                                    <p class="profile_h">ゲームソフト学科</p>
                                    @break
                                @case('11')
                                    <p class="profile_h">3DCGアニメーション学科</p>
                                    @break
                                @case('12')
                                    <p class="profile_h">デジタルアニメ学科</p>
                                    @break
                                @case('13')
                                    <p class="profile_h">声優タレント学科</p>
                                    @break
                                @case('14')
                                    <p class="profile_h">サウンドクリエイト学科</p>
                                    @break
                                @case('15')
                                    <p class="profile_h">サウンドテクニック学科</p>
                                    @break
                                @default
                                    <p class="profile_h">なし</p>
                            @endswitch
                            <p class="profile_d">コース</p>
                            @switch($request_user_profile->department)
                                @case('1')
                                    <p class="profile_h">ITエンジニアコース</p>
                                    @break
                                @case('2')
                                    <p class="profile_h">Webエンジニアコース</p>
                                    @break
                                @case('3')
                                    <p class="profile_h">建築デザインコース</p>
                                    @break
                                @case('4')
                                    <p class="profile_h">インテリアデザインコース</p>
                                    @break
                                @case('5')
                                    <p class="profile_h">グラフィック専攻</p>
                                    @break
                                @case('6')
                                    <p class="profile_h">Web専攻</p>
                                    @break
                                @default
                                    <p class="profile_h">なし</p>
                            @endswitch
                            <p class="profile_d">学年</p>
                            <p class="profile_h">{{ $request_user_profile->schoolYear }}年</p>
                            <p class="profile_d">年齢</p>
                            <p class="profile_h">{{ $request_user_profile->age }}歳</p>
                            <p class="profile_d">自己紹介</p>
                            <p class="profile_h">{{ $request_user_profile->text }}</p>
                        </div>
                        <form action="{{ action('FollowController@allow_follow_requests') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $request_user_profile->user_id }}" />
                            <button id="approval_btn">承認</button>
                        </form>
                        <form action="{{ action('FollowController@do_not_allow_follow_requests') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $request_user_profile->user_id }}" />
                            <button id="rejection_btn">拒否</button>
                        </form>
                    </div>
                </label>
            </div>
        @endforeach

        @if($follow_user_profiles != null)
            <p class="users_line">フレンドユーザー</p>
        @endif

        @foreach($follow_user_profiles as $follow_user_profile)
            <label for="change_curtain_friend{{ $follow_user_profile->user_id }}">
                <div class="home_form">
                    <img class="user_image" src="{{ $follow_user_profile->icon }}" alt="ユーザ画像">
                    <p class="user_name">{{ $follow_user_profile->name }}</p>
                    <p class="profile">{{ $follow_user_profile->text }}</p>
                </div>
            </label>
            <!-- ポップアップ -->
            <div>
                <input type="checkbox" id="change_curtain_friend{{ $follow_user_profile->user_id }}" class="change_curtain_friend" />
                <label id="brack_curtain_friend" for="change_curtain_friend{{ $follow_user_profile->user_id }}">
                    <div id="request_form_friend">
                        <img id="request_image_friend" src="{{ $follow_user_profile->icon }}" alt="リクエストユーザ画像">
                        <p id="request_name_friend">{{ $follow_user_profile->name }}</p>
                        <a href="/otherUserProfile/{{ $follow_user_profile->user_id }}">
                            <button id="details_btn">詳細</button>
                        </a>
                        <form action="{{ action('FollowController@delete_follow_user') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $follow_user_profile->user_id }}"/>
                            <button id="cancellation_btn">フレンドを解消</button>
                        </form>
                    </div>
                </label>
            </div>
        @endforeach
    </main>
</body>
</html>
