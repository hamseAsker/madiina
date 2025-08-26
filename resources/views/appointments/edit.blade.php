@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Appointment</h1>

    <form action="{{ route('appointments.update', $appointment) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-medium mb-1">Patient ID</label>
            <input type="number" name="patient_id" required value="{{ $appointment->patient_id }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Doctor ID</label>
            <input type="number" name="doctor_id" required value="{{ $appointment->doctor_id }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Appointment Time</label>
            <input type="datetime-local" name="appointment_time" required value="{{ $appointment->appointment_time }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Status</label>
            <input type="text" name="status" value="{{ $appointment->status }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Notes</label>
            <textarea name="notes"
                      class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $appointment->notes }}</textarea>
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-md transition-colors">
                Update
            </button>
            <a href="{{ route('appointments.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-md transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
