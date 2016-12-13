@extends('layouts.master')

@section('title')
    Confirm deletion: {{ $task->title }}
@endsection

@section('content')

    <h1>Confirm deletion</h1>
    <form method='POST' action='/tasks/{{ $task->id }}'>

        {{ method_field('DELETE') }}

        {{ csrf_field() }}

        <h2>Are you sure you want to delete <em>{{ $task->title }}</em>?</h2>

        <input type='submit' value='Yes'>

    </form>

@endsection
