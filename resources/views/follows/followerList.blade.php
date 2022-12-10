@extends('layouts.login')

@section('content')

<div>
  @foreach($posts as $post)
  <a href="">
    <img src="/images/{{ $post->images }}" alt="アイコン">
  </a>
  @endforeach
</div>


@endsection
