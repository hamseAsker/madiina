@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Schedule New Appointment</h1>
        <p class="text-gray-600 mt-2">Book an appointment for a patient</p>
    </div>

    <form action="{{ route('appointments.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="patient_id" class="block text-sm font-medium text-gray-700 mb-2">Patient *</label>
                <select name="patient_id" id="patient_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                    <option value="">Select a patient</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name }} ({{ $patient->phone }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-2">Doctor *</label>
                <select name="doctor_id" id="doctor_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                    <option value="">Select a doctor</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }} ({{ $doctor->specialization }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="appointment_time" class="block text-sm font-medium text-gray-700 mb-2">Appointment Date & Time *</label>
                <input type="datetime-local" 
                       name="appointment_time" 
                       id="appointment_time"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="status"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
            <textarea name="notes" 
                      id="notes"
                      rows="4"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200"
                      placeholder="Any additional notes about the appointment..."></textarea>
        </div>

        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
            <a href="{{ route('appointments.index') }}" 
               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
               Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-3 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                Schedule Appointment
            </button>
        </div>
    </form>
</div>
@endsection
