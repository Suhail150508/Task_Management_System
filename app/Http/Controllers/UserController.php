<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ImageUpload;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ImageUpload;

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
      $validate = $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
        ]);
        
        if ($request->hasFile('image')) {
            
            $imagePath = ImageUpload::imageUpload($request->file('image'), 'upload/image');
            $validate['image'] = $imagePath;
            
        }
        
        // dd($validate);
        User::create($validate);

        // Send email to admin
        if($request->register == 'check'){
            Toastr::success('User Registered successfully', 'Title', ["positionClass" => "toast-top-center"]);
            return redirect(url('/'));
        }
        Toastr::success('User created successfully', 'Title', ["positionClass" => "toast-top-center"]);
        return redirect()->route('users.index');
        // return redirect()->route('users.index')->with('success', 'User Created successfully.');
    }

    public function edit($id)
    {
       $update = User::findOrFail($id);
        return view('user.update', compact('update'));
    }
    public function update(Request $request, $id)
    {
        $update = $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
        ]);

            $user = User::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($user->image) {
                    $oldImagePath = public_path($user->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $imagePath = ImageUpload::imageUpload($request->file('image'), 'uploads/images');
                $update['image'] = $imagePath;
            }

            $user->update($update);
            Toastr::success('User updated successfully', 'Title', ["positionClass" => "toast-top-center"]);
            return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Toastr::success('Task deleted successfully', 'Title', ["positionClass" => "toast-top-center"]);
        return redirect()->route('users.index');

    }
}
