<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user')->get();
        $pendings = Task::where('status','Pending')->get();
        $inprogress = Task::where('status','In Progress')->get();
        $completes = Task::where('status','Completed')->get();
        return view('tasks.task_board', compact('tasks','pendings','inprogress','completes'));
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
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'due_date' => 'required|date',
            'assigned_to' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $path;
        }

        // dd($validatedData);
        Task::create($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show($id)
    {
        dd($id);
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

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $path;
        }

        $task = Task::findOrFail($id);

        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function taskBoard()
    {
        // return view('tasks.task_board');

        $tasks = Task::with('user')->get();
        $pendings = Task::where('status','Pending')->get();
        $inprogress = Task::where('status','In Progress')->get();
        $completes = Task::where('status','Completed')->get();
        return view('tasks.task_board', compact('tasks','pendings','inprogress','completes'));
    }


}

