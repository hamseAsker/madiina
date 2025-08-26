@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-8 text-white shadow-2xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Welcome to Madiina Dental</h1>
                <p class="text-xl text-blue-100">Manage your dental clinic operations efficiently</p>
            </div>
            <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-tooth text-white text-4xl"></i>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Patients -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Patients</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalPatients }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-injured text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-green-600">
                <i class="fas fa-arrow-up mr-1"></i>
                <span>12% increase</span>
            </div>
        </div>

        <!-- Total Doctors -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Doctors</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalDoctors }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-md text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-green-600">
                <i class="fas fa-arrow-up mr-1"></i>
                <span>8% increase</span>
            </div>
        </div>

        <!-- Total Appointments -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Today's Appointments</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $todayAppointments }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-blue-600">
                <i class="fas fa-clock mr-1"></i>
                <span>Next: 2:30 PM</span>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Monthly Revenue</p>
                    <p class="text-3xl font-bold text-gray-900">${{ number_format($monthlyRevenue) }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-yellow-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-green-600">
                <i class="fas fa-arrow-up mr-1"></i>
                <span>15% increase</span>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Server Usage Chart -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-server text-indigo-500 mr-2"></i>
                    Server Usage
                </h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-xs bg-indigo-100 text-indigo-800 rounded-full">CPU</button>
                    <button class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">RAM</button>
                    <button class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">Storage</button>
                </div>
            </div>
            <div class="h-64">
                <canvas id="serverUsageChart"></canvas>
            </div>
        </div>

        <!-- Monthly Statistics Chart -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-chart-line text-green-500 mr-2"></i>
                    Monthly Statistics
                </h3>
                <select class="px-3 py-1 border border-gray-300 rounded-lg text-sm">
                    <option>Last 6 Months</option>
                    <option>Last Year</option>
                    <option>All Time</option>
                </select>
            </div>
            <div class="h-64">
                <canvas id="monthlyStatsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Appointments -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-clock text-blue-500 mr-2"></i>
                Recent Appointments
            </h3>
            <div class="space-y-4">
                @forelse($recentAppointments as $appointment)
                <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-blue-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ $appointment->patient->name ?? 'Unknown' }}</p>
                        <p class="text-xs text-gray-500">{{ $appointment->appointment_time ? $appointment->appointment_time->format('g:i A') : 'N/A' }} - {{ $appointment->doctor->name ?? 'Unknown' }}</p>
                    </div>
                    <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Confirmed</span>
                </div>
                @empty
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-gray-500">No appointments today</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                Quick Actions
            </h3>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('appointments.create') }}" class="p-4 bg-blue-50 rounded-lg text-center hover:bg-blue-100 transition-colors duration-200">
                    <i class="fas fa-calendar-plus text-blue-600 text-2xl mb-2"></i>
                    <p class="text-sm font-medium text-blue-800">New Appointment</p>
                </a>
                <a href="{{ route('patients.create') }}" class="p-4 bg-green-50 rounded-lg text-center hover:bg-green-100 transition-colors duration-200">
                    <i class="fas fa-user-plus text-green-600 text-2xl mb-2"></i>
                    <p class="text-sm font-medium text-green-800">Add Patient</p>
                </a>
                <a href="{{ route('payments.create') }}" class="p-4 bg-purple-50 rounded-lg text-center hover:bg-purple-100 transition-colors duration-200">
                    <i class="fas fa-credit-card text-purple-600 text-2xl mb-2"></i>
                    <p class="text-sm font-medium text-purple-800">Record Payment</p>
                </a>
                <a href="{{ route('reports.create') }}" class="p-4 bg-indigo-50 rounded-lg text-center hover:bg-indigo-100 transition-colors duration-200">
                    <i class="fas fa-chart-bar text-indigo-600 text-2xl mb-2"></i>
                    <p class="text-sm font-medium text-indigo-800">Generate Report</p>
                </a>
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                System Status
            </h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Database</span>
                    <span class="flex items-center text-green-600">
                        <i class="fas fa-circle text-xs mr-2"></i>
                        Online
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Backup</span>
                    <span class="flex items-center text-green-600">
                        <i class="fas fa-circle text-xs mr-2"></i>
                        Active
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Security</span>
                    <span class="flex items-center text-green-600">
                        <i class="fas fa-circle text-xs mr-2"></i>
                        Protected
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Updates</span>
                    <span class="flex items-center text-yellow-600">
                        <i class="fas fa-circle text-xs mr-2"></i>
                        Available
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Server Usage Chart with real data
const serverCtx = document.getElementById('serverUsageChart').getContext('2d');
const serverChart = new Chart(serverCtx, {
    type: 'doughnut',
    data: {
        labels: ['CPU Usage', 'RAM Usage', 'Storage Usage', 'Network'],
        datasets: [{
            data: [{{ $serverUsage['cpu'] }}, {{ $serverUsage['ram'] }}, {{ $serverUsage['storage'] }}, {{ $serverUsage['network'] }}],
            backgroundColor: [
                '#3B82F6', // Blue
                '#8B5CF6', // Purple
                '#10B981', // Green
                '#F59E0B'  // Yellow
            ],
            borderWidth: 0,
            hoverOffset: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.parsed + '%';
                    }
                }
            }
        },
        cutout: '60%'
    }
});

// Monthly Statistics Chart with real data
const monthlyCtx = document.getElementById('monthlyStatsChart').getContext('2d');
const monthlyChart = new Chart(monthlyCtx, {
    type: 'bar',
    data: {
        labels: @json(array_column($monthlyStats, 'month')),
        datasets: [{
            label: 'Patients',
            data: @json(array_column($monthlyStats, 'patients')),
            backgroundColor: '#3B82F6',
            borderRadius: 8
        }, {
            label: 'Appointments',
            data: @json(array_column($monthlyStats, 'appointments')),
            backgroundColor: '#8B5CF6',
            borderRadius: 8
        }, {
            label: 'Revenue ($K)',
            data: @json(array_column($monthlyStats, 'revenue')),
            backgroundColor: '#10B981',
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    usePointStyle: true,
                    padding: 20
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#E5E7EB'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>
@endsection
