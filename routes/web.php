<?php

Route::get('/', 'PageController@welcome');
Route::get('/show-login-status', function() {

    $user = Auth::user();
    if($user)
        dump($user->toArray());
    else
        dump('You are not logged in.');
    return;
});



/**
* Task resources
*/
# Index page to show all the tasks
Route::get('/tasks', 'TaskController@index')->name('tasks.index')->middleware('auth');
# Similar to Index page to show all the completed tasks
Route::get('/tasks/completed', 'TaskController@completed')->name('tasks.completed')->middleware('auth');
# Show a form to create a new task
Route::get('/tasks/create', 'TaskController@create')->name('tasks.create')->middleware('auth');
# Process the form to create a new task
Route::post('/tasks', 'TaskController@store')->name('tasks.store');
# Show an individual task
Route::get('/tasks/{title}', 'TaskController@show')->name('tasks.show');
# Show form to edit a task
Route::get('/tasks/{id}/edit', 'TaskController@edit')->name('tasks.edit');
# Process form to edit a task
Route::put('/tasks/{id}', 'TaskController@update')->name('tasks.update');
# Get route to confirm deletion of task
Route::get('/tasks/{id}/delete', 'TaskController@delete')->name('tasks.destroy');
# Delete route to actually destroy the task
Route::delete('/tasks/{id}', 'TaskController@destroy')->name('tasks.index');

Auth::routes();




Route::get('/logout','Auth\LoginController@logout')->name('logout');
