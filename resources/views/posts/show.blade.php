@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary">Go back</a>
    <h1>{{$post->title}}</h1>
    <img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}" alt="">
    <br>
    <br>
    <div>
        {{--thiis will parse html {!!  !!}--}}
        {!! $post->body !!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id === $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
        {!! Form::open(['action' => ['PostController@destroy', $post->id],'method' => 'POST', 'class'=> 'float-right'])!!}
        {{FORM::hidden('_method','DELETE')}}
        {{FORM::submit('Delete', ['class'=>'btn btn-danger'])}}
        {!! Form::close() !!}
            @endif
    @endif
@endsection
