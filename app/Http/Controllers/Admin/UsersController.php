<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // View user details
    public function show(User $user)
    {
        $user->load('paidMartials');
        return view('admin.users.show', compact('user'));
    }

    // Show edit form
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        // Validate the inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
            'balance' => 'nullable|numeric|min:0',
        ]);

        // Proceed with updating the user if validation passes
        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
