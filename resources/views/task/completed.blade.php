
@extends('layouts.master')

@section('head')
    <link href='/css/task.css' rel='stylesheet'>
@endsection

@section('title')
  All The Tasks
@endsection

@section('content')

    <h1>Here's a List of the Tasks You Have Completed:</h1>

    @if(sizeof($tasks) == 0)
        You have not added any tasks, you can <a href='/tasks/create'>add a task now to get started</a>.
    @else
        <div id='tasks' class='cf'>
            @foreach($tasks as $task)

                <section class='task'>
                    <a href='/tasks/{{ $task->id }}'><h2 class='truncate'>{{ $task->title }}</h2></a>
                    <h3>Completed Date: {{$task->completed_date}}</h3>


                    <a class='button' href='/tasks/{{ $task->id }}/edit'><i class='fa fa-pencil'></i> Edit</a>
                    <a class='button' href='/tasks/{{ $task->id }}'><i class='fa fa-eye'></i> View</a>
                    <a class='button' href='/tasks/{{ $task->id }}/delete'><i class='fa fa-trash'></i> Delete</a>
                </section>
            @endforeach
        </div>
    @endif
@endsection
