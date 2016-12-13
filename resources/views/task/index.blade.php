@extends('layouts.master')

@section('head')
    <link href='/css/task.css' rel='stylesheet'>
@endsection

@section('title')
    View all Tasks
@endsection

@section('content')

    <h1>All the tasks</h1>

    @if(sizeof($tasks) == 0)
        You have not added any tasks, you can <a href='/tasks/create'>add a task now to get started</a>.
    @else
        <div id='tasks' class='cf'>
            @foreach($tasks as $task)

                <section class='task'>
                    <a href='/tasks/{{ $task->id }}'><h2 class='truncate'>{{ $task->title }}</h2></a>


                    ##<h3 class='truncate'>{{ $task->author->first_name }} {{ $task->author->last_name }}</h3>
                    <h3 class='truncate'>{{ $task->date }}</h3>

                    <div class='tags'>
                        @foreach($task->tags as $tag)
                            <div class='tag'>{{ $tag->name }}</div>
                        @endforeach
                    </div>

                    <a class='button' href='/tasks/{{ $task->id }}/edit'><i class='fa fa-pencil'></i> Edit</a>
                    <a class='button' href='/tasks/{{ $task->id }}'><i class='fa fa-eye'></i> View</a>
                    <a class='button' href='/tasks/{{ $task->id }}/delete'><i class='fa fa-trash'></i> Delete</a>
                </section>
            @endforeach
        </div>
    @endif
