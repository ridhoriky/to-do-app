<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "item" => "required|min:5|max:100",
            "status" => "required",
        ]);

        $imagePath = $request->file("image")->store("images");

        $task = Task::create([
            "item" => $validated["item"],
            "status" => $validated["status"],
            "image_path" => $imagePath,
        ]);

        return response()->json(["data" => $task], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(["message" => "Task not found"], 404);
        }
        return response()->json($task, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(["message" => "Task not found"], 404);
        }

        $validated = $request->validate([
            "item" => "required|min:5|max:100",
            "status" => "required",
        ]);

        $imagePath = $request->file("image")->store("images");

        $task->update([
            "item" => $validated["item"],
            "status" => $validated["status"],
            "image_path" => $imagePath,
        ]);

        return response()->json(["data" => $task], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(["message" => "Task not found"], 404);
        }

        $task->delete();
        return response()->json(["message" => "Task deleted"], 200);
    }
}
