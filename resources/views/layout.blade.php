<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Todo App')</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        background: url('/images/background.jpg') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }
    nav {
        background: #4c2626;
        color: white;
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    nav ul {
        list-style: none;
        display: flex;
        gap: 2rem;
    }
    nav a {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }
    nav a:hover {
        color: #3498db;
    }
    .container {
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        /* background: #5c4e4e; */
        background: url('/images/container.jpg') no-repeat center center fixed;
        background-size: contain;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        flex: 1;
        /* make the contents and the container width just relative not stretched so much */
        width: 90%;
    }
    h1, h2 {
        color: #fff;
        margin-bottom: 1rem;
        text-align: center;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    label {
        display: block;
        margin-bottom: 0.5rem;
        color: #fff;
        font-weight: bold;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
    }
    .btn {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background: #8B0000;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
        text-decoration: none;
    }
    .btn:hover {
        background: #a50000;
    }
    .btn-full {
        width: 100%;
    }
    .error {
        background: #ffcccc;
        color: #8B0000;
        padding: 0.75rem;
        border-radius: 4px;
        margin-bottom: 1rem;
    }
    .success {
        background: #ccffcc;
        color: #006400;
        padding: 0.75rem;
        border-radius: 4px;
        margin-bottom: 1rem;
    }
    .link {
        text-align: center;
        margin-top: 1rem;
        color: #fff;
    }
    .link a {
        color: #cee5f6;
    }
    footer {
        text-align: center;
        padding: 1rem;
        background: #494040;
        color: white;
    }
    </style>
</head>
<body>
    <nav>
        <div><a href="/">Todo App</a></div>
        <ul>
            @if(Session::has('user_id'))
                <li><a href="/tasks">Tasks</a></li>
                <li><a href="/profile">Profile</a></li>
                <li>
                    <form action="/logout" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" style="background:none;border:none;color:white;cursor:pointer;font-weight:bold;">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            @endif
        </ul>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <footer>
        <p>&copy; {{ date('Y') }} Todo App. All rights reserved.</p>
    </footer>
</body>
</html>