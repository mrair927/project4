<?php
namespace Project4\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use DB;
use Carbon;
use Project4\Task;
use Project4\User;
use Project4\Group;

class TaskController extends Controller
{
    /**
* GET
*/
public function index(Request $request)
{
    $user = $request->user();
    # Note: We're getting the user from the request, but you can also get it like this:
    //$user = Auth::user();
    if($user) {
        # get all tasks for user logged in
        $tasks = task::where([
          ['user_id', '=', $user->id],
          ['complete', '=', '0'],
          ])->orderBy('id','DESC')->get();
    }
    else {
        $tasks = [];
    }
    return view('task.index')->with([
        'tasks' => $tasks
    ]);
}

public function completed(Request $request)
{
    $user = $request->user();
    # Note: We're getting the user from the request, but you can also get it like this:
    //$user = Auth::user();
    if($user) {
        # get all tasks for user logged in
        $tasks = task::where([
          ['user_id', '=', $user->id],
          ['complete', '=', '1'],
          ])->orderBy('id','DESC')->get();
    }
    else {
        $tasks = [];
    }
    return view('task.completed')->with([
        'tasks' => $tasks
    ]);
}

    /**
    * GET
    */
    public function create()
    {
          $groups = Group::orderBy('place','ASC')->get();
          $groups_for_dropdown = [];
          foreach ($groups as $group) {
            $groups_for_dropdown[$group->id] = $group->place;
          }

          return view('task.create')->with(['groups_for_dropdown' => $groups_for_dropdown]);
}
public function store(Request $request)
{
    # Validate
    $this->validate($request, [
        'title' => 'required|min:3',
        'priority' => 'required|min:0',
    ]);
    # If there were errors, Laravel will redirect the
    # user back to the page that submitted this request
    # The validator will tack on the form data to the request
    # so that it's possible (but not required) to pre-fill the
    # form fields with the data the user had entered
    # If there were NO errors, the script will continue...
    # Get the data from the form
    #$title = $_POST['title']; # Option 1) Old way, don't do this.

    $title = $request->input('title'); # Option 2) USE THIS ONE! :)

    $task = new Task();
    $task->priority = $request->input('priority');
    $task->title = $request->input('title');
    $task->user_id = $request->user()->id;
    $task->group_id = $request->group_id;
    if( $request->has('complete')) {
      $task->complete = '1';
     }
    else{
      $task->complete = '0';
    }

    $task->save();

    Session::flash('flash_message', 'Your task '.$task->title.' was added.');
    return redirect('/tasks');
}

public function show($id)
{
    $task = Task::find($id);
    if(is_null($task)) {
        Session::flash('message','task not found');
        return redirect('task.show');
    }
    return view('task.show')->with([
        'task' => $task
    ]);
}

public function edit($id)
{

      $task = Task::find($id);

      $groups = Group::orderBy('place','ASC')->get();
      $groups_for_dropdown = [];
      foreach ($groups as $group) {
        $groups_for_dropdown[$group->id] = $group->place;
      }

      return view('task.edit')->with([
        'task' => $task,
        'groups_for_dropdown' => $groups_for_dropdown
        ]);

}
public function update(Request $request, $id)
   {
       # Validate
       $this->validate($request, [
           'title' => 'required|min:3',
           'priority' => 'required|min:0',

       ]);
       # Find and update task
       $task = Task::find($request->id);
       $task->title = $request->title;
       $task->priority = $request->priority;
       $task->group_id = $request->group_id;
       if( $request->has('complete')) {
         if ($task->complete == '0'){
           $task->completed_date = Carbon\Carbon::now()->toDateTimeString();
         }
         $task->complete = '1';
        }
       else{
         $task->complete = '0';
       }

       $task->save();
       # Finish
       Session::flash('flash_message', 'Your changes to '.$task->title.' were saved.');
       return redirect('/tasks');
   }
   public function delete($id) {
       $task = task::find($id);
       return view('task.delete')->with('task', $task);
   }
   public function destroy($id)
     {
         # Get the task to be deleted
         $task = Task::find($id);
         if(is_null($task)) {
             Session::flash('message','task not found.');
             return redirect('/tasks');
        }
         # Then delete the task
         $task->delete();
         # Finish
         Session::flash('flash_message', $task->title.' was deleted.');
         return redirect('/tasks');
     }


}
