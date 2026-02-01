@extends('layout')

@section('title', 'My Tasks')

@section('content')
    <h2>My Tasks</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <!-- Add Task Form -->
    <form action="/tasks" method="POST" style="margin-bottom: 2rem;">
        @csrf
        <div style="display: flex; gap: 1rem;">
            <input type="text" name="title" placeholder="Enter a new task..." required 
                   style="flex: 1; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <input type="text" name="description" placeholder="Description..." required 
                   style="flex: 1; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            {{-- date --}}
            <input type="date" name="due_date" required 
                   style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <button type="submit" class="btn">Add Task</button>
        </div>
        @if($errors->any())
            <div class="error" style="margin-top: 0.5rem;">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </form>

    <!-- Task List -->
    @if($tasks->count() > 0)
        <ul style="list-style: none;">
            @foreach($tasks as $task)
                <li style="background: #555; padding: 1rem; margin-bottom: 0.5rem; border-radius: 4px; display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #fff;">{{ $task->title }}</span>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="/tasks/{{ $task->id }}/edit" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Edit</a>
                        <form action="/tasks/{{ $task->id }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem; background: #333;" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p style="color: #ccc; text-align: center; padding: 2rem;">No tasks yet. Add your first task above!</p>
    @endif
@endsection
