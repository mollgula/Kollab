<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('js/search.js') }}"></script>
    <title>Kollab</title>
</head>

<body>
    @include('components.header')
    <div id="search_room">
        <form id="search_form" action="{{ action('SearchController@user_search') }}" method="GET">
            <img id="search_img" src="{{ asset('image_ui/searching-magnifying-glass.png') }}" alt="">
            <input id="search_text" type="text" placeholder="キーワード検索" name="keyword">
        </form>
    </div>
    <p class="department_name" style="margin-top: 500px;">
        <a href="{{ action('SearchController@department_search', 1) }}">
            ITエキスパート学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 2) }}">
            ITスペシャリスト学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 3) }}">
            情報処理学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 4) }}">
            情報工学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 5) }}">
            情報ビジネス学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 6) }}">
            建築・インテリア
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 7) }}">
            インダストリアルデザイン学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 8) }}">
            グラフィックデザイン学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 9) }}">
            エンターテイメントソフト学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 10) }}">
            ゲームソフト学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 11) }}">
            3DCGアニメーション学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 12) }}">
            デジタルアニメ学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 13) }}">
            声優タレント学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 14) }}">
            サウンドクリエイト学科
        </a>
    </p>
    <p class="department_name">
        <a href="{{ action('SearchController@department_search', 15) }}">
            サウンドテクニック学科
        </a>
    </p>
</body>

</html>
