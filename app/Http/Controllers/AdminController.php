<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $highestSolver = User::withCount(['tasks' => function ($query) {
            $query->where('status', 'Completed');
        }])->orderBy('tasks_count', 'desc')->first();

        $avgSolvingTime = Task::select(DB::raw('AVG(TIMESTAMPDIFF(MINUTE, created_at, updated_at)) as avg_time'))
            ->where('status', 'Completed')
            ->groupBy('assigned_to')
            ->get();

        return view('admin.dashboard', compact('highestSolver', 'avgSolvingTime'));
    }

}
