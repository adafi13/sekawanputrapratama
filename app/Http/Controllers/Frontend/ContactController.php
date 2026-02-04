<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\AutoReplyContact; // Memanggil file mailer yang baru dibuat

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service' => 'required|string',
            'message' => 'required|string',
        ]);

        // 2. Simpan ke Database (Lead)
        // Pastikan Model Lead Anda punya $fillable yang sesuai
        $lead = Lead::create($data);

        // 3. KIRIM EMAIL OTOMATIS KE CLIENT
        try {
            Mail::to($data['email'])->send(new AutoReplyContact($data));
        } catch (\Exception $e) {
            // Jika email gagal kirim, kita catat errornya di log tapi tidak stop aplikasi
            // agar user tetap melihat pesan sukses di layar.
            \Log::error('Gagal mengirim email auto-reply: ' . $e->getMessage());
        }

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Silakan cek inbox email Anda untuk konfirmasi.');
    }
}