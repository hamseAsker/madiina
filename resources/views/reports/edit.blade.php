@extends('layouts.app')
@section('content')
<h1>Edit Report</h1>
<form action="{{ route('reports.update', $report) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Type</label>
        <input type="text" name="type" class="form-control" value="{{ $report->type }}" required>
    </div>
    <div class="form-group">
        <label>Content</label>
        <textarea name="content" class="form-control" required>{{ $report->content }}</textarea>
    </div>
    <div class="form-group">
        <label>Patient ID</label>
        <input type="number" name="patient_id" class="form-control" value="{{ $report->patient_id }}">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('reports.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
