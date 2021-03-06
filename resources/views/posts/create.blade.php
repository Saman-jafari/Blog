@extends('layouts.app')

@section('content')
    <h1>Create Form</h1>
    {!! Form::open(['action' => 'PostController@store', 'method' => 'POST', 'enctype'=> 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title','',['class'=>'form-control', 'placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body','',['id' => 'article-ckeditor','class'=>'form-control', 'placeholder'=>'Body Text' ])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>
    <div class="form-group">
        <label for="publishDate">Publish Time</label>
        <input id="publishDate" type="datetime-local" name="datePublish" value="{{\Carbon\Carbon::now()->format('Y-m-d\TH:i')}}">
    </div>
    {{Form::submit('Submit',['class' => 'btn btn-primary'] )}}
    {!! Form::close() !!}
@endsection
