@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Appointment Details</h1>

    <div class="space-y-3">
        <div class="p-3 border rounded-md bg-gray-50">
            <strong class="text-gray-700">Patient:</strong> {{ $appointment->patient->name ?? 'N/A' }}
        </div>
        <div class="p-3 border rounded-md bg-gray-50">
            <strong class="text-gray-700">Doctor:</strong> {{ $appointment->doctor->name ?? 'N/A' }}
        </div>
        <div class="p-3 border rounded-md bg-gray-50">
            <strong class="text-gray-700">Time:</strong> {{ $appointment->appointment_time }}
        </div>
        <div class="p-3 border rounded-md bg-gray-50">
            <strong class="text-gray-700">Status:</strong> 
            <span class="px-2 py-1 rounded text-white 
                {{ $appointment->status == 'pending' ? 'bg-yellow-500' : '' }}
                {{ $appointment->status == 'confirmed' ? 'bg-green-500' : '' }}
                {{ $appointment->status == 'cancelled' ? 'bg-red-500' : '' }}">
                {{ ucfirst($appointment->status) }}
            </span>
        </div>
        <div class="p-3 border rounded-md bg-gray-50">
            <strong class="text-gray-700">Notes:</strong> {{ $appointment->notes ?? 'No notes' }}
        </div>
    </div>

    <div class="flex space-x-3 mt-6">
        <a href="{{ route('appointments.index') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md shadow">
            Back to List
        </a>
        <a href="{{ route('appointments.edit', $appointment) }}" 
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md shadow">
            Edit
        </a>
        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST"
              onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" 
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md shadow">
                Delete
            </button>
        </form>
    </div>
</div>
@endsection
