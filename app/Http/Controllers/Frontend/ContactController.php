<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\AutoReplyContact;      // Surat untuk Klien
use App\Mail\AdminLeadNotification; // Surat untuk Admin (BARU)

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        // 1. BERSIHKAN & VALIDASI DUPLIKAT
        $cleanEmail = strtolower(trim($request->input('email')));
        $existingLead = Lead::where('email', $cleanEmail)->exists();

        if ($existingLead) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Mohon maaf, email ini SUDAH TERDAFTAR. Tim kami sedang memproses pesan Anda sebelumnya.');
        }

        // 2. VALIDASI DATA
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service' => 'required|string',
            'message' => 'required|string',
        ], [
            'company_name.required' => 'Nama perusahaan wajib diisi.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'service.required' => 'Silakan pilih layanan yang Anda minati.',
            'message.required' => 'Detail kebutuhan atau pesan wajib diisi.',
        ]);
        $data['email'] = $cleanEmail;

        // 3. SIMPAN DATABASE
        $lead = Lead::create($data);

        // 4. KIRIM EMAIL (DUA ARAH BERBEDA)
        try {
            // A. Ke Klien: Pakai "AutoReplyContact" (Isinya Terima Kasih)
            Mail::to($data['email'])->send(new AutoReplyContact($data));

            // B. Ke Admin: Pakai "AdminLeadNotification" (Isinya Data Teknis & Tombol WA)
            $adminEmail = 'sekawanputrapratama@gmail.com'; 
            Mail::to($adminEmail)->send(new AdminLeadNotification($data)); 
            
        } catch (\Exception $e) {
            \Log::error('Gagal kirim email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Silakan cek inbox email Anda.');
    }
}