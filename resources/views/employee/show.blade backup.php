@extends('layouts.app')

@section('title', 'Employee Details - ' . $employee->name)

@section('content')
<div class="min-h-screen bg-gray-50" id="app">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $employee->avatar }}" alt="{{ $employee->name }}" class="w-16 h-16 rounded-full object-cover">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $employee->name }}</h1>
                            <p class="text-lg text-gray-600">{{ $employee->position }} • {{ $employee->department }}</p>
                            <p class="text-sm text-gray-500">Employee ID: {{ $employee->employee_id }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <select id="employee-selector" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ $emp->id == $employee->id ? 'selected' : '' }}>
                                    {{ $emp->name }}
                                </option>
                            @endforeach
                        </select>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            <i data-lucide="download" class="w-4 h-4 mr-2 inline"></i>
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
                                    <p class="text-2xl font-bold text-gray-900">${{ number_format($employee->compensation->total_compensation ?? 0) }}</p>
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
                                    <p class="text-2xl font-bold text-gray-900">{{ $employee->timeOffBalances->where('type', 'PTO')->first()->balance ?? 0 }} days</p>
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
                                    <p class="text-2xl font-bold text-gray-900">{{ $employee->performanceGoals->where('status', 'completed')->count() }}/{{ $employee->performanceGoals->count() }}</p>
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
                                    <p class="text-2xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($employee->hire_date)->diffInYears(now()) }}</p>
                                </div>
                                <div class="p-3 bg-yellow-100 rounded-lg">
                                    <i data-lucide="award" class="w-6 h-6 text-yellow-600"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-lg shadow-sm border">
                        <div class="p-6 border-b">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Time Off Requests</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                @forelse($employee->timeOffRequests->take(3) as $request)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <div class="p-2 bg-blue-100 rounded-lg">
                                                <i data-lucide="calendar" class="w-4 h-4 text-blue-600"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $request->type }}</p>
                                                <p class="text-sm text-gray-600">{{ $request->start_date->format('M j') }} - {{ $request->end_date->format('M j, Y') }}</p>
                                            </div>
                                        </div>
                                        <span class="px-3 py-1 text-xs font-medium rounded-full 
                                            @if($request->status === 'approved') bg-green-100 text-green-800
                                            @elseif($request->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </div>
                                @empty
                                    <p class="text-gray-500 text-center py-4">No recent time off requests</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Info -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow-sm border">
                        <div class="p-6 border-b">
                            <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <button class="w-full flex items-center px-4 py-3 text-left bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                <i data-lucide="calendar-plus" class="w-5 h-5 text-blue-600 mr-3"></i>
                                <span class="text-blue-700 font-medium">Request Time Off</span>
                            </button>
                            <button class="w-full flex items-center px-4 py-3 text-left bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                                <i data-lucide="file-text" class="w-5 h-5 text-green-600 mr-3"></i>
                                <span class="text-green-700 font-medium">View Pay Stub</span>
                            </button>
                            <button class="w-full flex items-center px-4 py-3 text-left bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                                <i data-lucide="settings" class="w-5 h-5 text-purple-600 mr-3"></i>
                                <span class="text-purple-700 font-medium">Update Benefits</span>
                            </button>
                        </div>
                    </div>

                    <!-- Employee Info -->
                    <div class="bg-white rounded-lg shadow-sm border">
                        <div class="p-6 border-b">
                            <h3 class="text-lg font-semibold text-gray-900">Employee Information</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <p class="text-sm text-gray-600">Department</p>
                                <p class="font-medium text-gray-900">{{ $employee->department }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Position</p>
                                <p class="font-medium text-gray-900">{{ $employee->position }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Hire Date</p>
                                <p class="font-medium text-gray-900">{{ $employee->hire_date->format('M j, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Status</p>
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    {{ ucfirst($employee->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Compensation Tab -->
        <div id="compensation-tab" class="tab-content hidden">
            <div class="space-y-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Compensation Details</h2>
                    <p class="text-gray-600">Your complete compensation package breakdown</p>
                </div>

                @if($employee->compensation)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Current Compensation -->
                    <div class="bg-white rounded-lg shadow-sm border">
                        <div class="p-6 border-b">
                            <h3 class="text-lg font-semibold text-gray-900">Current Compensation</h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Base Salary</span>
                                <span class="text-xl font-bold text-gray-900">${{ number_format($employee->compensation->base_salary) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Target Bonus</span>
                                <span class="text-lg font-semibold text-gray-900">${{ number_format($employee->compensation->bonus_target) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Actual Bonus (YTD)</span>
                                <span class="text-lg font-semibold text-green-600">${{ number_format($employee->compensation->bonus_actual) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Equity Value</span>
                                <span class="text-lg font-semibold text-gray-900">${{ number_format($employee->compensation->equity_value) }}</span>
                            </div>
                            <hr>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-900">Total Compensation</span>
                                <span class="text-2xl font-bold text-green-600">${{ number_format($employee->compensation->total_compensation) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Review Information -->
                    <div class="bg-white rounded-lg shadow-sm border">
                        <div class="p-6 border-b">
                            <h3 class="text-lg font-semibold text-gray-900">Review Schedule</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <p class="text-sm text-gray-600">Last Review</p>
                                <p class="font-medium text-gray-900">{{ $employee->compensation->last_review_date ? $employee->compensation->last_review_date->format('M j, Y') : 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Next Review</p>
                                <p class="font-medium text-gray-900">{{ $employee->compensation->next_review_date ? $employee->compensation->next_review_date->format('M j, Y') : 'N/A' }}</p>
                            </div>
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <div class="flex items-center">
                                    <i data-lucide="info" class="w-5 h-5 text-blue-600 mr-2"></i>
                                    <p class="text-sm text-blue-700">Your next performance review is scheduled for {{ $employee->compensation->next_review_date ? $employee->compensation->next_review_date->format('M j, Y') : 'TBD' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Salary History -->
                @if($employee->compensation->salary_history)
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold text-gray-900">Salary History</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($employee->compensation->salary_history as $history)
                                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                                    <span class="font-medium text-gray-900">{{ $history['year'] }}</span>
                                    <span class="text-lg font-semibold text-gray-900">${{ number_format($history['salary']) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @else
                <div class="text-center py-12">
                    <i data-lucide="dollar-sign" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
                    <p class="text-gray-500">No compensation data available</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Benefits Tab -->
        <div id="benefits-tab" class="tab-content hidden">
            <div class="space-y-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Benefits Enrollment</h2>
                    <p class="text-gray-600">Your current benefits and coverage details</p>
                </div>

                @if($employee->benefitEnrollments->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($employee->benefitEnrollments as $benefit)
                        <div class="bg-white rounded-lg shadow-sm border">
                            <div class="p-6 border-b">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $benefit->benefit_type }}</h3>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full 
                                        @if($benefit->status === 'active') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($benefit->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600">Plan</p>
                                    <p class="font-medium text-gray-900">{{ $benefit->plan_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Coverage Level</p>
                                    <p class="font-medium text-gray-900">{{ $benefit->coverage_level }}</p>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Your Cost</p>
                                        <p class="font-medium text-gray-900">${{ number_format($benefit->employee_cost, 2) }}/month</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Company Cost</p>
                                        <p class="font-medium text-green-600">${{ number_format($benefit->company_cost, 2) }}/month</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Enrolled Since</p>
                                    <p class="font-medium text-gray-900">{{ $benefit->enrollment_date->format('M j, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Benefits Summary -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Benefits Value Summary</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-blue-600">${{ number_format($employee->benefitEnrollments->sum('employee_cost') * 12) }}</p>
                            <p class="text-sm text-gray-600">Your Annual Cost</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-green-600">${{ number_format($employee->benefitEnrollments->sum('company_cost') * 12) }}</p>
                            <p class="text-sm text-gray-600">Company Contribution</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-900">${{ number_format(($employee->benefitEnrollments->sum('employee_cost') + $employee->benefitEnrollments->sum('company_cost')) * 12) }}</p>
                            <p class="text-sm text-gray-600">Total Value</p>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-12">
                    <i data-lucide="shield" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
                    <p class="text-gray-500">No benefits enrollment data available</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Time Off Tab -->
        <div id="time-off-tab" class="tab-content hidden">
            <div class="space-y-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Time Off Management</h2>
                    <p class="text-gray-600">Track your time off balances and requests</p>
                </div>

                <!-- Time Off Balances -->
                @if($employee->timeOffBalances->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    @foreach($employee->timeOffBalances as $balance)
                        <div class="bg-white rounded-lg shadow-sm border">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $balance->type }}</h3>
                                    <div class="p-2 bg-blue-100 rounded-lg">
                                        <i data-lucide="calendar" class="w-5 h-5 text-blue-600"></i>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Current Balance</span>
                                        <span class="font-bold text-2xl text-blue-600">{{ $balance->balance }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Accrued This Year</span>
                                        <span class="text-gray-900">{{ $balance->accrued_this_year }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Used This Year</span>
                                        <span class="text-gray-900">{{ $balance->used_this_year }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Accrual Rate</span>
                                        <span class="text-gray-900">{{ $balance->accrual_rate }}/month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif

                <!-- Recent Requests -->
                @if($employee->timeOffRequests->count() > 0)
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Time Off Requests</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($employee->timeOffRequests as $request)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center space-x-4">
                                        <div class="p-2 bg-blue-100 rounded-lg">
                                            <i data-lucide="calendar" class="w-4 h-4 text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $request->type }}</p>
                                            <p class="text-sm text-gray-600">{{ $request->start_date->format('M j') }} - {{ $request->end_date->format('M j, Y') }} ({{ $request->days_requested }} days)</p>
                                            @if($request->reason)
                                                <p class="text-sm text-gray-500">{{ $request->reason }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full 
                                            @if($request->status === 'approved') bg-green-100 text-green-800
                                            @elseif($request->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                        <p class="text-xs text-gray-500 mt-1">{{ $request->created_at->format('M j, Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-12">
                    <i data-lucide="calendar" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
                    <p class="text-gray-500">No time off requests found</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Perks & Stipends Tab -->
        <div id="perks-tab" class="tab-content hidden">
            <div class="space-y-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Perks & Stipends</h2>
                    <p class="text-gray-600">Track your stipend usage and available perks</p>
                </div>

                @if($employee->stipendUsages->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($employee->stipendUsages as $stipend)
                        <div class="bg-white rounded-lg shadow-sm border">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $stipend->type }}</h3>
                                    <div class="p-2 bg-purple-100 rounded-lg">
                                        <i data-lucide="gift" class="w-5 h-5 text-purple-600"></i>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Annual Budget</span>
                                        <span class="font-semibold text-gray-900">${{ number_format($stipend->annual_budget) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Used</span>
                                        <span class="font-semibold text-red-600">${{ number_format($stipend->used_amount) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Remaining</span>
                                        <span class="font-semibold text-green-600">${{ number_format($stipend->remaining_amount) }}</span>
                                    </div>
                                    
                                    <!-- Progress Bar -->
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Usage</span>
                                            <span class="text-gray-900">{{ number_format($stipend->usage_percentage, 1) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: {{ min($stipend->usage_percentage, 100) }}%"></div>
                                        </div>
                                    </div>
                                    
                                    @if($stipend->last_used_date)
                                        <div class="text-sm text-gray-500">
                                            Last used: {{ $stipend->last_used_date->format('M j, Y') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <i data-lucide="gift" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
                    <p class="text-gray-500">No stipend data available</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Documents Tab -->
        <div id="documents-tab" class="tab-content hidden">
            <div class="space-y-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Documents & Forms</h2>
                    <p class="text-gray-600">Access your employment documents and forms</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Pay Stubs -->
                    <div class="bg-white rounded-lg shadow-sm border">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="p-3 bg-green-100 rounded-lg mr-4">
                                    <i data-lucide="file-text" class="w-6 h-6 text-green-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Pay Stubs</h3>
                            </div>
                            <p class="text-gray-600 mb-4">Download your recent pay stubs</p>
                            <button class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                View Pay Stubs
                            </button>
                        </div>
                    </div>

                    <!-- Tax Documents -->
                    <div class="bg-white rounded-lg shadow-sm border">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="p-3 bg-blue-100 rounded-lg mr-4">
                                    <i data-lucide="calculator" class="w-6 h-6 text-blue-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Tax Documents</h3>
                            </div>
                            <p class="text-gray-600 mb-4">W-2s and other tax forms</p>
                            <button class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                View Tax Forms
                            </button>
                        </div>
                    </div>

                    <!-- Benefits Documents -->
                    <div class="bg-white rounded-lg shadow-sm border">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="p-3 bg-purple-100 rounded-lg mr-4">
                                    <i data-lucide="shield" class="w-6 h-6 text-purple-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Benefits</h3>
                            </div>
                            <p class="text-gray-600 mb-4">Insurance cards and summaries</p>
                            <button class="w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                View Benefits
                            </button>
                        </div>
                    </div>

                    <!-- Employee Handbook -->
                    <div class="bg-white rounded-lg shadow-sm border">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="p-3 bg-yellow-100 rounded-lg mr-4">
                                    <i data-lucide="book-open" class="w-6 h-6 text-yellow-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Handbook</h3>
                            </div>
                            <p class="text-gray-600 mb-4">Employee handbook and policies</p>
                            <button class="w-full bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors">
                                View Handbook
                            </button>
                        </div>
                    </div>

                    <!-- Performance Reviews -->
                    <div class="bg-white rounded-lg shadow-sm border">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="p-3 bg-red-100 rounded-lg mr-4">
                                    <i data-lucide="trending-up" class="w-6 h-6 text-red-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Reviews</h3>
                            </div>
                            <p class="text-gray-600 mb-4">Performance review documents</p>
                            <button class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                View Reviews
                            </button>
                        </div>
                    </div>

                    <!-- Emergency Contacts -->
                    <div class="bg-white rounded-lg shadow-sm border">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="p-3 bg-indigo-100 rounded-lg mr-4">
                                    <i data-lucide="phone" class="w-6 h-6 text-indigo-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Contacts</h3>
                            </div>
                            <p class="text-gray-600 mb-4">Emergency contact information</p>
                            <button class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                                Update Contacts
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
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
@endpush
@endsection