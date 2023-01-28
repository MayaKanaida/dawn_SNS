<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div id = "head">
        <h1><a><img src="{{asset('images/main_logo.png')}}"></a></h1>
            <div id="">
                <div id="">
                    <p class="login_name">{{ $auth->username }}さん<img src="{{asset('images/'.$auth->images)}}"></p>
                <div class="switching">
                <ul>
                    <li><a href="/top">ホーム</a></li>
                    <li><a href="/myprofile">プロフィール</a></li>
                    <li><a href="/logout">ログアウト</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p class="users">{{ $auth->username }}さんの</p>
                <div>
                <p class="follow_number">フォロー数</p>
                <p class="number">{{ $followCount }}名</p>
                </div>
                <p class="btn_1"><a href="/followList" >フォローリスト</a></p>
                <div>
                <p class="follower_number">フォロワー数</p>
                <p class="number_2">{{ $followerCount }}名</p>
                </div>
                <p class="btn_2"><a href="/followerList">フォロワーリスト</a></p>
            </div>
            <p class="btn_3"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="js/style.js"></script>
</body>
</html>
