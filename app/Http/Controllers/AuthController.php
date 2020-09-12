<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{


    public function index()
    {

        return view('pages.auth.index');
    }

    public function auth(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::user();
            if ($user->level == 'Administrator') {
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->route('cashier.index');
            }
        } else {
            return redirect()->route('auth.index')->with([
                'alert' => 'Username atau Password salah !!!'
            ]);
        }
    }
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect()->route('auth.index');
    }
}
