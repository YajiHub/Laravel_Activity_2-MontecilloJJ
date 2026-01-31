<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Session::get('user_id'))->get();
        return view('tasks.index', compact('tasks'));
    }
}
