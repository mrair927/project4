@extends('layouts.master')

@section('title')
    Add a new task!
@stop


@section('content')

    <h1>Add a New Task</h1>

    <form method='POST' action='/tasks'>

        {{ csrf_token() }}

        <div class='form-group'>
           <label>Title</label>
            <input
                type='text'
                id='title'
                name='title'
                value='{{ old('title', 'Task to Complete') }}'
            >
           <div class='error'>{{ $errors->first('title') }}</div>
        </div>



        <div class='form-instructions'>
            All fields are required
        </div>

        <button type="submit" class="btn btn-primary">Add Task</button>

        <div class='error'>
            @if(count($errors) > 0)
                Please correct the errors above and try again.
            @endif
        </div>

    </form>


@stop
