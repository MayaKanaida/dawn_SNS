@extends('layouts.login')

@section('content')

<!-- フォロワーリストのアイコンを表示 -->
<div>
  @foreach($users as $user)
  <a href="profile/{{ $user->id }}">
    <img src="/images/{{ $user->images }}" alt="アイコン">
  </a>
  @endforeach
</div>

<!-- フォロワーリストのアイコン、名前、投稿、時間を表示 -->
<table>
@foreach ($posts as $post)
  <tr>
    <td>
      <img src="/images/{{ $post->images }}" alt="アイコン">
    </td>
    <td>{{ $post->username }}</td>
    <td>{{ $post->posts }}</td>
    <td>{{ $post->created_at }}</td>
  </tr>
@endforeach
</table>

@endsection
