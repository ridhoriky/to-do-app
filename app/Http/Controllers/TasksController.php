<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class TasksController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if($search) {
            $tasks = DB::table('tasks')
                    ->where('item', 'like', "%$search%")
                    ->paginate(3);
        } else {
            $tasks = DB::table('tasks')->paginate(3);
        }
        return view('tasks/index', [
            'tasks' => $tasks
        ]);
    }

    public function create( )
    {
        return view('tasks/create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item' => 'required|min:5|max:100',
        ]);
        DB::table('tasks')->insert([
            'item'=> $validated['item']
        ]);
        return redirect('/tasks');
    }

    public function show($id)
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        return view('tasks/show', ['task' => $task]);
    }

    public function edit($id)
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        return view('tasks/edit', ['task' => $task]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'item' => 'required|min:3|max:255',
        ]);
        DB::table('tasks')->where('id', $id)->update([
            'item' => $validated['item'],
        ]);
        return redirect('/tasks/'.$id);
    }

    public function destroy(string $id)
    {
        DB::table('tasks')->where('id', $id)->delete();
        return redirect('/tasks');
    }
}
