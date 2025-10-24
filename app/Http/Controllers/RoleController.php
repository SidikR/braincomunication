<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()) {
            // return redirect()->route('admin.dashboard');
            return redirect()->to($previousUrl ?? 'dashboard/' . Auth::user()->role);
        } else {
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('status', 'You are not authorized to access this page.');
        }
        // return redirect()->to($previousUrl ?? 'dashboard/' . $role_user);
    }
}
