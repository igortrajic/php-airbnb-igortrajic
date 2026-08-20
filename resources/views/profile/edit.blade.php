<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile - StayFinder</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 min-h-screen">
    <x-layout.navbar />

    <div class="max-w-2xl mx-auto mt-8 px-4 pb-20">
        <h1 class="text-3xl font-semibold text-gray-900 mb-8">Account Settings</h1>

        <x-layout.alerts />

        <div class="space-y-6">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 sm:p-8 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Profile Information</h3>
                <p class="text-sm text-gray-500 mb-6">Update your account's profile information and email address.</p>

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <x-form.input name="name" label="Name" :value="$user->name" required />
                    <x-form.input type="email" name="email" label="Email Address" :value="$user->email" required />

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-6 sm:p-8 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Update Password</h3>
                <p class="text-sm text-gray-500 mb-6">Ensure your account is using a long, random password to stay secure.</p>

                <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <x-form.input type="password" name="current_password" label="Current Password" required />
                    <x-form.input type="password" name="password" label="New Password" required />
                    <x-form.input type="password" name="password_confirmation" label="Confirm Password" required />

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition shadow-sm">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
