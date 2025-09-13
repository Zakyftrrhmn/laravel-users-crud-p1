<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('jurusan')->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('user.create', compact('jurusans'));
    }

    public function store(Request $request)
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

        return redirect()->route('user.index')->with('success', 'User has been added successfully');
    }

    public function edit(User $user)
    {
        $jurusans = Jurusan::all();
        return view('user.edit', compact('user', 'jurusans'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'jurusan_id' => 'required',
            'password' => 'nullable|min:6',
            'photo' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $path = $user->photo;
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $path = $request->file('photo')->store('users', 'public');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'jurusan_id' => $request->jurusan_id,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'photo' => $path,
        ]);

        return redirect()->route('user.index')->with('success', 'Successfully Edit User Data');
    }

    public function destroy(User $user)
    {
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'Successfully Deleted User Data');
    }
}
