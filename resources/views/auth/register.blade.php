<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Madiina Dental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
            50% { box-shadow: 0 0 40px rgba(99, 102, 241, 0.6); }
        }
        .float-animation { animation: float 6s ease-in-out infinite; }
        .pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen py-8">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-200 rounded-full opacity-20 float-animation"></div>
        <div class="absolute top-40 right-20 w-24 h-24 bg-purple-200 rounded-full opacity-20 float-animation" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-indigo-200 rounded-full opacity-20 float-animation" style="animation-delay: 4s;"></div>
    </div>

    <div class="max-w-2xl mx-auto px-4">
        <!-- Logo and Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center ">
              
            </div>
            
        </div>

        <!-- Register Form -->
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl p-8 border border-white/20">
            <form method="POST" action="{{ route('register.post') }}" class="space-y-6">
                @csrf
                <div class="max-w-2xl mx-auto px-4">
        <!-- Logo and Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl mb-6 pulse-glow">
                <i class="fas fa-tooth text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Create Account</h1>
            <p class="text-gray-600">Join Madiina Dental for professional dental care</p>
        </div>

                <!-- Name Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user text-blue-500 mr-2"></i>First Name
                        </label>
                        <input type="text" 
                               name="first_name" 
                               id="first_name"
                               value="{{ old('first_name') }}"
                               required
                               autocomplete="given-name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                               placeholder="Enter first name">
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user text-blue-500 mr-2"></i>Last Name
                        </label>
                        <input type="text" 
                               name="last_name" 
                               id="last_name"
                               value="{{ old('last_name') }}"
                               required
                               autocomplete="family-name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                               placeholder="Enter last name">
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-blue-500 mr-2"></i>Email Address
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                           placeholder="Enter your email">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-phone text-blue-500 mr-2"></i>Phone Number
                    </label>
                    <input type="tel" 
                           name="phone" 
                           id="phone"
                           value="{{ old('phone') }}"
                           autocomplete="tel"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                           placeholder="Enter phone number">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div>
                    <label for="role_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user-tag text-blue-500 mr-2"></i>Role
                    </label>
                    <select name="role_id" 
                            id="role_id"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/50 backdrop-blur-sm">
                        <option value="">Select your role</option>
                        <option value="1">Patient</option>
                        <option value="2">Doctor</option>
                        <option value="3">Receptionist</option>
                        <option value="4">Admin</option>
                    </select>
                    @error('role_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock text-blue-500 mr-2"></i>Password
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password"
                               required
                               autocomplete="new-password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                               placeholder="Create password">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock text-blue-500 mr-2"></i>Confirm Password
                        </label>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation"
                               required
                               autocomplete="new-password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                               placeholder="Confirm password">
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <input type="checkbox" 
                           name="terms" 
                           id="terms"
                           required
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1">
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        I agree to the 
                        <a href="#" class="text-blue-600 hover:text-blue-500 underline">Terms and Conditions</a>
                        and 
                        <a href="#" class="text-blue-600 hover:text-blue-500 underline">Privacy Policy</a>
                    </label>
                </div>

                <!-- Register Button -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 px-4 rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="fas fa-user-plus mr-2"></i>
                    Create Account
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white/80 text-gray-500">Or sign up with</span>
                    </div>
                </div>

                <!-- Social Register Buttons -->
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" 
                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                        <i class="fab fa-google text-red-500 mr-2"></i>
                        Google
                    </button>
                    <button type="button" 
                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                        <i class="fab fa-facebook text-blue-600 mr-2"></i>
                        Facebook
                    </button>
                </div>
            </form>

            <!-- Sign In Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" 
                       class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-200">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('welcome') }}" 
               class="text-sm text-gray-600 hover:text-gray-800 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Home
            </a>
        </div>
    </div>
</body>
</html>
