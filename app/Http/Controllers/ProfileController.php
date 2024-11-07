<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set

        // Get the authenticated user
        $user = auth()->user();

        // Update name and email
        $user->name = $request->name;
        $user->email = $request->email;

        // Check if a new password is provided
        if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
        }

        // Save the updated user information to the database
        $user->save();

        // Redirect to the profile page with a success message
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
        
    }
}
