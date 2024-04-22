@extends('templates.layout')

@section('content')

    <div class="container">
        <form action="/tasks/{{ $task->id }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="item" class="form-label " >Task</label>
                <input type="text" class="form-control" id="item" name="item" value="{{ $task->item }}">
                @error('item')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $task->status }}">
                @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
