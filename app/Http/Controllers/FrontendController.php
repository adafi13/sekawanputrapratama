<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Brand;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\ContactMessage;
use App\Models\Lead;
use App\Models\Service;
use App\Models\Testimonial;
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

    public function newsletterUnsubscribe(NewsletterSubscriber $subscriber)
    {
        $subscriber->update(['is_active' => false]);

        return redirect()->route('blog.index')->with('success', 'Anda telah berhasil berhenti berlangganan newsletter.');
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

        $testimonials = Testimonial::where('is_featured', true)
            ->orderBy('order')
            ->take(6)
            ->get();

        $brands = Brand::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('frontend.home', compact('portfolios', 'portfolioCategories', 'latestBlogs', 'testimonials', 'brands'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function services()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('frontend.services', compact('services'));
    }

    public function serviceShow($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('order')
            ->take(3)
            ->get();

        $portfolios = Portfolio::where('service_id', $service->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.services.show', compact('service', 'relatedServices', 'portfolios'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }


    public function contactStore(Request $request)
    {
        // Honeypot: bot-only field, invisible to real users. Pretend success without processing.
        if ($request->filled('website')) {
            return back()->with('success', 'Terima kasih! Pesan Anda telah kami terima. Tim kami akan menghubungi Anda segera.');
        }

        $cleanEmail = strtolower(trim($request->input('email')));

        // VALIDASI
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20', 
            'service' => 'required|string|max:100',
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
        
        // Override email dengan versi bersih
        $validated['email'] = $cleanEmail;

        try {
            // A. Simpan ke tabel ContactMessage (Arsip Pesan)
            ContactMessage::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'service_type' => $validated['service'],
                'message' => $validated['message'],
            ]);

            // B. Simpan / Perbarui tabel Leads (Data CRM)
            $existingLead = Lead::where('email', $cleanEmail)->first();

            $leadData = [
                'company_name' => $validated['company_name'],
                'contact_person' => $validated['name'],
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'service' => $validated['service'],
                'message' => $validated['message'],
            ];

            if ($existingLead) {
                // Update Lead yang sudah ada
                $newNote = "\n\n--- Pesan Baru (" . now()->format('d M Y H:i') . ") ---\nLayanan: " . $validated['service'] . "\nPesan:\n" . $validated['message'];
                $existingLead->notes = ($existingLead->notes ?? '') . $newNote;
                $existingLead->company_name = $validated['company_name'];
                $existingLead->contact_person = $validated['name'];
                if (!empty($validated['phone'])) {
                    $existingLead->phone = $validated['phone'];
                }
                
                // Jika status sebelumnya lost, hidupkan kembali sebagai new lead
                if ($existingLead->status === 'lost') {
                    $existingLead->status = 'new';
                }
                
                $existingLead->touch();
                $existingLead->save();
            } else {
                // Buat Lead Baru
                Lead::create([
                    'company_name' => $validated['company_name'],
                    'contact_person' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'] ?? null,
                    'status' => 'new',
                    'source' => 'website',
                    'notes' => "Layanan: " . ($validated['service'] ?? '-') . "\n\nPesan:\n" . $validated['message'],
                ]);
            }
            
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