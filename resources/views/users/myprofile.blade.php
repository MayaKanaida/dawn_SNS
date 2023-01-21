@extends('layouts.login')

@section('content')

<form action="myprofile/update" method="post" enctype="multipart/form-data">
  @csrf
  <div>
    <label>Username:</label>
    <input name="username" value="{{$auth->username}}" type="text">
  </div>

  <div>
    <label>MailAddress:</label>
    <input name="mail" value="{{$auth->mail}}" type="text">
  </div>

  <div>
    <label>password:</label>
    <input name="password" value="{{$auth->password}}" readonly>
  </div>

  <div>
    <label>newpassword:</label>
    <input name="newpassword" type="text">
  </div>

  <div>
    <label>Bio:</label>
    <textarea name="bio">{{$auth->bio}}</textarea>
  </div>

  <div>
    <label>Icon Image:</label>
    <input name="iconimage" value="{{$auth->iconimage}}" type="file">
  </div>

<div>
  <input type="submit" value="更新する">
</div>
</form>

@endsection
