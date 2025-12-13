<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.RegisterAddress',);
    }

    public function store(Request $request)
    {
        $request->validate([
            'contact_name'  => 'required|string|max:100',
            'contact_phone' => 'required|string|max:20',
            'city'          => 'required|string|max:100',
            'department'    => 'required|string|max:100',
            'address'       => 'required|string|max:255',
            'reference'     => 'nullable|string|max:255',
        ]);

        Auth::user()->addresses()->create([
            'contact_name'  => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'city'          => $request->city,
            'department'    => $request->department,
            'address'       => $request->address,
            'reference'     => $request->reference,
            'is_primary'    => true,
        ]);

        return redirect()->route('home');
    }
}
