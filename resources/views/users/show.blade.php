@extends('layouts.app')
@section('content')
<h1>User Details</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
    <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
    <li class="list-group-item"><strong>Role:</strong> {{ $user->role }}</li>
</ul>
<a href="{{ route('users.index') }}" class="btn btn-primary mt-3">Back to List</a>
<a href="{{ route('users.edit', $user) }}" class="btn btn-warning mt-3">Edit</a>
<form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
