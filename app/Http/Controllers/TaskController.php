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

    public function create()
    {
        return redirect('/tasks');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'nullable|date'
        ]);

        Task::create([
            'user_id' => Session::get('user_id'),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date
        ]);

        return redirect('/tasks')->with('success', 'Task created successfully');
    }

    public function edit($id)
    {
        $task = Task::where('id', $id)->where('user_id', Session::get('user_id'))->firstOrFail();
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'nullable|date'
        ]);

        $task = Task::where('id', $id)->where('user_id', Session::get('user_id'))->firstOrFail();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect('/tasks')->with('success', 'Task updated successfully');
    }

    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', Session::get('user_id'))->firstOrFail();
        $task->delete();

        return redirect('/tasks')->with('success', 'Task deleted successfully');
    }
}
