<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input("search");
        if ($search) {
            // $tasks = DB::table("tasks")
            //     ->where("item", "like", "%$search%")
            //     ->paginate(3);
            $tasks = Task::where("item", "like", "%$search%")->paginate(3);
        } else {
            // $tasks = DB::table("tasks")->paginate(3);
            $tasks = Task::paginate(3);
        }
        return view("tasks/index", [
            "tasks" => $tasks,
        ]);
    }

    public function create()
    {
        return view("tasks/create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "item" => "required|min:5|max:100",
            "status" => "required",
        ]);

        // DB::table('tasks')->insert([
        //     'item'=> $validated['item']
        // ]);

        $imagePath = $request->file("image")->store("images");

        $task = new Task();
        $task->item = $validated["item"];
        $task->status = $validated["status"];
        $task->image_path = $imagePath;
        $task->save();

        return redirect("/tasks");
    }

    public function show($id)
    {
        // $task = DB::table("tasks")
        //     ->where("id", $id)
        //     ->first();
        $task = Task::find($id);
        return view("tasks/show", ["task" => $task]);
    }

    public function edit($id)
    {
        // $task = DB::table("tasks")
        //     ->where("id", $id)
        //     ->first();
        $task = Task::find($id);
        return view("tasks/edit", ["task" => $task]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            "item" => "required|min:3|max:255",
            "status" => "required",
        ]);
        // DB::table("tasks")
        //     ->where("id", $id)
        //     ->update([
        //         "item" => $validated["item"],
        //     ]);

        $imagePath = $request->file("image")->store("images");

        $task = Task::find($id);
        $task->item = $validated["item"];
        $task->status = $validated["status"];
        $task->image_path = $imagePath;
        $task->save();

        return redirect("/tasks/" . $id);
    }

    public function destroy(string $id)
    {
        // DB::table("tasks")
        //     ->where("id", $id)
        //     ->delete();
        $task = Task::find($id);
        $task->delete();
        return redirect("/tasks");
    }
}
