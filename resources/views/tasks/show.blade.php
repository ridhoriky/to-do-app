@extends('templates/layout')

@section('content')
<div class="container">
    <h1>{{ $task->item }}</h1>
    <p>{{ $task->status }}</p>
    <img src="{{ asset('storage/' . $task->image_path) }}" alt="{{ $task->image_path }}">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        @auth  
        <form onsubmit="return confirm('Are you sure?')" action="/tasks/{{ $task->id }}" method="POST">
            @method('DELETE')
            @csrf
            <a class="btn btn-primary" href="/tasks/{{ $task->id }}/edit">Edit</a>
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        @endauth
    </div>
</div>
@endSection