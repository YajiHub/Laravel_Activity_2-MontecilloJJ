@extends('layout')

@section('title', 'Edit Task')

@section('content')
    <h2>Edit Task</h2>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="/tasks/{{ $task->id }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" value="{{ old('description', $task->description) }}">
        </div>

        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}">
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn">Update Task</button>
            <a href="/tasks" class="btn" style="background: #333;">Cancel</a>
        </div>
    </form>
@endsection
