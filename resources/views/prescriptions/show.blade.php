@extends('layouts.app')
@section('content')
<h1>Prescription Details</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>Patient ID:</strong> {{ $prescription->patient_id }}</li>
    <li class="list-group-item"><strong>Doctor ID:</strong> {{ $prescription->doctor_id }}</li>
    <li class="list-group-item"><strong>Medication:</strong> {{ $prescription->medication }}</li>
    <li class="list-group-item"><strong>Instructions:</strong> {{ $prescription->instructions }}</li>
</ul>
<a href="{{ route('prescriptions.index') }}" class="btn btn-primary mt-3">Back to List</a>
<a href="{{ route('prescriptions.edit', $prescription) }}" class="btn btn-warning mt-3">Edit</a>
<form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
