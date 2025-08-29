@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-credit-card text-blue-500 mr-3"></i>
            Payment Records
        </h1>
        <a href="{{ route('payments.create') }}" 
           class="bg-gradient-to-r from-blue-500 to-green-600 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
           <i class="fas fa-plus mr-2"></i>
           Add Payment
        </a>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <div class="flex max-w-md space-x-2">
            <div class="relative flex-1">
                <input type="text" 
                       id="payment-search" 
                       placeholder="Search payments..." 
                       class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
            <button type="button" 
                    onclick="searchPayments()"
                    class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                Search
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead class="bg-gradient-to-r from-blue-500 to-green-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                        <i class="fas fa-hashtag mr-2"></i>ID
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                        <i class="fas fa-user mr-2"></i>Patient
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                        <i class="fas fa-dollar-sign mr-2"></i>Payment Amount
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                        <i class="fas fa-calculator mr-2"></i>Total Due
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                        <i class="fas fa-balance-scale mr-2"></i>Remaining
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                        <i class="fas fa-credit-card mr-2"></i>Method
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                        <i class="fas fa-calendar mr-2"></i>Date
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                        <i class="fas fa-info-circle mr-2"></i>Status
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                        <i class="fas fa-cogs mr-2"></i>Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($payments as $payment)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    @if($payment->patient)
                                        {{ $payment->patient->name }}
                                    @else
                                        <span class="text-red-500">Patient ID: {{ $payment->patient_id }} (Not Found)</span>
                                    @endif
                                </div>
                                <div class="text-xs text-gray-500">
                                    @if($payment->patient)
                                        {{ $payment->patient->phone }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-emerald-600">
                        ${{ number_format($payment->amount, 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        @if($payment->total_amount)
                            ${{ number_format($payment->total_amount, 2) }}
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($payment->remaining_balance && $payment->remaining_balance > 0)
                            <span class="px-2 py-1 text-xs font-medium bg-orange-100 text-orange-800 rounded-full">
                                ${{ number_format($payment->remaining_balance, 2) }}
                            </span>
                        @elseif($payment->remaining_balance === 0)
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                Paid in Full
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                            {{ ucfirst(str_replace('_', ' ', $payment->method)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $payment->payment_date ? $payment->payment_date->format('M d, Y g:i A') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($payment->status === 'paid')
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Paid</span>
                        @elseif($payment->status === 'pending')
                            <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Pending</span>
                        @elseif($payment->status === 'failed')
                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Failed</span>
                        @elseif($payment->status === 'refunded')
                            <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">Refunded</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">{{ ucfirst($payment->status) }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('payments.show', $payment) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-sm transition-colors duration-200 shadow-sm">
                           <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('payments.edit', $payment) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-md text-sm transition-colors duration-200 shadow-sm">
                           <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-sm transition-colors duration-200 shadow-sm"
                                    onclick="return confirm('Are you sure you want to delete this payment?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-credit-card text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No payments found</h3>
                            <p class="text-gray-500 mb-4">Get started by recording your first payment.</p>
                            <a href="{{ route('payments.create') }}" 
                               class="bg-gradient-to-r from-blue-500 to-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                <i class="fas fa-plus mr-2"></i>
                                Add Payment
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($payments->hasPages())
        <div class="mt-6">
            {{ $payments->links() }}
        </div>
    @endif
</div>
@endsection
