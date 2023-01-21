@extends('layouts.login')

@section('content')
<div>
  <img src="/storage/{{ $profile_user->images }}" alt="アイコン">
  <p>{{ $profile_user->username }}</p>
  <p>{{ $profile_user->bio }}</p>
  @if($followNumbers->contains($profile_user->id))
    <form action="/unfollow" method="post">
    @method('delete')
    @csrf
    <input type="hidden" name="follow_id" value="{{ $profile_user->id }}">
    <input type="submit" value="フォローはずす">
  </form>
  @else
  <form action="/follow" method="post">
    @csrf
    <input type="hidden" name="follow_id" value="{{ $profile_user->id }}">
    <input type="submit" value="フォローする">
  </form>
  @endif
</div>

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
