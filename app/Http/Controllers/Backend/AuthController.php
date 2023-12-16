<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct() {

    }

    public function index() {
        return view('backend.auth.login');
    }

    public function login (AuthRequest $request) {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.index')->with('success', 'Login Success!');
        }
        
        return redirect()->route('auth.admin') -> with('error', 'Login failed, Email or password is incorrect!');
    }
    
}
