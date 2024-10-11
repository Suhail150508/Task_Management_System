<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TimeCalculation;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ReportControllerr extends Controller
{
    public function index()
    {
        $userInfo = session()->get('user');
        $tasks = Task::where('status','completed')->get();
        return view('reports.list',compact('tasks','userInfo'));

    }
    public function store(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if ($user && $user->role === 'Admin') {
            session()->put('user', $user);
            $userInfo = TimeCalculation::all();
            $tasks = Task::with('user')->get();
            Toastr::success('Admin logged in successfully', 'Title', ["positionClass" => "toast-top-right"]);
            return view('tasks.task_board', compact('tasks','userInfo'));
            
        } elseif ($user && $user->role === 'User') {
            session()->put('user', $user);
            $userInfo = TimeCalculation::all();
            $tasks = Task::with('user')->get();
            Toastr::success('User logged in successfully', 'Title', ["positionClass" => "toast-top-right"]);
            return view('tasks.task_board', compact('tasks','userInfo'));
        }else{

            Toastr::error('Credentials do not match', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->to('/login');

        }

    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        Toastr::success('Task deleted successfully', 'Title', ["positionClass" => "toast-top-center"]);
        return redirect()->route('tasks.index');

    }
    
}
