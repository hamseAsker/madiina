@extends('layouts.app')

@section('content')
 <div class="min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
        <div class="text-center mb-8">
            
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                 <i class="fas fa-stethoscope mr-2"></i>
                    Add New Service
                </h2>
                
            </div>

            <!-- Form Content -->
            <form action="{{ route('services.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <!-- Service Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-tag text-blue-500 mr-2"></i>
                        Service Name
                    </label>
                    <input type="text" name="name" id="name" required
                           placeholder="Enter service name..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                           value="{{ old('name') }}">
                    @error('name')
                        <p class="text-blue-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Service Description -->
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-align-left text-blue-500 mr-2"></i>
                        Description
                    </label>
                    <textarea name="description" id="description" rows="4"
                              placeholder="Enter detailed service description..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-blue-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Service Price -->
                <div class="space-y-2">
                    <label for="price" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-dollar-sign text-blue-500 mr-2"></i>
                        Price
                    </label>
                    <input type="number" name="price" id="price" step="0.01" required
                           placeholder="0.00"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                           value="{{ old('price') }}">
                    @error('price')
                        <p class="text-blue-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <!-- Save Button -->
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-blue-500 to--600 px-8 py-4 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Save Service
                    </button>
                    
                    <!-- Cancel Button -->
                    <a href="{{ route('services.index') }}" 
                       class="flex-1 bg-gray-100 text-gray-700 px-8 py-4 rounded-lg font-semibold hover:bg-gray-200 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
 
        </div>
    </div>
</div>

<!-- Custom CSS for enhanced styling -->
<style>
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.1);
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
