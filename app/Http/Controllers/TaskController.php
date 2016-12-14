<?php
namespace Project4\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use DB;
use Carbon;
use App\Task;

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
        # Approach 1)
        $tasks = task::where('user_id', '=', $user->id)->orderBy('id','DESC')->get();
        # Approach 2) Take advantage of Model relationships
        #$tasks = $user->tasks()->get();
    }
    else {
        $tasks = [];
    }
    return view('task.index')->with([
        'tasks' => $tasks
    ]);
}
    /**
    * GET
    */
    public function create()
    {
          return view('task.create');
}
public function store(Request $request)
{
    # Validate
    $this->validate($request, [
        'title' => 'required|min:3',
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
    $task->title = $request->input('title');
    $task->user_id = $request->user()->id;
    $task->save();

    Session::flash('flash_message', 'Your task '.$task->title.' was added.');
    return redirect('/tasks');
}

public function show($id)
{
    $task = Task::find($id);
    if(is_null($task)) {
        Session::flash('message','task not found');
        return redirect('/tasks');
    }
    return view('task.show')->with([
        'task' => $task,
    ]);
}
}
