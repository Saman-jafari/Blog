@extends('layout.app')

@section('content')
    <a href="/posts" class="btn btn-primary">Go back</a>
    <h1>{{$post->title}}</h1>
    <div>
        {{--thiis will parse html {!!  !!}--}}
        {!! $post->body !!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>

@endsection
