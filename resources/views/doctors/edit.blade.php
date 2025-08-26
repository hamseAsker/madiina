@extends('layouts.app')
@section('content')
<h1>Edit Doctor</h1>
<form action="{{ route('doctors.update', $doctor) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $doctor->name }}" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $doctor->email }}" required>
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ $doctor->phone }}">
    </div>
    <div class="form-group">
        <label>Specialization</label>
        <input type="text" name="specialization" class="form-control" value="{{ $doctor->specialization }}">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
