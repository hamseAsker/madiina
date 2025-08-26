@extends('layouts.app')
@section('content')
<h1>Edit User</h1>
<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="form-group">
        <label>Password (leave blank to keep current)</label>
        <div class="input-group">
            <input type="password" name="password" class="form-control" id="password">
            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                <span id="eyeIcon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.493-.83 1.12-1.465 1.785C11.879 11.332 10.12 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm0 1a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3z"/></svg></span>
            </button>
        </div>
    </div>
    <div class="form-group">
        <label>Role</label>
        <select name="role_id" class="form-control" required>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
</form>
<script>
function togglePassword() {
    var input = document.getElementById('password');
    var eyeIcon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        eyeIcon.innerHTML = `<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-eye-slash' viewBox='0 0 16 16'><path d='M13.359 11.238C12.317 12.07 10.761 13.5 8 13.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8c.058-.087.122-.183.195-.288.335-.493.83-1.12 1.465-1.785C4.12 4.668 5.88 3.5 8 3.5c1.306 0 2.418.418 3.418 1.09l.941-.941a.5.5 0 1 1 .707.707l-12 12a.5.5 0 0 1-.707-.707l1.06-1.06z'/><path d='M11.297 9.383A2.5 2.5 0 0 1 6.617 4.703l1.06-1.06a3.5 3.5 0 0 1 4.95 4.95l-1.06 1.06a2.5 2.5 0 0 1-1.27-.27z'/></svg>`;
    } else {
        input.type = 'password';
        eyeIcon.innerHTML = `<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'><path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.493-.83 1.12-1.465 1.785C11.879 11.332 10.12 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z'/><path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm0 1a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3z'/></svg>`;
    }
}
</script>
@endsection
