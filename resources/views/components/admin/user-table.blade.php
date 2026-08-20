@props(['users'])

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-center border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500">
                    <th class="px-6 py-4 font-semibold text-center">Name</th>
                    <th class="px-6 py-4 font-semibold text-center">Email</th>
                    <th class="px-6 py-4 font-semibold text-center">Role</th>
                    <th class="px-6 py-4 font-semibold text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-900 font-medium text-center">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-500 text-center">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-center">
                            @if ($user->role === 'admin')
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Admin</span>
                            @else
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 capitalize">{{ $user->role ?? 'User' }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-6">
                                @if ($user->role !== 'admin')
                                    <button type="button"
                                        onclick="openModal('promote', '{{ route('admin.users.promote', $user) }}', @js('Promote ' . $user->name), 'Are you sure you want to promote this user to an Admin? They will have full access to the dashboard.')"
                                        class="text-emerald-600 hover:text-emerald-800 font-medium transition">
                                        Promote
                                    </button>
                                @endif

                                @if ($user->id !== auth()->id())
                                    <button type="button"
                                        onclick="openModal('delete', '{{ route('admin.users.destroy', $user) }}', @js('Delete ' . $user->name), 'Are you sure you want to delete this user? This action is permanent and cannot be undone.')"
                                        class="text-red-600 hover:text-red-800 font-medium transition">
                                        Delete
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $users->links() }}
        </div>
    @endif
</div>
