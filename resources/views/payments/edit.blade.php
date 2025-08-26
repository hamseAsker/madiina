@extends('layouts.app')
@section('content')
<h1>Edit Payment</h1>
<form action="{{ route('payments.update', $payment) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Patient ID</label>
        <input type="number" name="patient_id" class="form-control" value="{{ $payment->patient_id }}" required>
    </div>
    <div class="form-group">
        <label>Amount</label>
        <input type="number" step="0.01" name="amount" class="form-control" value="{{ $payment->amount }}" required>
    </div>
    <div class="form-group">
        <label>Method</label>
        <input type="text" name="method" class="form-control" value="{{ $payment->method }}" required>
    </div>
    <div class="form-group">
        <label>Payment Date</label>
        <input type="datetime-local" name="payment_date" class="form-control" value="{{ $payment->payment_date }}" required>
    </div>
    <div class="form-group">
        <label>Status</label>
        <input type="text" name="status" class="form-control" value="{{ $payment->status }}">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
