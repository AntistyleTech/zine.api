@extends('post::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('post.name') !!}</p>
@endsection
