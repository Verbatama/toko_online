<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class LoginUserController extends Controller
{
   public function loginUser(Request $request)
   {
          if (Auth::attempt($request->only('email', 'password'))) {
        if (Auth::user()->role == 'user') {
            return redirect('/dashboard');
        }
        Auth::logout(); // logout jika bukan user
        return back()->withErrors(['email' => 'Akses ditolak']);
    }
    return back()->withErrors(['email' => 'Email atau password salah']);
   }
}
