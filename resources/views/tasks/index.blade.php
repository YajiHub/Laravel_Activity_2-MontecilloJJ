@extends('layout')

@section('title', 'My Tasks')

@section('content')
    <h2>My Tasks</h2>

    @if(session('success'))
        <div id="notification" class="success" style="transition: opacity 0.5s ease;">{{ session('success') }}</div>
        <script>
            setTimeout(function() {
                var notification = document.getElementById('notification');
                if (notification) {
                    notification.style.opacity = '0';
                    setTimeout(function() {
                        notification.remove();
                    }, 500);
                }
            }, 2000); // Disappears after 3 seconds
        </script>
    @endif

    <form action="/tasks" method="POST" style="margin-bottom: 2rem;">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
            <label for="description">Description</label>
            <input type="text" name="description" id="description" value="{{ old('description') }}" required>
            <label for="due_date"">Due Date</label>
            <input type="date" name="due_date" required 
                   style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <button type="submit" class="btn" style="margin-left: 1rem;">Add Task</button>
        </div>
        
        {{-- <div style="display: flex; gap: 1rem;">
            <input type="text" name="title" placeholder="Enter a new task..." required 
                   style="flex: 1; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <input type="text" name="description" placeholder="Description..." required 
                   style="flex: 1; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <input type="date" name="due_date" required 
                   style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <button type="submit" class="btn">Add Task</button>
        </div> --}}


        @if($errors->any())
            <div class="error" style="margin-top: 0.5rem;">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </form>

    @if($tasks->count() > 0)
        <ul style="list-style: none;">
            @foreach($tasks as $task)
                <li style="background: #555; padding: 1rem; margin-bottom: 0.5rem; border-radius: 4px; display: flex; justify-content: space-between; align-items: center;">
                    @if ($task->is_completed)
                        <span style="color: #fff; text-decoration: line-through;">{{ $task->title }}</span>
                    @else
                        <span style="color: #fff;">{{ $task->title }}</span>
                    @endif
                    {{-- <span style="color: #fff;">{{ $task->title }}</span> --}}
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="/tasks/{{ $task->id }}/edit" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Edit</a>
                        <form action="/tasks/{{ $task->id }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem; background: #333;" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        @if (!$task->is_completed)
                            <form action="/tasks/{{ $task->id }}/done" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem; background: #28a745;">Done</button>
                            </form>
                        @else
                            <form action="/tasks/{{ $task->id }}/undone" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem; background: #ffc107;">Undone</button>
                            </form>
                        @endif 
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p style="color: #ccc; text-align: center; padding: 2rem;">No tasks yet. Add your first task above!</p>
    @endif
@endsection
