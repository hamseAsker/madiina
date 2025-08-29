@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-500 to-blue-600 rounded-full mb-4">
                <i class="fas fa-stethoscope text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Add New Treatment</h1>
            <p class="text-lg text-gray-600">Record a new dental treatment for your patient</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-green-500 to-blue-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Treatment Information
                </h2>
            </div>

            <!-- Form Content -->
            <form action="{{ route('treatments.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <!-- Appointment ID -->
                <div class="space-y-2">
                    <label for="appointment_id" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-calendar-check text-green-500 mr-2"></i>
                        Appointment
                    </label>
                    <select name="appointment_id" id="appointment_id" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white">
                        <option value="">Select Appointment</option>
                        @foreach($appointments ?? [] as $appointment)
                            <option value="{{ $appointment->id }}">
                                {{ $appointment->patient->name ?? 'Unknown' }} - 
                                {{ $appointment->doctor->name ?? 'Unknown' }} - 
                                {{ $appointment->appointment_time ? $appointment->appointment_time->format('M d, Y g:i A') : 'N/A' }}
                            </option>
                        @endforeach
                    </select>
                    @error('appointment_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Service ID -->
                <div class="space-y-2">
                    <label for="service_id" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-cogs text-blue-500 mr-2"></i>
                        Service
                    </label>
                    <select name="service_id" id="service_id" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white">
                        <option value="">Select Service</option>
                        @foreach($services ?? [] as $service)
                            <option value="{{ $service->id }}">
                                {{ $service->name }} - ${{ number_format($service->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Treatment Details -->
                <div class="space-y-2">
                    <label for="details" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-align-left text-green-500 mr-2"></i>
                        Treatment Details
                    </label>
                    <textarea name="details" id="details" rows="8" required
                              placeholder="Enter detailed treatment information, procedures performed, and any special notes..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 resize-none"
                    >{{ old('details') }}</textarea>
                    @error('details')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Additional Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Treatment Date -->
                    <div class="space-y-2">
                        <label for="treatment_date" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-calendar text-green-500 mr-2"></i>
                            Treatment Date
                        </label>
                        <input type="date" name="treatment_date" id="treatment_date" 
                               value="{{ old('treatment_date', date('Y-m-d')) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                        @error('treatment_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label for="status" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                            Status
                        </label>
                        <select name="status" id="status" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white">
                            <option value="scheduled">Scheduled</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Cost and Treatment Type Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Cost -->
                    <div class="space-y-2">
                        <label for="cost" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-dollar-sign text-green-500 mr-2"></i>
                            Cost
                        </label>
                        <input type="number" name="cost" id="cost" step="0.01" min="0"
                               value="{{ old('cost', '0.00') }}" placeholder="0.00"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                        @error('cost')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Treatment Type -->
                    <div class="space-y-2">
                        <label for="treatment_type" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-stethoscope text-blue-500 mr-2"></i>
                            Treatment Type
                        </label>
                        <input type="text" name="treatment_type" id="treatment_type"
                               value="{{ old('treatment_type') }}" placeholder="e.g., Cleaning, Filling, Extraction"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        @error('treatment_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <!-- Save Button -->
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-green-500 to-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Save Treatment
                    </button>
                    
                    <!-- Cancel Button -->
                    <a href="{{ route('treatments.index') }}" 
                       class="flex-1 bg-gray-100 text-gray-700 px-8 py-4 rounded-lg font-semibold hover:bg-gray-200 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-8 bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                Tips for Recording Treatments
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Select the correct appointment and patient</span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Choose the appropriate service type</span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Provide detailed treatment notes</span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Set the correct treatment status</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for enhanced styling -->
<style>
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
    }
    
    .btn-gradient:hover {
        background-size: 200% 200%;
        animation: gradient-shift 0.5s ease;
    }
    
    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
</style>
@endsection
