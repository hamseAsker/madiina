@extends('layouts.app')
@section('content')
<h1>Edit Treatment</h1>
<form action="{{ route('treatments.update', $treatment) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Appointment ID</label>
        <input type="number" name="appointment_id" class="form-control" value="{{ $treatment->appointment_id }}" required>
    </div>
    <div class="form-group">
        <label>Service ID</label>
        <input type="number" name="service_id" class="form-control" value="{{ $treatment->service_id }}" required>
    </div>
    <div class="form-group">
        <label>Details</label>
        <textarea name="details" class="form-control">{{ $treatment->details }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('treatments.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
