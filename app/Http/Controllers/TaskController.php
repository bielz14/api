<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return auth()->user()->tasks()->with('comments')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in progress,completed',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        $task = auth()->user()->tasks()->create($validated);

        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);
        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in progress,completed',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}

