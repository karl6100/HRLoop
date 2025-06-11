{{-- <!-- @extends('layouts.app') --> --}}

{{-- <!-- @section('title', 'Employee Details - ' . $employee->name) --> --}}

{{-- <!-- @section('content') --> --}}
<div class="min-h-screen bg-gray-50" id="app">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                    {{--    <!-- <img src="{{ $employee->avatar }}" alt="{{ $employee->name }}" class="w-16 h-16 rounded-full object-cover"> --> --}}
                        <img src="path/to/avatar.jpg" alt="Employee Name" class="w-16 h-16 rounded-full object-cover">
                        <div>
                        {{--    <!-- <h1 class="text-3xl font-bold text-gray-900">{{ $employee->name }}</h1> --> --}}
                            <h1 class="text-3xl font-bold text-gray-900">Employee Name</h1>
                            {{--    <!-- <p class="text-lg text-gray-600">{{ $employee->position }} • {{ $employee->department }}</p> --> --}}
                            <p class="text-lg text-gray-600">Position • Department</p>
                            {{--    <!-- <p class="text-sm text-gray-500">Employee ID: {{ $employee->employee_id }}</p> --> --}}
                            <p class="text-sm text-gray-500">Employee ID: EMP001</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                    {{--    <!-- <select id="employee-selector" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"> --> --}}
                        <select id="employee-selector" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        {{-- <!-- @foreach($employees as $emp) --> --}}
                        {{--    <!-- <option value="{{ $emp->id }}" {{ $emp->id == $employee->id ? 'selected' : '' }}> --> --}}
                            {{--   <!-- {{ $emp->name }} --> --}}
                                {{--   <!-- </option> --> --}}
                                    {{--  <!-- @endforeach --> --}}
                            <option value="1" selected>Employee Name 1</option>
                            <option value="2">Employee Name 2</option>
                            <option value="3">Employee Name 3</option>
                        </select>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        {{--    <!-- <i data-lucide="download" class="w-4 h-4 mr-2 inline"></i> --> --}}
                            <i class="w-4 h-4 mr-2 inline"></i>
                            Export Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex space-x-8">
                <button class="tab-button flex items-center px-3 py-4 text-sm font-medium border-b-2 border-blue-500 text-blue-600" data-tab="overview">
                    <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                    Overview
                </button>
                <button class="tab-button flex items-center px-3 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors" data-tab="compensation">
                    <i data-lucide="dollar-sign" class="w-4 h-4 mr-2"></i>
                    Compensation
                </button>
                <button class="tab-button flex items-center px-3 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors" data-tab="benefits">
                    <i data-lucide="shield" class="w-4 h-4 mr-2"></i>
                    Benefits
                </button>
                <button class="tab-button flex items-center px-3 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors" data-tab="time-off">
                    <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                    Time Off
                </button>
                <button class="tab-button flex items-center px-3 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors" data-tab="perks">
                    <i data-lucide="star" class="w-4 h-4 mr-2"></i>
                    Perks & Stipends
                </button>
                <button class="tab-button flex items-center px-3 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors" data-tab="documents">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Documents
                </button>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Overview Tab -->
        <div id="overview-tab" class="tab-content">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Key Metrics -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Total Compensation</p>
                                    {{--    <!-- <p class="text-2xl font-bold text-gray-900">${{ number_format($employee->compensation->total_compensation ?? 0) }}</p> --> --}}
                                    <p class="text-2xl font-bold text-gray-900">$100,000</p>
                                </div>
                                <div class="p-3 bg-green-100 rounded-lg">
                                    <i data-lucide="trending-up" class="w-6 h-6 text-green-600"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">PTO Balance</p>
                            {{--       <!-- <p class="text-2xl font-bold text-gray-900">{{ $employee->timeOffBalances->where('type', 'PTO')->first()->balance ?? 0 }} days</p> --> --}} 
                                    <p class="text-2xl font-bold text-gray-900">15 days</p>
                                </div>
                                <div class="p-3 bg-blue-100 rounded-lg">
                                    <i data-lucide="calendar" class="w-6 h-6 text-blue-600"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Performance Goals</p>
                                    {{--     <!-- <p class="text-2xl font-bold text-gray-900">{{ $employee->performanceGoals->where('status', 'completed')->count() }}/{{ $employee->performanceGoals->count() }}</p> --> --}} 
                                    <p class="text-2xl font-bold text-gray-900">5/10</p>
                                </div>
                                <div class="p-3 bg-purple-100 rounded-lg">
                                    <i data-lucide="target" class="w-6 h-6 text-purple-600"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Years of Service</p>
                                    {{--    <!-- <p class="text-2xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($employee->hire_date)->diffInYears(now()) }}</p> --> --}}
                                    <p class="text-2xl font-bold text-gray-900">3</p>
                                </div>
                                <div class="p-3 bg-yellow-100 rounded-lg">
                                    <i data-lucide="award" class="w-6 h-6 text-yellow-600"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- @endsection -->

<!-- @push('scripts') -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active classes from all tabs
            tabButtons.forEach(btn => {
                btn.classList.remove('border-blue-500', 'text-blue-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Add active class to clicked tab
            this.classList.remove('border-transparent', 'text-gray-500');
            this.classList.add('border-blue-500', 'text-blue-600');
            
            // Hide all tab contents
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            
            // Show target tab content
            document.getElementById(targetTab + '-tab').classList.remove('hidden');
        });
    });
    
    // Employee selector functionality
    const employeeSelector = document.getElementById('employee-selector');
    if (employeeSelector) {
        employeeSelector.addEventListener('change', function() {
            const selectedEmployeeId = this.value;
            window.location.href = `/employees/${selectedEmployeeId}`;
        });
    }
    
    // Initialize Lucide icons
    lucide.createIcons();
});
</script>
<!-- @endpush -->