<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\ContactMessage;
use App\Models\Lead;
use App\Mail\AdminLeadNotification; 
use App\Mail\AutoReplyContact;     
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    
    public function newsletterStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email:filter|unique:newsletter_subscribers,email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah berlangganan sebelumnya.',
        ]);

        NewsletterSubscriber::create([
            'email' => $request->email,
            'is_active' => true,
        ]);

        return back()->with('success', 'Terima kasih telah berlangganan newsletter kami!');
    }

    
    public function home()
    {
        $portfolios = Portfolio::orderBy('created_at', 'desc')->take(8)->get();
        $portfolioCategories = PortfolioCategory::with(['portfolios' => function($query) {
            $query->take(4);
        }])->get();
        $latestBlogs = BlogPost::where('status', 'published')
            ->with('category')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.home', compact('portfolios', 'portfolioCategories', 'latestBlogs'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }


    public function contactStore(Request $request)
    {
        $cleanEmail = strtolower(trim($request->input('email')));
        
        // Cek apakah email sudah ada di tabel Leads
        $existingLead = Lead::where('email', $cleanEmail)->exists();

        if ($existingLead) {
            return back()
                ->withInput()
                ->with('error', 'Mohon maaf, email ini SUDAH TERDAFTAR. Tim kami sedang memproses pesan Anda sebelumnya.');
        }

        // VALIDASI
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20', 
            'service' => 'required|string|max:100',
            'message' => 'required|string',
        ]);
        
        // Override email dengan versi bersih
        $validated['email'] = $cleanEmail;

        try {
            // A. Simpan ke tabel ContactMessage (Arsip Pesan)

            ContactMessage::create($validated);

            // B. Simpan ke tabel Leads (Data CRM)
            $leadData = [
                'company_name' => $validated['company_name'],
                'contact_person' => $validated['name'], // Mapping: name -> contact_person
                'name' => $validated['name'],           // Mapping: jaga-jaga jika view email butuh 'name'
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'service' => $validated['service'],     // Simpan service agar bisa dipanggil email
                'message' => $validated['message'],     // Simpan message agar bisa dipanggil email
                'status' => 'new',
                'source' => 'website',
                
                'notes' => "Layanan: " . ($validated['service'] ?? '-') . "\n\nPesan:\n" . $validated['message'],
            ];
            
            // Simpan Lead
            $lead = Lead::create($leadData); 
            
            // 1. Ke Admin
            Mail::to('sekawanputrapratama@gmail.com')->send(new AdminLeadNotification($leadData));

            // 2. Ke Client
            Mail::to($leadData['email'])->send(new AutoReplyContact($leadData));

            return back()->with('success', 'Terima kasih! Pesan Anda telah kami terima. Tim kami akan menghubungi Anda segera.');
            
        } catch (\Exception $e) {
            \Log::error('Contact Form Error: ' . $e->getMessage());
            return back()->with('error', 'Maaf, terjadi kesalahan teknis. Silakan hubungi kami via WhatsApp.');
        }
    }
}