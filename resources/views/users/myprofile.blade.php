<form action="myprofile/update" method="post" enctype="multipart/form-data">
  @csrf
  <div>
    <label>Username:</label>
    <input name="username" value="{{$user->username}}" type="text">
  </div>

  <div>
    <label>MailAddress:</label>
    <input name="mail" value="{{$user->mail}}" type="text">
  </div>

  <div>
    <label>password:</label>
    <input name="password" value="{{$user->password}}" readonly>
  </div>

  <div>
    <label>newpassword:</label>
    <input name="newpassword" type="text">
  </div>

  <div>
    <label>Bio:</label>
    <textarea name="bio">{{$user->bio}}</textarea>
  </div>

  <div>
    <label>Icon Image:</label>
    <input name="iconimage" value="{{$user->iconimage}}" type="file">
  </div>



</form>
