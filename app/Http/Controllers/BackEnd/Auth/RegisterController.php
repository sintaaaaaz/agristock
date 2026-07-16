<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('backend.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([

            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',

        ]);

        User::create([

            'name'=>$request->name,

            'email'=>$request->email,

            'password'=>Hash::make(
                $request->password
            ),

            // otomatis user biasa
            'role_id'=>2

        ]);

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Registrasi berhasil, silakan login'
            );
    }
}
