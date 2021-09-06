<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

       $canLoginAsAdmin = Auth::attempt([
            'email' => $request->input('email'), 
            'password' => $request->input('password'),
            'role' => '1'
       ]);

       $canLoginAsUser = Auth::attempt([
            'email' => $request->input('email'), 
            'password' => $request->input('password'),
            'role' => '2'
       ]);

        if ($canLoginAsAdmin)
        {
            return redirect('/information');
        }
        elseif ($canLoginAsUser)
        {
            return redirect('/person/' . Auth::user()->id);
        }
        else
        {
            return redirect()->back();
        }

    }


    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'identify' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'dob' => 'required',
                'address' => 'required',
                'telephone' => 'required|numeric',
                'allegry' => 'required',
            ]
        );

        $user = User::create([
            'identify' => $request->input('identify'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'dob' => $request->input('dob'),
            'address' => $request->input('address'),
            'telephone' => $request->input('telephone'),
            'allegry' => $request->input('allegry'),
            'role' => '2'
        ]);

        if ($user) {
            return redirect('/login');
        }
    }

}
