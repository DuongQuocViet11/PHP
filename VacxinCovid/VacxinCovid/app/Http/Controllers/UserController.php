<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function allUser()
    {
        $users = User::where('role', 2)->get();
        return view('information', [
            'users' => $users
        ]);
    }

    public function person()
    {
        return view('person');
    }
}
