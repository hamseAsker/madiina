@extends('layouts.app')
@section('content')
<h1>Report Details</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>Type:</strong> {{ $report->type }}</li>
    <li class="list-group-item"><strong>Content:</strong> {{ $report->content }}</li>
    <li class="list-group-item"><strong>Patient ID:</strong> {{ $report->patient_id }}</li>
</ul>
<a href="{{ route('reports.index') }}" class="btn btn-primary mt-3">Back to List</a>
<a href="{{ route('reports.edit', $report) }}" class="btn btn-warning mt-3">Edit</a>
<form action="{{ route('reports.destroy', $report) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
