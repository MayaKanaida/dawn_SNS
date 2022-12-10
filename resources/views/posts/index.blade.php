@extends('layouts.login')

@section('content')

<form action="/create" method="post">
  @csrf
  <div class="ct-block">
    <textarea name="newPost" id="request-about" cols="60" rows="6" placeholder="何をつぶやこうか...?"></textarea>

    <input class="send-button" type="image" src="images/post.png">
  </div>
</form>

<table>
  @foreach ($posts as $post)
  <tr>
    <td>
      <img src="/images/{{ $post->images }}" alt="アイコン">
    </td>
    <td>{{ $post->username }}</td>
    <td>{{ $post->posts }}</td>
    <td>{{ $post->created_at }}</td>

     <td>
      <div class="modalopen"  data-target="{{$post->id}}">
        <img src="/images/edit.png" alt="編集ボタン">
      </div>
    </td>

<tr>
  <td>
    <div class="modal-main js-modal" id="{{$post->id}}">
      <div class="modal-inner">
        <div class="inner-content">

        <form action="/post/update" method="post">
          @csrf
          <input type="hidden" name="id" value="{{$post->id}}">
          <input type="text" name="upPost" value="{{$post->posts}}" class="form-control" required>
          <input class="send-button" type="image" src="images/edit.png">
        </form>

        <div class="form-group">
        </div>

        <a class="modalClose">Close</a>

    </div>
  </div>
</div>
</td>
</tr>
    <td>
      <a href="delete/{{ $post->id }}"><img src="/images/trash_h.png" alt="削除ボタン"></a>
    </td>


     </tr>
   @endforeach
</table>
@endsection
