<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function __construct() {
        $this->middleware(['guest']);
    }

    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        // Validation
        $this->validate($request, [
            'name'      => 'required|min:4',
            'username'  => 'required|min:5',
            'email'     => 'required|email',
            'password'  => 'required|confirmed'
        ]);

        // Store User
        User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
        
        // Sign the user
        auth()->attempt($request->only('email', 'password'));

        // Redirect
        return redirect()->route('dashboard');
    }
}