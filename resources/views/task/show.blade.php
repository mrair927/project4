@extends('layouts.master')

@section('title')
    {{ $task->title }}
@endsection

@section('head')
    <link href='/css/task.css' rel='stylesheet'>
@endsection

@section('content')

    <h1 class='truncate'>{{ $task->title }}</h1>
    <h2 class='truncate'>{{ $task->priority}}</h2>
    <h2 class='truncate'>{{ $task->group->place}}</h2>

    <a class='button' href='/tasks/{{ $task->id }}/edit'><i class='fa fa-pencil'></i> Edit</a>
    <a class='button' href='/tasks/{{ $task->id }}/delete'><i class='fa fa-trash'></i> Delete</a>

    <br><br>
    <a class='return' href='/tasks'>&larr; Return to all tasks</a>

@endsection
