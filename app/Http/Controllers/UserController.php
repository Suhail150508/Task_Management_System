<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role','User')->get();
        return view('user.list',compact('users'));

    }
    public function show($id)
    {
        $users = User::findOrFail($id);
        return view('user.show',compact('users'));

    }

    public function create()
    {
        return view('user.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password
        $user->designation = $request->designation;
        $user->role = $request->role;
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move(public_path('teacher'), $fileName); // Save the image in the 'teacher' directory
            $user->image = $fileName; // Assign the file name to the user
        }
        
        $user->save();

        // Send email to admin

        return redirect()->route('users.index')->with('success', 'User Created successfully.');
    }

    public function edit($id)
    {
       $ticket = User::findOrFail($id);
        return view('tickets.edit', compact('ticket'));
    }
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'subject' => 'required',
    //         'description' => 'required',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg',
    //         ]);

    //         $update = User::findOrFail($id);

    //         $update->subject = $request->subject;
    //         $update->description = $request->description;
    //         $update->status = $request->status;

    //         if ($request->image) {
    //             if ($update->image) {

    //                 unlink(public_path('teacher/' . $update->image));
    //             }

    //             $file = $request->image;
    //             $extension = $file->getClientOriginalExtension();
    //             $fileName = time() . '.' . $extension;
    //             $file->move('teacher', $fileName);
    //             $update->image = $fileName;
    //         }
    //         $update->save();
    //         return redirect('customer-ticket');
    // }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');

    }
}
