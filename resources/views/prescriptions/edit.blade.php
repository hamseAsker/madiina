@extends('layouts.app')
@section('content')
<h1>Edit Prescription</h1>
<form action="{{ route('prescriptions.update', $prescription) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Patient ID</label>
        <input type="number" name="patient_id" class="form-control" value="{{ $prescription->patient_id }}" required>
    </div>
    <div class="form-group">
        <label>Doctor ID</label>
        <input type="number" name="doctor_id" class="form-control" value="{{ $prescription->doctor_id }}" required>
    </div>
    <div class="form-group">
        <label>Medication</label>
        <textarea name="medication" class="form-control" required>{{ $prescription->medication }}</textarea>
    </div>
    <div class="form-group">
        <label>Instructions</label>
        <textarea name="instructions" class="form-control">{{ $prescription->instructions }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
