<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TimeCalculation;
use App\Models\User;
use App\Traits\ImageUpload;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ImageUpload;

    public function index()
    {
        $userInfo = TimeCalculation::all();
        $tasks = Task::with('user')->get();
        $pendings = Task::where('status','Pending')->get();
        $inprogress = Task::where('status','In Progress')->get();
        $completes = Task::where('status','Completed')->get();
        return view('tasks.task_board', compact('tasks','pendings','inprogress','completes','userInfo'));
    }

    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'status' => 'required',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'assigned_to' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = ImageUpload::imageUpload($request->file('image'), 'uploads/images');
            $validatedData['image'] = $imagePath;
        }

        // dd($validatedData);
        Task::create($validatedData);
        Toastr::success('Task created successfully', 'Title', ["positionClass" => "toast-top-center"]);


        // return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show($id)
    {
        $show = Task::findOrFail($id);
        return view('tasks.show', compact('show'));
    }

    public function edit($id)
    {
        $task_edit = Task::findOrFail($id);
        return view('tasks.edit', compact('task_edit',));
    }
    // public function edit(Task $task)
    // {
    //     $users = User::all();
    //     return view('tasks.edit', compact('task', 'users'));
    // }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'status' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'due_date' => 'required|date',
            'assigned_to' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'image' => 'nullable|image|max:2048',
        ]);
        $task = Task::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($task->image) {
                $oldImagePath = public_path($task->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            // Upload the new image
            $imagePath = ImageUpload::imageUpload($request->file('image'), 'uploads/images');
            $validatedData['image'] = $imagePath;
        }
    
        $task->update($validatedData);
    
        Toastr::success('Task updated successfully', 'Title', ["positionClass" => "toast-top-center"]);

        return response()->json();

    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        Toastr::success('Task deleted successfully', 'Title', ["positionClass" => "toast-top-center"]);
        return redirect()->route('tasks.index');
    }

    public function taskBoard()
    {
        // return view('tasks.task_board');

        $tasks = Task::with('user')->get();
        return view('tasks.task_board', compact('tasks'));
    }

    public function logout()
    {
        // return view('tasks.task_board');
        // This will remove all session data and regenerate a new session ID
        session()->invalidate();

        return redirect()->to('/');
    }


    public function timerStore(Request $request){

        $validatedData = $request->validate([
            'hours' => 'nullable|integer|min:0',
            'minutes' => 'nullable|integer|min:0|max:59',
            'user_id' => 'required|integer|exists:users,id',
            'task_id' => 'required|integer|exists:tasks,id',
        ]);
    
        // Save the validated data to the database
        TimeCalculation::create($validatedData);
        Toastr::success('Time stored successfully', 'Title', ["positionClass" => "toast-top-center"]);
            return redirect(route('tasks.index'));
    }


}

