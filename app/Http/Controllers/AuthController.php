<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getRegister()
    {
        return view('register');
    }

    public function emailCheck()
    {
        return view('emailCheck');
    }

    public function postRegister(Request $data)
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $email = $data->email;
        $password = $data->password;
        Auth::attempt(['email' => $email, 'password' => $password]);
        return redirect('/emailcheck');
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
            return redirect('/login')->with('result', 'ログイン情報が間違っております');
        }
    }

    public function getLogout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
