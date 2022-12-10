@extends('layouts.login')

@section('content')

<div>
  @foreach($posts as $post)
  <a href="">
    <img src="/images/{{ $post->images }}" alt="アイコン">
  </a>
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
