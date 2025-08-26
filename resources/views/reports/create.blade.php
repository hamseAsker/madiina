@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full mb-4">
                <i class="fas fa-chart-bar text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Add New Report</h1>
            <p class="text-lg text-gray-600">Create a comprehensive report for your dental clinic</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-file-medical mr-2"></i>
                    Report Information
                </h2>
            </div>

            <!-- Form Content -->
            <form action="{{ route('reports.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <!-- Report Type -->
                <div class="space-y-2">
                    <label for="type" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-tag text-indigo-500 mr-2"></i>
                        Report Type
                    </label>
                    <select name="type" id="type" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-white">
                        <option value="">Select Report Type</option>
                        <option value="patient_summary">Patient Summary</option>
                        <option value="treatment_plan">Treatment Plan</option>
                        <option value="financial_report">Financial Report</option>
                        <option value="appointment_summary">Appointment Summary</option>
                        <option value="medical_history">Medical History</option>
                        <option value="diagnostic_report">Diagnostic Report</option>
                        <option value="progress_report">Progress Report</option>
                        <option value="referral_report">Referral Report</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Patient ID -->
                <div class="space-y-2">
                    <label for="patient_id" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-user text-indigo-500 mr-2"></i>
                        Patient
                    </label>
                    <select name="patient_id" id="patient_id" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-white">
                        <option value="">Select Patient</option>
                        @foreach($patients ?? [] as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }} - {{ $patient->phone }}</option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Report Content -->
                <div class="space-y-2">
                    <label for="content" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-align-left text-indigo-500 mr-2"></i>
                        Report Content
                    </label>
                    <textarea name="content" id="content" rows="8" required
                              placeholder="Enter detailed report content here..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 resize-none"
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Additional Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Report Date -->
                    <div class="space-y-2">
                        <label for="report_date" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-calendar text-indigo-500 mr-2"></i>
                            Report Date
                        </label>
                        <input type="date" name="report_date" id="report_date" 
                               value="{{ old('report_date', date('Y-m-d')) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                        @error('report_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label for="status" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-info-circle text-indigo-500 mr-2"></i>
                            Status
                        </label>
                        <select name="status" id="status" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-white">
                            <option value="draft">Draft</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="reviewed">Reviewed</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <!-- Save Button -->
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Save Report
                    </button>
                    
                    <!-- Cancel Button -->
                    <a href="{{ route('reports.index') }}" 
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
                Tips for Creating Reports
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Be specific and detailed in your content</span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Select the appropriate report type</span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Choose the correct patient</span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Set the appropriate status</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for enhanced styling -->
<style>
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
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
