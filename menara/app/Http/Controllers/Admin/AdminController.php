<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->ismethod('post')) {
            $data = $request->all();

            $required = [
                'username' => 'required|min:5',
                'password' => 'required|min:5',
            ];

            $message = [
                'username.min' => 'Username must be at least 5 characters',
                'username.required' => 'Username is required',
                'password.min' => 'Password must be at least 5 characters',
                'password.required' => 'Password is required',
            ];
            $this->validate($request, $required, $message);

            if (Auth::guard('admin')->attempt(['username' => $data['username'], 'password' => $data['password']])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->withErrors(['login' => 'invalid Username or Password']);
            }

        }
        return view('Admin.login');
    }

    public function dashboard()
    {
        return view('Admin.dashboard');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
