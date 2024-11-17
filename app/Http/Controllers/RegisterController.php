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
    $validatedData = $request->validate([
        'email' => 'required|max:200|email:dns',
        'username' => ['required','min:5','max:60'],
        'password' => 'required|min:5'
    ]);

    $validatedData['password']=Hash::make($validatedData['password']);

    $user = User::create($validatedData);
    $id_user = $user->id_user;

    return redirect ('/login')->with('success', 'Registration Successful! Please Login');


    }
}
