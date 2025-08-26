@extends('layouts.app')
@section('content')
<h1>Edit Service</h1>
<form action="{{ route('services.update', $service) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $service->description }}</textarea>
    </div>
    <div class="form-group">
        <label>Price</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ $service->price }}" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
