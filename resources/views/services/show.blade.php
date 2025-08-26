@extends('layouts.app')
@section('content')
<h1>Service Details</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>Name:</strong> {{ $service->name }}</li>
    <li class="list-group-item"><strong>Description:</strong> {{ $service->description }}</li>
    <li class="list-group-item"><strong>Price:</strong> {{ $service->price }}</li>
</ul>
<a href="{{ route('services.index') }}" class="btn btn-primary mt-3">Back to List</a>
<a href="{{ route('services.edit', $service) }}" class="btn btn-warning mt-3">Edit</a>
<form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
