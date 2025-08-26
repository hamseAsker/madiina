@extends('layouts.app')
@section('content')
<h1>Treatment Details</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>Appointment ID:</strong> {{ $treatment->appointment_id }}</li>
    <li class="list-group-item"><strong>Service ID:</strong> {{ $treatment->service_id }}</li>
    <li class="list-group-item"><strong>Details:</strong> {{ $treatment->details }}</li>
</ul>
<a href="{{ route('treatments.index') }}" class="btn btn-primary mt-3">Back to List</a>
<a href="{{ route('treatments.edit', $treatment) }}" class="btn btn-warning mt-3">Edit</a>
<form action="{{ route('treatments.destroy', $treatment) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
