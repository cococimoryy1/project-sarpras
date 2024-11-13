<?php

namespace App\Http\Controllers;

use App\Models\ErrorLogModel;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        try {
            $data = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            // throw new \Exception('This is a test exception.');

            if (Auth::Attempt($data)) {

                UserActivity::create([
                    'user_id' => Auth::id(),
                    'status' => 'SUCCESS',
                    'method' => request()->route()->getActionName(),
                    'function' => __FUNCTION__,
                    'Deskripsi' => 'melakukan login',
                ]);
                return redirect('/dashboard');
            } else {
                session::flash('error', 'Email atau Password salah');
                return redirect('/');
            }
        } catch (\Exception $e) {
            $data = [
                'user_id' => Auth::id() ?? NULL,
                'errors_date' => now(),
                'controller' => Route::currentRouteAction(),
                'function' => __FUNCTION__,
                'error_line' => $e->getLine(),
                'error_message' => $e->getMessage(),
                'status' => 'ERROR',
                'param' => json_encode($request->all())
            ];
            ErrorLogModel::create($data);
            Session::flash('error', 'Terjadi kesalahan pada sistem. Silakan coba lagi nanti.');
            return redirect('/');
        }
    }
    public function logout(Request $request)
    {

        UserActivity::create([
            'user_id' => Auth::id(),
            'status' => 'SUCCESS',
            'method' => request()->route()->getActionName(),
            'function' => __FUNCTION__,
            'Deskripsi' => 'melakukan logout',
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have successfully logged out');
    }
    //    return redirect()->route('login')->with('succes','Kamu berhasil logout');


    public function store(Request $request)
    {
        User::create([
            'nama_user' => $request->nama_user,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 1
        ]);

        UserActivity::create([
            'user_id' => $request->nama_user,
            'status' => 'SUCCESS',
            'method' => request()->route()->getActionName(),
            'function' => __FUNCTION__,
            'Deskripsi' => 'baru saja melakukan  login',
        ]);

        Session::flash('success', 'Pesan Sukses');
        return redirect('/');
    }
}
