@extends('layouts.app')
@section('content')
<div class="min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
        <div class="text-center mb-8">
            
        </div>
<div class="max-w-4xl mx-auto px-6 bg-white rounded-2xl   shadow-md">
 <!-- Form Card -->
 
         
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-user-md mr-2"></i>
                   Add New Doctor
                </h2>
            </div>
    <form action="{{ route('doctors.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                <input type="text" 
                       name="name" 
                       id="name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                       placeholder="Enter doctor's full name"
                       required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                <input type="email" 
                       name="email" 
                       id="email"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg  focus:ring-blue-500 focus:border-blue-500  transition-colors duration-200"
                       placeholder="doctor@example.com"
                       required>
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
                <label for="specialization" class="block text-sm font-medium text-gray-700 mb-2">Specialization</label>
                <input type="text" 
                       name="specialization" 
                       id="specialization"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                       placeholder="e.g., Orthodontics, Surgery">
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
            <a href="{{ route('doctors.index') }}" 
               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
               Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                Save Doctor
            </button>
        </div>
    </form>
</div>
@endsection
