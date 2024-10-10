<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Traits\ImageUpload;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    use ImageUpload;

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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'nullable|date', 
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:Pending,Inprogress,Completed', 
            'image' => 'image|nullable|max:1999', 
        ]);

        if ($request->hasFile('image')) {
            $imagePath = ImageUpload::imageUpload($request->file('image'), 'uploads/images');
            $validatedData['image'] = $imagePath;
        }
        $project = Project::create($validatedData);
    
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', 
            'description' => 'nullable|string|max:1000',
            'start_date' => 'nullable|date',  
            'end_date' => 'nullable|date|after_or_equal:start_date', 
            'status' => 'required|in:Pending,Inprogress,Completed', 
            'image' => 'image|nullable|max:1999',
        ]);

        $project = Project::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($project->image) {
                $oldImagePath = public_path($project->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            // Upload the new image
            $imagePath = ImageUpload::imageUpload($request->file('image'), 'uploads/images');
            $validatedData['image'] = $imagePath;
        }
    
        $project->update($validatedData);

        return response()->json([
            'message' => 'Project updated successfully!',
            'project' => $project
        ], 200);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        Toastr::success('Projects deleted successfully', 'Title', ["positionClass" => "toast-top-center"]);
        return redirect()->route('projects.index');
    }
 
}
