@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-slate-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-gray-500 to-slate-600 rounded-full mb-4">
                <i class="fas fa-user-tag text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Add New Role</h1>
            <p class="text-lg text-gray-600">Create a new user role for your system</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-gray-500 to-slate-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Role Information
                </h2>
            </div>

            <!-- Form Content -->
            <form action="{{ route('roles.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <!-- Role Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-tag text-gray-500 mr-2"></i>
                        Role Name
                    </label>
                    <input type="text" name="name" id="name" required
                           placeholder="Enter role name (e.g., admin, doctor, patient)"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all duration-200"
                           value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Description -->
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-align-left text-gray-500 mr-2"></i>
                        Description
                    </label>
                    <textarea name="description" id="description" rows="4"
                              placeholder="Enter role description and permissions..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all duration-200 resize-none"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Permissions -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-shield-alt text-gray-500 mr-2"></i>
                        Permissions
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="view_patients" id="view_patients" class="mr-3">
                            <label for="view_patients" class="text-sm text-gray-700">View Patients</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="edit_patients" id="edit_patients" class="mr-3">
                            <label for="edit_patients" class="text-sm text-gray-700">Edit Patients</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="view_appointments" id="view_appointments" class="mr-3">
                            <label for="view_appointments" class="text-sm text-gray-700">View Appointments</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="manage_appointments" id="manage_appointments" class="mr-3">
                            <label for="manage_appointments" class="text-sm text-gray-700">Manage Appointments</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="view_reports" id="view_reports" class="mr-3">
                            <label for="view_reports" class="text-sm text-gray-700">View Reports</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="manage_users" id="manage_users" class="mr-3">
                            <label for="manage_users" class="text-sm text-gray-700">Manage Users</label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <!-- Save Button -->
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-gray-500 to-slate-600 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Save Role
                    </button>
                    
                    <!-- Cancel Button -->
                    <a href="{{ route('roles.index') }}" 
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
                Tips for Creating Roles
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Use clear, descriptive role names</span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Assign appropriate permissions</span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Provide role descriptions</span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Follow security best practices</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for enhanced styling -->
<style>
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(107, 114, 128, 0.1);
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
