@extends('layouts.logout')

@section('content')


<div class="logout_main">


<form method="POST" action="/login">
  <!-- セキュリティ対策　bladeに必要　formタグがあればその中に入れる -->
  @csrf


<div class="login_logout">
<p class="welcom">DAWNSNSへようこそ</p>



 <div class="mail_password">
  <label for="e-mail" class="label">MailAddress</label>

  <input class="input" name="mail" type="text">

  <label for="password" class="label">Password</label>

  <input class="input" name="password" type="password" value="" id="password">


  </div>
  <input class="login" type="submit" value="ログイン">


  </div>

<p class="welcom_2"><a href="/register">新規ユーザーの方はこちら</a></p>


</form>

</div>

@endsection
