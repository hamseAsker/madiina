@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full mb-4">
                <i class="fas fa-edit text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Report</h1>
            <p class="text-lg text-gray-600">Update the report information</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Report Information
                </h2>
            </div>

            <!-- Form Content -->
            <form action="{{ route('reports.update', $report) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Report Type -->
                <div class="space-y-2">
                    <label for="type" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-tag text-indigo-500 mr-2"></i>
                        Report Type
                    </label>
                    <select name="type" id="type" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-white">
                        <option value="">Select Report Type</option>
                        <option value="patient_summary" {{ $report->type == 'patient_summary' ? 'selected' : '' }}>Patient Summary</option>
                        <option value="treatment_plan" {{ $report->type == 'treatment_plan' ? 'selected' : '' }}>Treatment Plan</option>
                        <option value="financial_report" {{ $report->type == 'financial_report' ? 'selected' : '' }}>Financial Report</option>
                        <option value="appointment_summary" {{ $report->type == 'appointment_summary' ? 'selected' : '' }}>Appointment Summary</option>
                        <option value="medical_history" {{ $report->type == 'medical_history' ? 'selected' : '' }}>Medical History</option>
                        <option value="diagnostic_report" {{ $report->type == 'diagnostic_report' ? 'selected' : '' }}>Diagnostic Report</option>
                        <option value="progress_report" {{ $report->type == 'progress_report' ? 'selected' : '' }}>Progress Report</option>
                        <option value="referral_report" {{ $report->type == 'referral_report' ? 'selected' : '' }}>Referral Report</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Patient Selection -->
                <div class="space-y-2">
                    <label for="patient_id" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-user text-indigo-500 mr-2"></i>
                        Patient
                    </label>
                    <select name="patient_id" id="patient_id" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-white">
                        <option value="">Select Patient</option>
                        @foreach($patients ?? [] as $patient)
                            <option value="{{ $patient->id }}" {{ $report->patient_id == $patient->id ? 'selected' : '' }}>
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
                        <i class="fas fa-user-md text-indigo-500 mr-2"></i>
                        Doctor
                    </label>
                    <select name="doctor_id" id="doctor_id" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-white">
                        <option value="">Select Doctor</option>
                        @foreach($doctors ?? [] as $doctor)
                            <option value="{{ $doctor->id }}" {{ $report->doctor_id == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }} - {{ $doctor->specialization }}
                            </option>
                        @endforeach
                    </select>
                    @error('doctor_id')
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
                    >{{ old('content', $report->content) }}</textarea>
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
                               value="{{ old('report_date', $report->report_date ? $report->report_date->format('Y-m-d') : date('Y-m-d')) }}" required
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
                            <option value="draft" {{ $report->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="completed" {{ $report->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="reviewed" {{ $report->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <!-- Update Button -->
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Update Report
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
    </div>
</div>
@endsection
