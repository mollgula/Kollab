<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('image_ui/fabicon.png') }}" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_edit.css') }}">
    <title>Kollab</title>
</head>

<body>
    @include('components.header')
    <main>
        <div class="home_form">
            <img class="user_image" src="{{ $profile_info->icon }}" alt="ユーザ画像">
            <p class="user_name">{{ $profile_info->name }}</p>
        </div>

        <form action="{{ action('ProfileController@updateProfile') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $userId }}" />
            <p class="profile_d">ニックネーム</p>
            @if ($errors->has('name'))
                <p class="profile_h">{{ $errors->first('name') }}</p>
            @endif
            <input type="text" id="user_nickname" class="form-control" name="name" value="{{ $profile_info->name }}">

            <p class="profile_d">プロフィール画像</p>
            @if ($errors->has('icon'))
                <p class="profile_h">{{ $errors->first('icon') }}</p>
            @endif
            <label for="lefile" class="label_icon">
                <p class="choice">選択してください</p>
                <input type="file" id="lefile" name="icon" accept="image/jpg,image/jpeg,image/png" style="display: none;">
            </label>
            <img id="preview">

            <p class="profile_d">学科</p>
            @if ($errors->has('department'))
                <p class="profile_h">{{ $errors->first('department') }}</p>
            @endif
            <select id="user_department" class="form-control" name="department">
                <option value="{{ $profile_info->department }}" selected>{{ $department_name }}</option>
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

            <p class="profile_d">コース</p>
            <select id="user_couse" class="form-control" name="course">
                <option value="{{ $profile_info->course }}" selected>{{ $course }}</option>
                <option value="1">ITエンジニアコース</option>
                <option value="2">Webエンジニアコース</option>
                <option value="3">建築デザインコース</option>
                <option value="4">インテリアデザインコース</option>
                <option value="5">グラフィック専攻</option>
                <option value="6">Web専攻</option>
            </select>

            <p class="profile_d">学年</p>
            <select id="user_schoolyear" class="form-control" name="schoolYear">
                <option value="{{ $profile_info->schoolYear }}" selected>{{ $profile_info->schoolYear }}</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>

            <p class="profile_d">性別</p>
            <select id="user_sex" class="form-control" name="sex">
                <option value="{{ $profile_info->sex }}" selected>{{ $profile_info->sex }}</option>
                <option value="男">男</option>
                <option value="女">女</option>
            </select>

            <p class="profile_d">年齢</p>
            <input type="number" id="user_age" class="form-control" name="age" value="{{ $profile_info->age }}"/>

            <p class="profile_d">自己紹介</p>
            <textarea  id="user_profile" class="form-control" name="text" cols="30" rows="10">{{ $profile_info->text }}</textarea>
            <button id="edit_btn">プロフィールを変更する</button>
        </form>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="{{ asset('js/profile_edit.js') }}"></script>
</body>

</html>