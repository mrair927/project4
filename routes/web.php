<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/show-login-status', function() {
    # You may access the authenticated user via the Auth facade
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
Route::get('/tasks', 'taskController@index')->name('tasks.index')->middleware('auth');
# Show a form to create a new task
Route::get('/tasks/create', 'taskController@create')->name('tasks.create')->middleware('auth');
# Process the form to create a new task
Route::post('/tasks', 'taskController@store')->name('tasks.store');
# Show an individual task
Route::get('/tasks/{title}', 'taskController@show')->name('tasks.show');
# Show form to edit a task
Route::get('/tasks/{id}/edit', 'taskController@edit')->name('tasks.edit');
# Process form to edit a task
Route::put('/tasks/{id}', 'taskController@update')->name('tasks.update');
# Get route to confirm deletion of task
Route::get('/tasks/{id}/delete', 'taskController@delete')->name('tasks.destroy');
# Delete route to actually destroy the task
Route::delete('/tasks/{id}', 'taskController@destroy')->name('tasks.destroy');

Auth::routes();

Route::get('/home', 'HomeController@index');
