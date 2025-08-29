@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-notes-medical text-blue-500 mr-3"></i>
            Treatments
        </h1>
        <a href="{{ route('treatments.create') }}" 
           class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Add Treatment
        </a>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <div class="flex max-w-md space-x-2">
            <div class="relative flex-1">
                <input type="text" 
                       id="treatment-search" 
                       placeholder="Search treatments..." 
                       class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
            <button type="button" 
                    onclick="searchTreatments()"
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
        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
            <thead class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                        <i class="fas fa-user mr-2"></i>Patient
                    </th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                        <i class="fas fa-user-md mr-2"></i>Doctor
                    </th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                        <i class="fas fa-stethoscope mr-2"></i>Treatment Type
                    </th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                        <i class="fas fa-calendar mr-2"></i>Date
                    </th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                        <i class="fas fa-info-circle mr-2"></i>Description
                    </th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                        <i class="fas fa-dollar-sign mr-2"></i>Cost
                    </th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                        <i class="fas fa-cogs mr-2"></i>Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($treatments as $treatment)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $treatment->patient->name ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user-md text-purple-600 text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $treatment->doctor->name ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $treatment->treatment_type ?? ($treatment->service->name ?? 'N/A') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $treatment->treatment_date ? $treatment->treatment_date->format('M d, Y') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="max-w-xs">
                                <p class="text-sm text-gray-900 truncate" title="{{ $treatment->details }}">
                                    {{ Str::limit($treatment->details ?? 'No description', 50) }}
                                </p>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-semibold text-green-600">
                                ${{ number_format($treatment->cost ?? 0, 2) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('treatments.show', $treatment) }}" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('treatments.edit', $treatment) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('treatments.destroy', $treatment) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                            onclick="return confirm('Are you sure you want to delete this treatment?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-notes-medical text-gray-400 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No treatments found</h3>
                                <p class="text-gray-500 mb-4">Get started by creating your first treatment record.</p>
                                <a href="{{ route('treatments.create') }}" 
                                   class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add Treatment
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($treatments->hasPages())
        <div class="mt-6">
            {{ $treatments->links() }}
        </div>
    @endif
</div>
@endsection
