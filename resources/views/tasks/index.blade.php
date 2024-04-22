@extends('templates.layout')

@section('content')

    <div class="container">
        @auth
            <h1>Welcome, {{ auth()->user()->name }}</h1>
            @role('member')
            <a href="/tasks/create" class="btn btn-primary my-3">Create Task</a>
            @endrole
        @endauth

        <form action="/tasks" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" name="search">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr >
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-7">Task</th>
                    <th scope="col" class="col-2">Status</th>
                    <th scope="col" class="col-2" >Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td> {{ $task->item }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/tasks/{{ $task->id }}" class="btn btn-primary">Detail</a>
                            @auth 
                            @role('admin')
                            <a href="/tasks/{{ $task->id }}/edit" class="btn btn-warning">Edit</a>
                            <form onsubmit="return confirm('Are you sure?')" action="/tasks/{{ $task->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button  class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            @endrole
                            @endauth
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            <div class="d-flex justify-content-end">{{ $tasks->links() }}</div>
    </div>

@endsection
