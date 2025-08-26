@extends('layouts.app')
@section('content')
<h1>Doctor Details</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>Name:</strong> {{ $doctor->name }}</li>
    <li class="list-group-item"><strong>Email:</strong> {{ $doctor->email }}</li>
    <li class="list-group-item"><strong>Phone:</strong> {{ $doctor->phone }}</li>
    <li class="list-group-item"><strong>Specialization:</strong> {{ $doctor->specialization }}</li>
</ul>
<a href="{{ route('doctors.index') }}" class="btn btn-primary mt-3">Back to List</a>
<a href="{{ route('doctors.edit', $doctor) }}" class="btn btn-warning mt-3">Edit</a>
<form action="{{ route('doctors.destroy', $doctor) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
