<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;



class AuthController extends Controller
{
    public function loginPage()
        {
            return view('auth.login');
        }


          public function login(Request $request)
                {
                    // 1. Validate
                    $request->validate([
                        'email' => 'required|email',
                        'password' => 'required',
                    ]);

                    $credentials = $request->only('email', 'password');

                    // 2. Attempt Login
                    if (Auth::attempt($credentials)) {
                        $request->session()->regenerate();
                        return redirect()->route('dashboard');
                    }

                    // 3. If it fails, return back WITH the input (except password)
                    return back()
                        ->with('error', 'Invalid Email or Password')
                        ->withInput($request->except('password')); 
                }

                public function dashboard()
                    {
                        $user = Auth::user();

                        if ($user->id == 1) {
                            // Admin sees everything
                           // Fetch all tasks, 5 per page
                            $tasks = Task::with('user')->paginate(5);
                        } else {
                            // Fetch only user tasks, 5 per page
                            $tasks = Task::with('user')->where('user_id', $user->id)->paginate(5);
                        }
                        
                        return view('admin.index', compact('tasks'));
                    }
                public function logout(Request $request)
                    {
                        Auth::logout();
                        $request->session()->invalidate();
                        $request->session()->regenerateToken();

                        return redirect()->route('tasks.index');
                    }
}
