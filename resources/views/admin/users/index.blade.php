<!DOCTYPE html>
<html>
<head>
    <title>Manage Users - Admin Dashboard</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 min-h-screen">
    <x-layout.navbar />

    <div class="max-w-7xl mx-auto mt-8 px-4 pb-20">
        <h1 class="text-3xl font-semibold text-gray-900 mb-6">Manage Users</h1>
        
        <x-layout.alerts />

        <x-admin.user-table :users="$users" />
    </div>

    <x-admin.action-modal />
    
</body>
</html>
