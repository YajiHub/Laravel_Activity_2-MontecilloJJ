@extends('layout')

@section('title', 'My Profile')

@section('content')
    <h2>My Profile</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="form-group" style="text-align: center; margin-bottom: 1.5rem;">
        <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem; border: 3px solid #8B0000; background: #333;" id="profile-image-container">
            @if($user->profile_image)
                <img src="{{ asset('images/' . $user->profile_image) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #ccc; font-size: 3rem;">
                    👤
                </div>
            @endif
        </div>
        <form action="/profile" method="POST" enctype="multipart/form-data" style="display: inline;">
            @csrf
            <input type="hidden" name="name" value="{{ $user->name }}">
            <input type="hidden" name="email" value="{{ $user->email }}">
            <label for="profile_image" class="btn" style="cursor: pointer; display: inline-block;">
                Choose Image
            </label>
            <input type="file" name="profile_image" id="profile_image" accept="image/*" style="display: none;" onchange="this.form.submit()">
        </form>
        @if($user->profile_image)
            <form action="/profile/image/remove" method="POST" style="display: inline; margin-left: 0.5rem;">
                @csrf
                <button type="submit" class="btn" style="background: #333;" onclick="return confirm('Remove profile image?')">Remove Image</button>
            </form>
        @endif
        <p style="color: #ccc; font-size: 0.8rem; margin-top: 0.5rem;">Max 2MB (JPEG, PNG, JPG, GIF)</p>
    </div>

    <form action="/profile" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="password">New Password (leave blank to keep current)</label>
            <input type="password" name="password" id="password" placeholder="Enter new password...">
        </div>

        <button type="submit" class="btn">Update Profile</button>
    </form>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-image-container').innerHTML = '<img src="' + e.target.result + '" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
