@extends('layouts.master')

@section('title')
    Edit {{ $task->title }}
@stop

@section('content')

    <h1>Edit {{ $task->title }} </h1>

    <form method='POST' action='/tasks/{{ $task->id }}'>

        {{ method_field('PUT') }}

        {{ csrf_field() }}

        <input name='id' value='{{$task->id}}' type='hidden'>

        <div class='form-group'>
            <label>Title:</label>
            <input
            type='text'
            id='title'
            name='title'
            value='{{ old('title', $task->title) }}'
            >
            <div class='error'>{{ $errors->first('title') }}</div>
        </div>


        <div class='form-group'>
            <label>Date</label>
            <input
            type='text'
            id='date'
            name='date'
            value='{{ old('date' , $task->date) }}'
            >
            <div class='error'>{{ $errors->first('date') }}</div>
        </div>


        <div class='form-group'>
            <label>priority</label>
            <select name='priority_id'>
                @foreach($prioritys_for_dropdown as $priority_id => $priority)
                    <option
                    {{ ($priority_id == $task->priority->id) ? 'SELECTED' : '' }}
                    value='{{ $priority_id }}'
                    >{{ $priority }}</option>
                @endforeach
            </select>
        </div>

        <div class='form-group'>
            <label>Tags</label>
            @foreach($tags_for_checkboxes as $tag_id => $tag_name)
                <input
                type='checkbox'
                value='{{ $tag_id }}'
                name='tags[]'
                {{ (in_array($tag_name, $tags_for_this_task)) ? 'CHECKED' : '' }}
                >
                {{ $tag_name }} <br>
            @endforeach
        </div>


        <div class='form-instructions'>
            All fields are required
        </div>

        <button type="submit" class="btn btn-primary">Save changes</button>


        <div class='error'>
            @if(count($errors) > 0)
                Please correct the errors above and try again.
            @endif
        </div>

    </form>


@stop
