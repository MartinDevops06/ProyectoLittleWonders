<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.SessionUser');
    }

    public function create()
    {
        return view('user.RegisterUser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|confirmed|min:6',
            'phone'      => 'required',
            'birth_date' => 'required|date'
        ]);

        $user = User::create([
            'name'       => $request->name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => bcrypt($request->password),
            'phone'      => $request->phone,
            'birth_date' => $request->birth_date,
            'is_admin'   => false
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('address');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.RegisterUser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'phone'      => 'required|string|max:20',
            'birth_date' => 'required|date',
            'email'      => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only([
            'name',
            'last_name',
            'phone',
            'birth_date',
            'email'
        ]));

        // 👉 AQUÍ LA CLAVE
        return redirect()->route('home');
    }
}
