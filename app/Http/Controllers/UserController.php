<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loginSystem(Request $request)
    {
        $user_data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($user_data)) {
            return redirect()->route('home');
        }
        return view('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function index()
    {
        $user = User::get();
        return view('admin/user/user', ['users' => $user]);
    }

    public function register(Request $request, $type)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($type == "admin") {
            $user->assignRole('admin');
        } else if ($type == "client") {
            $user->assingRole('client');
        }

        return response()->json([
            'saved' => true,
            'user' => $user
        ]);
    }
}
