<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function promote(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'User is already an admin.');
        }

        $user->update(['role' => 'admin']);

        return back()->with('success', "{$user->name} has been promoted to Admin.");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
