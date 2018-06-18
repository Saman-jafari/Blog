@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="">
        <img class="img-responsive d-flex m-auto" src="/images/8memesaday.jpg" alt="">
        </div>
        <h1 >{{$title}}</h1>
        <p class="lead">8memesaday</p>
        <hr class="my-4">
        <p>blah blah</p>
        <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
    </div>
    @endsection