<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    // Validate the request data
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        's_number' => ['required', 'string', 'max:20', 'unique:users'], // Validate s_number
        'role' => ['required', 'string', 'in:student,teacher'], // Validate role input
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    // Create and store the user in the database
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        's_number' => $request->s_number, // Ensure s_number is included
        'role' => $request->role, // Store the selected role
        'password' => Hash::make($request->password),
    ]);

    // Fire the Registered event
    event(new Registered($user));

    // Log in the newly created user
    Auth::login($user);

    // Redirect to the intended page after login
    return redirect()->intended(RouteServiceProvider::HOME);
}

}
