<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        auth()->user()->tasks()->create([
            'title' => $request->title,
        ]);
        return back()->with('success', 'Task added!');
    }

    public function edit(Task $task)
    {
        Gate::authorize('modify',$task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        Gate::authorize('modify', $task);
        $request->validate(['title' => 'required|string|max:255']);

        $task->update(['title' => $request->title]);

        return redirect()->route('tasks.index')->with('success', 'Task updated!');
    }

    public function toggle(Task $task) 
    {
        Gate::authorize('modify', $task);
        $task->update(['is_completed' => !$task->is_completed]);

        return back();
    }

    public function destroy(Task $task)
    {
        Gate::authorize('modify', $task);
        $task->delete();

        return back()->with('success', 'Task deleted!');
    }

}
