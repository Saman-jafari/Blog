@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="/posts/create" class="btn btn-primary">Create Posts</a>
                        <h3>You are logged in!</h3>
                            @if(count($posts)>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                    <td>
                                        {!! Form::open(['action' => ['PostController@destroy', $post->id],'method' => 'POST', 'class'=> 'float-right'])!!}
                                        {{FORM::hidden('_method','DELETE')}}
                                        {{FORM::submit('Delete', ['class'=>'btn btn-danger'])}}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                                @else
                                <p>You have no post</p>
                                @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
