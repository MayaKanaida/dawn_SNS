@extends('layouts.login')

@section('content')
<div>
@foreach($posts->unique('id') as $post)
  <img src="/storage/{{ $post->images }}" alt="アイコン">
  <p>{{ $post->username }}</p>
  <p>{{ $post->bio }}</p>
  @if($followNumbers->contains($post->id))
    <form action="/unFollow" method="post">
    @method('delete')
    @csrf
    <input type="hidden" name="follow_id" value="{{ $post->id }}">
    <input type="submit" value="フォローはずす">
  </form>
  @else
  <form action="/follow" method="post">
    @csrf
    <input type="hidden" name="follow_id" value="{{ $post->id }}">
    <input type="submit" value="フォローする">
  </form>
  @endif
@endforeach
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
