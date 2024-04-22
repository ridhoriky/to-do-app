@extends('templates.layout')

@section('content')

    <div class="container">
        <form action="/tasks/{{ $task->id }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="item" class="form-label " >Task</label>
                <input type="text" class="form-control" id="item" name="item" value="{{ $task->item }}">
                <label for="item" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $task->status }}">
                @error('item')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
