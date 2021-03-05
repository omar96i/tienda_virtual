<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
        return view('default/products/home');
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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($type == "client"){
            $user->assignRole('client');
        }else{
            $user->assignRole('admin');
        }

        return response()->json([
            'saved' => true,
            'user' => $user
        ]);
    }
    public function delete(User $user){
        $user->delete();
        return $user;
    }
}
