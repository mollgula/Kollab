<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
    <title>Kollab</title>
</head>

<body>
    @include('components.header')
    <main>
        <div id="message_list" class="auto_scroll">
            @foreach($messages as $message)
                @if ($message->user_id == $user_id)
                    <div class="my">
                        <p class="my_msg">{{ $message->content }}</p>
                    </div>
                @else
                    <div class="partner">
                        <a href="/otherUserProfile/{{ $message->user_id }}">
                            <img class="partner_image" src="{{ $partner_user_icon }}" alt="icon">
                        </a>
                        <p class="partner_name">{{ $partner_user_profile->name }}</p>
                        <p class="partner_msg">{{ $message->content }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </main>
    <footer>
        <div id="chat">
            <input type="hidden" id="chat_id" value="{{ $chat_id->id }}" name="chat_id">
            <input type="text" id="message" class="input_text" placeholder="" name="send_message">
            <button id="send" class="input_button">送信</button>
        </div>
    </footer>
</body>

</html>