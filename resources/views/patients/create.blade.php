@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Add New Patient</h1>
        <p class="text-gray-600 mt-2">Enter patient information below</p>
    </div>

    <form action="{{ route('patients.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                <input type="text" 
                       name="name" 
                       id="name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                       placeholder="Enter patient's full name"
                       required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <input type="email" 
                       name="email" 
                       id="email"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                       placeholder="patient@example.com">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <input type="tel" 
                       name="phone" 
                       id="phone"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                       placeholder="+1234567890">
            </div>

            <div>
                <label for="dob" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                <input type="date" 
                       name="dob" 
                       id="dob"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
            </div>
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
            <textarea name="address" 
                      id="address"
                      rows="3"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                      placeholder="Enter patient's address"></textarea>
        </div>

        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
            <a href="{{ route('patients.index') }}" 
               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
               Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                Save Patient
            </button>
        </div>
    </form>
</div>
@endsection
