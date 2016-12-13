<?php
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    //print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});

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
