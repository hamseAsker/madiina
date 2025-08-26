<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logout - Madiina Dental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        .fade-in { animation: fadeIn 0.5s ease-out; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md fade-in">
        <!-- Logo and Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl mb-6">
                <i class="fas fa-tooth text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Logout</h1>
            <p class="text-gray-600">Are you sure you want to logout?</p>
        </div>

        <!-- Logout Confirmation -->
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl p-8 border border-white/20">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-question text-yellow-600 text-2xl"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Confirm Logout</h2>
                <p class="text-gray-600">You will be logged out of your account and redirected to the home page.</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-4">
                <a href="{{ route('dashboard') }}" 
                   class="flex-1 bg-gray-500 text-white py-3 px-4 rounded-xl font-semibold hover:bg-gray-600 transition-colors duration-200 text-center">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-red-500 to-pink-600 text-white py-3 px-4 rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>

            <!-- Additional Info -->
            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                    <div class="text-sm text-blue-700">
                        <p class="font-medium">Note:</p>
                        <p>Your session will be completely ended. You'll need to log in again to access your account.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Dashboard -->
        <div class="text-center mt-6">
            <a href="{{ route('dashboard') }}" 
               class="text-sm text-gray-600 hover:text-gray-800 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-1"></i>
                Back to Dashboard
            </a>
        </div>
    </div>
</body>
</html>
