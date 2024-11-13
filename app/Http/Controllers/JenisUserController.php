<?php
namespace App\Http\Controllers;

use App\Models\JenisUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisUserController extends Controller
{
    // Menampilkan semua jenis user
    public function index()
    {
        $jenis_users = JenisUser::all();
        return view('jenis_user.index', compact('jenis_users'));
    }

    // Menyimpan jenis user baru
    public function store(Request $request)
    {
        $request->validate([
            'jenis_user' => 'required|string|max:255',
        ]);

        JenisUser::create([
            'jenis_user' => $request->jenis_user,
            'create_by' => auth()->user()->name ?? 'system',
            'create_date' => now(),
        ]);

        return redirect()->route('jenis_user.index')->with('success', 'Jenis user berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $jenis_user = JenisUser::findOrFail($id);
        return view('jenis_user.edit', compact('jenis_user'));
    }

    // Mengupdate data jenis user
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_user' => 'required|string|max:255',
        ]);

        $jenis_user = JenisUser::findOrFail($id);
        $jenis_user->update([
            'jenis_user' => $request->jenis_user,
            'update_by' => auth()->user()->name ?? 'system',
            'update_date' => now(),
        ]);

        return redirect()->route('jenis_user.index')->with('success', 'Jenis user berhasil diperbarui.');
    }

    // Menghapus jenis user
    public function destroy($id)
    {
        $jenis_user = JenisUser::findOrFail($id);
        $jenis_user->delete();

        return redirect()->route('jenis_user.index')->with('success', 'Jenis user berhasil dihapus.');
    }
}
