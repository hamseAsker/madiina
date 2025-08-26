@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dental Services</h1>
        <a href="{{ route('services.create') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
           Add Service
        </a>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <div class="flex max-w-md space-x-2">
            <div class="relative flex-1">
                <input type="text" 
                       id="service-search" 
                       placeholder="Search services..." 
                       class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
            <button type="button" 
                    onclick="searchServices()"
                    class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                Search
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Name</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($services as $service)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $service->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $service->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ $service->description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">${{ number_format($service->price, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('services.show', $service) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-sm transition-colors duration-200 shadow-sm">
                           View
                        </a>
                        <a href="{{ route('services.edit', $service) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-md text-sm transition-colors duration-200 shadow-sm">
                           Edit
                        </a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-sm transition-colors duration-200 shadow-sm"
                                    onclick="return confirm('Are you sure you want to delete this service?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
