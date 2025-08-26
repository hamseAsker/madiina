@extends('layouts.app')
@section('content')
<h1>Role Details</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>Name:</strong> {{ $role->name }}</li>
    <li class="list-group-item"><strong>Description:</strong> {{ $role->description }}</li>
</ul>
<a href="{{ route('roles.index') }}" class="btn btn-primary mt-3">Back to List</a>
<a href="{{ route('roles.edit', $role) }}" class="btn btn-warning mt-3">Edit</a>
<form action="{{ route('roles.destroy', $role) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
