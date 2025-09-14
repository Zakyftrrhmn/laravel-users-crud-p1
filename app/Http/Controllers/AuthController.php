<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function formLogin()
    {
        return view('login');
    }

    public function register()
    {
        $jurusans = Jurusan::all();
        return view('register', compact('jurusans'));
    }

    public function registerProses(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'jurusan_id' => 'required',
            'password' => 'required|min:6',
            'photo' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $path = null;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('users', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'jurusan_id' => $request->jurusan_id,
            'password' => Hash::make($request->password),
            'photo' => $path,
        ]);

        return redirect()->route('login')->with('success', 'Successfully Registered your account');
    }

    public function loginProses(Request $request)
    {
        $gredentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($gredentials)) {
            $request->session()->regenerate();
            return redirect()->intended('user')->with('success', 'selamat anda berhasil login');
        }

        return back()->withErrors('email', 'Email/Password anda salah')->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Auth::logout();

        return redirect()->route('login')->with('success', 'anda berhasil logout');
    }
}
