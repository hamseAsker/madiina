@extends('layouts.app')
@section('content')
<h1>Patient Details</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>Name:</strong> {{ $patient->name }}</li>
    <li class="list-group-item"><strong>Email:</strong> {{ $patient->email }}</li>
    <li class="list-group-item"><strong>Phone:</strong> {{ $patient->phone }}</li>
    <li class="list-group-item"><strong>Date of Birth:</strong> {{ $patient->dob }}</li>
    <li class="list-group-item"><strong>Address:</strong> {{ $patient->address }}</li>
</ul>
<a href="{{ route('patients.index') }}" class="btn btn-primary mt-3">Back to List</a>
<a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning mt-3">Edit</a>
<form action="{{ route('patients.destroy', $patient) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
