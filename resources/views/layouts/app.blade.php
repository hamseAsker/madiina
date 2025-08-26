<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madiina Dental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800 flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-tooth text-white text-sm"></i>
                    </div>
                    <span>Madiina Dental</span>
                </a>
                
                <!-- Logo from header -->
                
                
            
                <div class="hidden md:flex space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                   
                    <a href="{{ route('patients.index') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-user-injured mr-2"></i>Patients
                    </a>
                    <a href="{{ route('doctors.index') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-user-md mr-2"></i>Doctors
                    </a>
                    <a href="{{ route('appointments.index') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-calendar-alt mr-2"></i>Appointments
                    </a>
                    <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-stethoscope mr-2"></i>Services
                    </a>
                    <a href="{{ route('treatments.index') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-notes-medical mr-2"></i>Treatments
                    </a>
                    <a href="{{ route('payments.index') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-credit-card mr-2"></i>Payments
                    </a>
                    <a href="{{ route('prescriptions.index') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-prescription mr-2"></i>Prescriptions
                    </a>
                    <a href="{{ route('reports.index') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-chart-bar mr-2"></i>Reports
                    </a>
                </div>

                <!-- User Menu -->
                <div class="relative">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md transition-colors duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>Logout
                        </a> 
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
            </div>
        </div>
    </nav>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        @yield('content')
    </div>

</body>
</html>
