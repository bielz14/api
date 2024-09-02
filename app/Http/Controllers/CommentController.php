<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $comment = $task->comments()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
        ]);

        return response()->json($comment, 201);
    }

    public function index($taskId)
    {
        $task = Task::findOrFail($taskId);
        return response()->json($task->comments()->with('user')->get());
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}

