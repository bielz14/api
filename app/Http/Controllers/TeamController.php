<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;

class TeamController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team = Team::create($validated);

        $team->users()->attach(auth()->id());

        return response()->json($team, 201);
    }

    public function index()
    {
        return response()->json(auth()->user()->teams()->with('tasks')->get());
    }

    public function addUser(Request $request, $teamId)
    {
        $team = Team::findOrFail($teamId);
        $user = User::where('email', $request->email)->firstOrFail();

        $team->users()->attach($user->id);

        return response()->json(['message' => 'User added to team']);
    }

    public function removeUser($teamId, $userId)
    {
        $team = Team::findOrFail($teamId);
        $team->users()->detach($userId);

        return response()->json(['message' => 'User removed from team']);
    }
}

