@extends('layout')

@section('title', 'ToDo CRUD Application')

@section('content')
    <div style="text-align: center; padding: 2rem 0;">
        <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">Welcome to Todo App</h1>

        @if(Session::has('user_id'))
            <div>
                <p style="margin-bottom: 1rem; color: #cee5f6;">You are logged in!</p>
                <a href="/tasks" class="btn">Go to My Tasks</a>
            </div>
        @else
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="/login" class="btn">Login</a>
                <a href="/register" class="btn" style="background: #333;">Register</a>
            </div>
        @endif

        <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #666;">
            <h2 style="margin-bottom: 1rem;">Features</h2>
            <ul style="list-style: none; color: #ccc;">
                <li style="margin-bottom: 0.5rem;">Create, Edit, and Delete Tasks</li>
                <li style="margin-bottom: 0.5rem;">Display tasks belonging to you</li>
                <li style="margin-bottom: 0.5rem;">User-specific task management</li>
                <li style="margin-bottom: 0.5rem;">View and manage your profile</li>
            </ul>
        </div>
    </div>
@endsection
