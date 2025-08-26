 <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Madiina Dental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
            50% { box-shadow: 0 0 40px rgba(99, 102, 241, 0.6); }
        }
        .float-animation { animation: float 6s ease-in-out infinite; }
        .pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen flex items-center justify-center p-4">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-200 rounded-full opacity-20 float-animation"></div>
        <div class="absolute top-40 right-20 w-24 h-24 bg-purple-200 rounded-full opacity-20 float-animation" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-indigo-200 rounded-full opacity-20 float-animation" style="animation-delay: 4s;"></div>
    </div>

    <div class="w-full max-w-md">
        <!-- Login Card -->
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl p-8 border border-white/20">
            
            <!-- ✅ Header with Icon -->
            <div class="text-center mb-6"> 
                
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl mb-4 pulse-glow">
                    <i class="fas fa-tooth text-white text-1xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-600 mb-2">Login Page</h1>
                   <p class="text-gray-600">Join Madiina Dental for professional dental care</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                @csrf

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

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-blue-500 mr-2"></i>Password
                    </label>
                    <input type="password" 
                           name="password" 
                           id="password"
                           required
                           autocomplete="current-password"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                           placeholder="Enter your password">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="remember" 
                               id="remember"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" 
                           class="text-sm text-blue-600 hover:text-blue-500 transition-colors duration-200">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 px-4 rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Sign In
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white/80 text-gray-500">Or continue with</span>
                    </div>
                </div>

                <!-- Social Login Buttons -->
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

            <!-- Sign Up Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" 
                       class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-200">
                        Sign up here
                    </a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('welcome') }}" 
               class="text-sm text-gray-600 hover:text-gray-800 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-1"></i>
                Back to Home
            </a>
        </div>
    </div>
</body>
</html>
