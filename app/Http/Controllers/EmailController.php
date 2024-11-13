<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message; // Model untuk tabel MESSAGE
use App\Models\MessageTo; // Model untuk tabel MESSAGE_TO
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    // Menampilkan form kirim email
    public function create()
    {
        $menus = Menu::all();
        return view('Email.create', compact('menus')); // Mengarahkan ke form email
    }

    // Proses mengirim email
    public function send(Request $request)
    {

        // Simpan data email ke tabel MESSAGE
        $message = new Message();
        $message->subject = $request->subject;
        $message->sender = Auth::user()->email; // email user yang sedang login
        $message->message_text = $request->message_text;
        $message->create_by =  Auth::user()->name;
        $message->create_date = now();
        $message->save();

        // Simpan data penerima ke tabel MESSAGE_TO
        $messageTo = new MessageTo();
        $messageTo->id_message = $message->id;
        $messageTo->to = $request->to;
        $messageTo->create_by =  Auth::user()->name;
        $messageTo->create_date = now();
        $messageTo->save();

        return redirect()->back()->with('success', 'Email berhasil dikirim.');
    }
    public function inbox()
    {
        // Mengambil daftar email yang dikirim ke user yang sedang login
        $userEmail = Auth::user()->email;

        // Query untuk mengambil email yang ditujukan kepada user
        $emails = MessageTo::where('to', $userEmail)
                    ->join('message', 'message_to.id_message', '=', 'message.id')
                    ->select('message.id', 'message.subject', 'message.message_text', 'message.create_date', 'message.sender')
                    ->orderBy('message.create_date', 'desc')
                    ->get();
        $menus = Menu::all();
        // Mengirim data email ke view inbox
        return view('Email.inbox', compact('emails', 'menus'));

    }


// public function view($message_id)
// {
//     $message = Message::findOrFail($message_id);
//     $message->message_status = 'read';  // Update status jadi 'read'
//     $message->save();

//     return view('Email.detail', compact('message'));
// }

    public function reply(Request $request, $id)
{
        // Validasi input
        $request->validate([
            'reply_message' => 'required|string|max:1000',
        ]);

        // Mengambil email yang akan dibalas berdasarkan ID
        $email = Message::findOrFail($id);

        // Membuat email baru sebagai balasan
        $reply = new Message();
        $reply->sender = Auth::user()->email; // Pengirim balasan (user yang login)
        $reply->message_text = $request->reply_message; // Pesan balasan dari form
        $reply->create_by = Auth::user()->name;
        $reply->create_date = now();
        $reply->save();

        //  dd('Balasan terkirim:', $reply);
        // Simpan penerima balasan ke tabel MESSAGE_TO
        $messageTo = new MessageTo();
        $messageTo->id_message = $reply->id;
        $messageTo->to = $email->sender; // Balasan dikirim ke pengirim asli
        $messageTo->create_by = Auth::user()->name;
        $messageTo->create_date = now();
        $messageTo->save();
        $email = Message::findOrFail($id); // Ambil lagi email untuk menampilkan detailnya

        $message = Message::findOrFail($id);
        return view('Email.detail', compact('message'));
    }
    public function show($id)
    {
        // dd($id);
        // Mengambil email berdasarkan ID
        $message = Message::findOrFail($id);

        // Menampilkan view untuk email detail
        return view('Email.detail', compact('message'));
    }
    // public function compose()
    // {
    //     return view('Email.compose');
    // }
}
