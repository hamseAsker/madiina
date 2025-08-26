@extends('layouts.app')
@section('content')
<h1>Payment Details</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>Patient ID:</strong> {{ $payment->patient_id }}</li>
    <li class="list-group-item"><strong>Amount:</strong> {{ $payment->amount }}</li>
    <li class="list-group-item"><strong>Method:</strong> {{ $payment->method }}</li>
    <li class="list-group-item"><strong>Date:</strong> {{ $payment->payment_date }}</li>
    <li class="list-group-item"><strong>Status:</strong> {{ $payment->status }}</li>
</ul>
<a href="{{ route('payments.index') }}" class="btn btn-primary mt-3">Back to List</a>
<a href="{{ route('payments.edit', $payment) }}" class="btn btn-warning mt-3">Edit</a>
<form action="{{ route('payments.destroy', $payment) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
