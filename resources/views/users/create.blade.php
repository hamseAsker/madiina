@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 to-pink-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-red-500 to-pink-600 rounded-full mb-4">
                <i class="fas fa-user-plus text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Add New User</h1>
            <p class="text-lg text-gray-600">Create a new user account for your system</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-red-500 to-pink-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i>
                    User Information
                </h2>
            </div>

            <!-- Form Content -->
            <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <!-- User Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-user text-red-500 mr-2"></i>
                        Full Name
                    </label>
                    <input type="text" name="name" id="name" required
                           placeholder="Enter user's full name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200"
                           value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-envelope text-red-500 mr-2"></i>
                        Email Address
                    </label>
                    <input type="email" name="email" id="email" required
                           placeholder="user@example.com"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200"
                           value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-lock text-red-500 mr-2"></i>
                        Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                               placeholder="Enter password"
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200">
                        <button type="button" 
                                onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div class="space-y-2">
                    <label for="role_id" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-user-tag text-red-500 mr-2"></i>
                        Role
                    </label>
                    <select name="role_id" id="role_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-white">
                        <option value="">Select Role</option>
                        @foreach($roles ?? [] as $role)
                            <option value="{{ $role->id }}" {{ $role->name == 'patient' ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <!-- Save Button -->
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-red-500 to-pink-600 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Save User
                    </button>
                    
                    <!-- Cancel Button -->
                    <a href="{{ route('users.index') }}" 
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
                Tips for Creating Users
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Use strong, secure passwords</span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Assign appropriate roles</span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Use valid email addresses</span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Provide clear user names</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for enhanced styling -->
<style>
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
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

<script>
function togglePassword() {
    var input = document.getElementById('password');
    var eyeIcon = document.getElementById('eyeIcon');
    
    if (input.type === 'password') {
        input.type = 'text';
        eyeIcon.className = 'fas fa-eye-slash';
    } else {
        input.type = 'password';
        eyeIcon.className = 'fas fa-eye';
    }
}
</script>
@endsection
