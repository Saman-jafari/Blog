@extends('layouts.app')

@section('content')
    <h1>Memes</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card card-body bg-light">
                <div class="row">
                    <div class="col-md-4 col-sm-4 m-auto">
                        <a href="/posts/{{$post->id}}"><img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}"  alt=""></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4 m-auto">
                        <h3>
                            <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                        </h3>
                        <small>Written on {{$post->created_at}} by {{$post->user->name}} will be published at {{$post->date_publish}}</small>
                    </div>
                </div>

            </div>

        @endforeach
        {{$posts->links()}}
    @else
        <p>nothing found</p>

    @endif
@endsection
