@extends('layouts.login')

@section('content')

<form action="index.php" method="post">
  <div class="ct-block">
    <textarea name="request-about" id="request-about" cols="60" rows="6" placeholder="何をつぶやこうか...?"></textarea>

    <input class="send-button" type="image" src="button.gif" value="投稿ボタン">
  </div>
</form>

@endsection
