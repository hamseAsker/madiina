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
                    <i class="fas fa-credit-card mr-2"></i>
                   Add New Payment
                </h2>
            </div>

            <!-- Form Content -->
            <form action="{{ route('payments.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <!-- Patient Selection -->
                <div class="space-y-2">
                    <label for="patient_id" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-user text-yellow-500 mr-2"></i>
                        Patient
                    </label>
                    <select name="patient_id" id="patient_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 bg-white">
                        <option value="">Select Patient</option>
                        @foreach($patients ?? [] as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }} - {{ $patient->phone }}</option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Amount -->
                <div class="space-y-2">
                    <label for="amount" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-dollar-sign text-yellow-500 mr-2"></i>
                        Amount
                    </label>
                    <input type="number" name="amount" id="amount" step="0.01" required
                           placeholder="0.00"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200"
                           value="{{ old('amount') }}">
                    @error('amount')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Method -->
                <div class="space-y-2">
                    <label for="method" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-credit-card text-yellow-500 mr-2"></i>
                        Payment Method
                    </label>
                    <select name="method" id="method" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 bg-white">
                        <option value="">Select Payment Method</option>
                        <option value="cash">Cash</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="debit_card">Debit Card</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="check">Check</option>
                        <option value="insurance">Insurance</option>
                    </select>
                    @error('method')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Date -->
                <div class="space-y-2">
                    <label for="payment_date" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-calendar text-yellow-500 mr-2"></i>
                        Payment Date
                    </label>
                    <input type="datetime-local" name="payment_date" id="payment_date" required
                           value="{{ old('payment_date', date('Y-m-d\TH:i')) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200">
                    @error('payment_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Status -->
                <div class="space-y-2">
                    <label for="status" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-info-circle text-yellow-500 mr-2"></i>
                        Status
                    </label>
                    <select name="status" id="status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 bg-white">
                        <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ old('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <!-- Save Button -->
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Save Payment
                    </button>
                    
                    <!-- Cancel Button -->
                    <a href="{{ route('payments.index') }}" 
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
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
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
