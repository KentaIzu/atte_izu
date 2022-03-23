<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getRegister()
    {
        return view('register'); 
    }

    public function postRegister(Request $data) 
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return redirect('/login');
    }

    public function getLogin()
    {
        return view('login');
    }
    public function postLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect('/');
        } else {
            return redirect('login');
        }
    }

    public function getLogout(Request $request)
    {
        auth()->logout();
        return redirect('/login');
    }
}
