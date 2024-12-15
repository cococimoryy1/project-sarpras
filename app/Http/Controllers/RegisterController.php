<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'email' => 'required|max:200|email:dns',
            'username' => ['required', 'min:5', 'max:60'],
            'password' => 'required|min:5|confirmed', // Gunakan validasi confirmed untuk password
        ]);

        // Enkripsi password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Tambahkan role_id secara default (misalnya, 2 untuk "user biasa")
        $validatedData['role_id'] = 2;

        // Simpan data user ke database
        $user = User::create($validatedData);

        // Redirect ke halaman login dengan pesan sukses
        return redirect('/')->with('success', 'Registration Successful! Please Login');
    }

}
