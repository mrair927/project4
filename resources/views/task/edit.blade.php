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
            <label>Priority Level</label>
            <input
            type='text'
            id='priority'
            name='priority'
            value='{{ old('priority' , $task->priority) }}'
            >
            <div class='error'>{{ $errors->first('priority') }}</div>
        </div>

        <div class='form-group'>
            <label>Category</label>
            <select name='group_id'>
                @foreach($groups_for_dropdown as $group_id => $group)
                <option
                {{ ($group_id == $task->group->id) ? 'SELECTED' : '' }}
                value='{{ $group_id }}'
                >{{ $group }}</option>
                @endforeach
            </select>
        </div>

        <div class='form-group'>
            <label>Completed</label>
             <input
              type='checkbox'
              id='complete'
              name='complete'
              {{ ($task->complete == 1) ? 'CHECKED' : '' }}
              >
            <div class='error'>{{ $errors->first('complete') }}</div>
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
