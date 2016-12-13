
@extends('layouts.master')


@section('title')
    Success!
@stop


@section('content')
    Success! The task {{ $title }} was added.

    <a href='/tasks/create'>Add another one...</a>
@stop
