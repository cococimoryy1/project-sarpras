<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::all(); // Mengambil semua data pengguna
        return view('users.index', compact('users')); // Mengirim data pengguna ke view
    }
    // Menampilkan formulir pendaftaran pengguna
    public function create()
    {
        return view('users.create'); // Mengirimkan view formulir pendaftaran
    }
    // Memproses pendaftaran pengguna
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
            'id_jenis_user' => 'required|integer|in:1,2,3' // Validasi jenis use
        ]);

        // if ($validator->fails()) {
        //     Log::error('Validation failed:', $validator->errors()->toArray()); // Log kesalahan validasi
        //     return redirect()->route('users.create');
        // }

        User::create([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_jenis_user' => $request->id_jenis_user, // Nilai dari dropdown
        ]);

        $users = User::all();
        return view('users.index', compact('users'))->with('success', 'Pengguna berhasil ditambahkan!');

    }
    // Menampilkan formulir edit pengguna
    public function edit($id)
    {

        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    // Memproses pembaruan pengguna
    public function update(Request $request, $id){

        $data = User::find($id);

        $data->nama_user = $request->nama_user;
        $data->username = $request->username;
        $data->email = $request->email;
    //     $data->no_hp = $request->no_hp;

        $data->save();

        return redirect()->back()->with('success', 'profile berhasil diupdate');

    }

    // Menghapus pengguna
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus!');
    }

}
