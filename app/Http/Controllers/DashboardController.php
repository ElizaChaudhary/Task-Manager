<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\Task;

class DashboardController extends Controller
{

public function index()
{
    $total = Task::count();
    $completed = Task::where('status', 'done')->count();
    $pending = Task::where('status', 'pending')->count();

    $overdue = Task::where('due_date', '<', now())
        ->where('status', '!=', 'done')
        ->count();

    $tasks = Task::with('user')->get();

    return view('dashboard', compact(
        'total',
        'completed',
        'pending',
        'overdue',
        'tasks'
    ));
}
}
