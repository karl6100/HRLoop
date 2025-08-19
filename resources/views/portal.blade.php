<!-- resources/views/portal.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Company Portal</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-7xl mx-auto p-6">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">🏢 Company Portal</h1>
            @auth
                <span>Welcome, {{ auth()->user()->name }}!</span>
            @else
                <a href="{{ route('login') }}" class="text-blue-600">Login</a>
            @endauth
        </header>

        <!-- Announcements -->
        <section class="mb-10">
            <h2 class="text-2xl font-semibold mb-4">📢 Announcements</h2>
            <div class="bg-white p-4 rounded-lg shadow">
                <ul class="list-disc pl-5 space-y-2">
                    <li>New HR System launching next week 🚀</li>
                    <li>Server maintenance on Saturday, 10 PM - 12 AM 🛠️</li>
                    <li>Check out the new Inventory Dashboard 📊</li>
                </ul>
            </div>
        </section>

        <!-- Microservices Links -->
        <section>
            <h2 class="text-2xl font-semibold mb-4">🛠️ Applications</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <a href="http://hr.local" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-bold text-lg">HR System</h3>
                    <p class="text-gray-600">Manage employees, leave requests, and payroll.</p>
                </a>
                <a href="http://inventory.local" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-bold text-lg">Inventory</h3>
                    <p class="text-gray-600">Track products, stock levels, and warehouses.</p>
                </a>
                <a href="http://reports.local" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-bold text-lg">Reports</h3>
                    <p class="text-gray-600">View business intelligence and KPIs.</p>
                </a>
                <!-- Add more tiles as needed -->
            </div>
        </section>
    </div>
</body>
</html>
