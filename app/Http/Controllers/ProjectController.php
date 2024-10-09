<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('project.list',compact('projects'));
    }

    public function create()
    {
        return view('project.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'nullable|date', 
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:Pending,Inprogress,Completed', 
            'image' => 'image|nullable|max:1999', 
        ]);
    
        $filename = null;
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $filename, 'public');
        }
    
        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'image' => $filename,
        ]);
    
        return response()->json([
            'message' => 'Project created successfully!',
            'project' => $project
        ], 201); 
    }


    public function show($id)
    {

        $project = Project::find($id);
        return view('project.show',compact('project'));
    }

    public function edit($id)
    {

        $project = Project::find($id);
        return view('project.update',compact('project'));
    }

    public function update(Request $request, $id)
    {
        // dd( $request->all());
        $request->validate([
            'name' => 'required|string|max:255', 
            'description' => 'nullable|string|max:1000',
            'start_date' => 'nullable|date',  
            'end_date' => 'nullable|date|after_or_equal:start_date', 
            'status' => 'required|in:Pending,Inprogress,Completed', 
            'image' => 'image|nullable|max:1999',
        ]);

        $project = Project::findOrFail($id);

        $filename = $project->image;
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $filename, 'public');
        }
        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'image' => $filename,
        ]);

        return response()->json([
            'message' => 'Project updated successfully!',
            'project' => $project
        ], 200);
    }

    public function destroy($id)
    {
        $task = Project::findOrFail($id);
        $task->delete();
        return redirect()->route('projects.index')->with('success', 'Task deleted successfully.');
    }
 
}
