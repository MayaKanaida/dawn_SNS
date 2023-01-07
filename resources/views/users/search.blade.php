@extends('layouts.login')

@section('content')

<!-- inputタグで検索窓作成  コマンド押して「め」 -->
<form action="/search" method="post">
  @csrf
<input type="text" name="keyword" placeholder="ユーザー名">
<input type="image" src="images/post.png">
</form>


@foreach ($users_list as $user_list)
  <tr>
    <td>
      <img src="/images/{{ $user_list->images }}" alt="アイコン">
    </td>
    <td>{{ $user_list->username }}</td>

<div>
  @if($followNumbers->contains($user_list->id))
    <form action="/unfollow" method="post">
    @method('delete')
    @csrf
    <input type="hidden" name="follow_id" value="{{ $user_list->id }}">
    <input type="submit" value="フォローはずす">
  </form>
  @else
  <form action="/follow" method="post">
    @csrf
    <input type="hidden" name="follow_id" value="{{ $user_list->id }}">
    <input type="submit" value="フォローする">
  </form>
  @endif
@endforeach
</div>


@endsection
