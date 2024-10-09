<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

class TestController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.list',compact('users'));

    }
    public function create()
    {
        return view('test.create');
    }

    public function store(Request $request)
    {
        // dd('ok',$request->all());
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
        return User::find($id);
    }

    public function edit($id)
    {

        $user = Project::find($id);
        return view('test.update',compact('user'));
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'image' => 'image|nullable|max:1999',
    //     ]);

    //     $user = Test::findOrFail($id);

    //     if ($request->hasFile('image')) {
    //         // Delete old image
    //         if ($user->image) {
    //             Storage::disk('public')->delete('images/' . $user->image);
    //         }

    //         $filename = time() . '.' . $request->image->extension();
    //         $request->image->storeAs('images', $filename, 'public');
    //         $user->image = $filename;
    //     }

    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->save();

    //     return response()->json($user);
    // }

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
        $user = User::findOrFail($id);
        if ($user->image) {
            Storage::disk('public')->delete('images/' . $user->image);
        }
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}

