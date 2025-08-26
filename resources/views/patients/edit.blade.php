@extends('layouts.app')
@section('content')
<h1>Edit Patient</h1>
<form action="{{ route('patients.update', $patient) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $patient->name }}" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $patient->email }}">
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ $patient->phone }}">
    </div>
    <div class="form-group">
        <label>Date of Birth</label>
        <input type="date" name="dob" class="form-control" value="{{ $patient->dob }}">
    </div>
    <div class="form-group">
        <label>Address</label>
        <textarea name="address" class="form-control">{{ $patient->address }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
