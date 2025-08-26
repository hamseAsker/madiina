@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Appointments List</h1>
        <a href="{{ route('appointments.create') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md transition-colors">
           Add Appointment
        </a>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <div class="flex max-w-md space-x-2">
            <div class="relative flex-1">
                <input type="text" 
                       id="appointment-search" 
                       placeholder="Search appointments..." 
                       class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
            <button type="button" 
                    onclick="searchAppointments()"
                    class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                Search
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-700">ID</th>
                    <th class="px-4 py-2 text-left text-gray-700">Patient</th>
                    <th class="px-4 py-2 text-left text-gray-700">Doctor</th>
                    <th class="px-4 py-2 text-left text-gray-700">Time</th>
                    <th class="px-4 py-2 text-left text-gray-700">Status</th>
                    <th class="px-4 py-2 text-left text-gray-700">Notes</th>
                    <th class="px-4 py-2 text-left text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                <tr class="border-t border-gray-200">
                    <td class="px-4 py-2">{{ $appointment->id }}</td>
                    <td class="px-4 py-2">{{ $appointment->patient->name }}</td>
                    <td class="px-4 py-2">{{ $appointment->doctor->name }}</td>
                    <td class="px-4 py-2">{{ $appointment->appointment_time }}</td>
                    <td class="px-4 py-2">{{ $appointment->status }}</td>
                    <td class="px-4 py-2">{{ $appointment->notes }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('appointments.show', $appointment) }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md text-sm">View</a>
                        <a href="{{ route('appointments.edit', $appointment) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded-md text-sm">Edit</a>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md text-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
