<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <link rel="stylesheet" href="{{ asset('css/init_profile.css') }}">
    <title>Kollab</title>
</head>

<body>
    <p id="descri">まずはプロフィールを記入しましょう</p>
    <p id="descri2">(＊)は必須項目です</p>
    <form action="{{ 'MailController@writeProfile' }}" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user_id }}" />
        <p id="name_descri">・ニックネーム＊</p>
        @if ($errors->has('name'))
            <p class="error_name_text">・{{ $errors->first('name') }}</p>
        @endif
        <input type="text" name="name" id="name_form" value="{{ old('name') }}">

        <p id="gakka_descri">・学科＊</p>
        @if ($errors->has('department'))
            <p class="error_department_text">・{{ $errors->first('department') }}</p>
        @endif
        <select name="department" id="gakka_form">
            <option value="" selected>選択してください</option>
            <option value="1">ITエキスパート学科</option>
            <option value="2">ITスペシャリスト学科</option>
            <option value="3">情報処理学科</option>
            <option value="4">情報工学科</option>
            <option value="5">情報ビジネス学科</option>
            <option value="6">建築・インテリア</option>
            <option value="7">インダストリアルデザイン学科</option>
            <option value="8">グラフィックデザイン学科</option>
            <option value="9">エンターテイメントソフト学科</option>
            <option value="10">ゲームソフト学科</option>
            <option value="11">3DCGアニメーション学科</option>
            <option value="12">デジタルアニメ学科</option>
            <option value="13">声優タレント学科</option>
            <option value="14">サウンドクリエイト学科</option>
            <option value="15">サウンドテクニック学科</option>
        </select>

        <p id="course_descri">・コース・専攻＊</p>
        <select name="course" id="course_form">
            <option value="" selected>選択してください</option>
            <option value="1">ITエンジニアコース</option>
            <option value="2">Webエンジニアコース</option>
            <option value="3">建築デザインコース</option>
            <option value="4">インテリアデザインコース</option>
            <option value="5">紙専攻</option>
            <option value="6">Web専攻</option>
        </select>

        <p id="schoolyear_descri">・学年＊</p>
        @if ($errors->has('schoolYear'))
            <p class="error_schoolYear_text">・{{ $errors->first('schoolYear') }}</p>
        @endif
        <select name="schoolYear" id="schoolyear_form">
            <option value="" selected>選択してください</option>
            <option value="1">1年</option>
            <option value="2">2年</option>
            <option value="3">3年</option>
            <option value="4">4年</option>
        </select>

        <p id="profile_descri">・自己紹介文＊</p>
        <textarea name="text" id="profile_form" cols="30" rows="10"></textarea>
        <button id="sub_button">記入完了</button>
    </form>

</body>

</html>