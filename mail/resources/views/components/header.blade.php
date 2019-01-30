<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<header>
    <a href="{{ action('HomeController@homeView') }}"><img id="home_icon" src="{{ asset('image_ui/home_whtite.png') }}" alt="ホームアイコン"></a>
    <a href="{{ action('ChatController@chat_member_list_view') }}"><img id="chat_icon" src="{{ asset('image_ui/chat_whtite.png') }}" alt="チャットアイコン"></a>
    <a href="{{ action('HomeController@still_add_function') }}"><img id="white_icon" src="{{ asset('image_ui/contract_whtite.png') }}" alt="書き込みアイコン"></a>
    <a href="{{ action('SearchController@user_search') }}"><img id="search_icon" src="{{ asset('image_ui/searching_whtite.png') }}" alt="検索アイコン"></a>
</header>
