@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-teal-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-500 to-teal-600 rounded-full mb-4">
                <i class="fas fa-edit text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Prescription</h1>
            <p class="text-lg text-gray-600">Update the prescription information</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-green-500 to-teal-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Prescription Information
                </h2>
            </div>

            <!-- Form Content -->
            <form action="{{ route('prescriptions.update', $prescription) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Patient Selection -->
                <div class="space-y-2">
                    <label for="patient_id" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-user text-green-500 mr-2"></i>
                        Patient
                    </label>
                    <select name="patient_id" id="patient_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white">
                        <option value="">Select Patient</option>
                        @foreach($patients ?? [] as $patient)
                            <option value="{{ $patient->id }}" {{ $prescription->patient_id == $patient->id ? 'selected' : '' }}>
                                {{ $patient->name }} - {{ $patient->phone }}
                            </option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Doctor Selection -->
                <div class="space-y-2">
                    <label for="doctor_id" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-user-md text-green-500 mr-2"></i>
                        Doctor
                    </label>
                    <select name="doctor_id" id="doctor_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white">
                        <option value="">Select Doctor</option>
                        @foreach($doctors ?? [] as $doctor)
                            <option value="{{ $doctor->id }}" {{ $prescription->doctor_id == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }} - {{ $doctor->specialization }}
                            </option>
                        @endforeach
                    </select>
                    @error('doctor_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Medication -->
                <div class="space-y-2">
                    <label for="medication" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-pills text-green-500 mr-2"></i>
                        Medication
                    </label>
                    <textarea name="medication" id="medication" required rows="3"
                              placeholder="Enter medication details..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 resize-none"
                    >{{ old('medication', $prescription->medication) }}</textarea>
                    @error('medication')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instructions -->
                <div class="space-y-2">
                    <label for="instructions" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-info-circle text-green-500 mr-2"></i>
                        Instructions
                    </label>
                    <textarea name="instructions" id="instructions" rows="4"
                              placeholder="Enter medication instructions..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 resize-none"
                    >{{ old('instructions', $prescription->instructions) }}</textarea>
                    @error('instructions')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Additional Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Prescribed Date -->
                    <div class="space-y-2">
                        <label for="prescribed_date" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-calendar text-green-500 mr-2"></i>
                            Prescribed Date
                        </label>
                        <input type="date" name="prescribed_date" id="prescribed_date" 
                               value="{{ old('prescribed_date', $prescription->prescribed_date ? $prescription->prescribed_date->format('Y-m-d') : date('Y-m-d')) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                        @error('prescribed_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div class="space-y-2">
                        <label for="duration" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-clock text-green-500 mr-2"></i>
                            Duration
                        </label>
                        <input type="text" name="duration" id="duration" 
                               placeholder="e.g., 7 days, 2 weeks"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                               value="{{ old('duration', $prescription->duration) }}">
                        @error('duration')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <!-- Update Button -->
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-green-500 to-teal-600 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Update Prescription
                    </button>
                    
                    <!-- Cancel Button -->
                    <a href="{{ route('prescriptions.index') }}" 
                       class="flex-1 bg-gray-100 text-gray-700 px-8 py-4 rounded-lg font-semibold hover:bg-gray-200 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
