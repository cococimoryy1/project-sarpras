<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id){

        $data = User::find($id);
        return view('profile', compact('data'));
    }
    public function update(Request $request, $id){

        $data = User::find($id);

        $data->nama_user = $request->nama_user;
        $data->username = $request->username;
        $data->email = $request->email;
    //     $data->no_hp = $request->no_hp;

        $data->save();

        return redirect()->back()->with('success', 'profile berhasil diupdate');

    }
}
