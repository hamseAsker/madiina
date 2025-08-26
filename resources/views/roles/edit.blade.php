@extends('layouts.app')
@section('content')
<h1>Edit Role</h1>
<form action="{{ route('roles.update', $role) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
    </div>
     
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
