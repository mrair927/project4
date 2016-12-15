@extends('layouts.master')

@section('title')
    {{ $task->title }}
@endsection

@section('head')
    <link href='/css/task.css' rel='stylesheet'>
@endsection

@section('content')

<div id='tasks' class='cf'>

            <section class='task'>
                <a href='/tasks/{{ $task->id }}'><h2 class='truncate'>{{ $task->title }}</h2></a>

    <h4 class='truncate'>Priority: {{ $task->priority}}</h4>
    <h4 class='truncate'>Catagory: {{ $task->group->place}}</h4>

    <a class='button' href='/tasks/{{ $task->id }}/edit'><i class='fa fa-pencil'></i> Edit</a>
    <a class='button' href='/tasks/{{ $task->id }}/delete'><i class='fa fa-trash'></i> Delete</a>

    <br><br>
    <a class='return' href='/tasks'>&larr; Return to all tasks</a>
</div>
@endsection
