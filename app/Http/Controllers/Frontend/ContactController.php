<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function showContactForm(): View
    {
        return view('frontend.contact');
    }

    public function submitContactForm(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'service_type' => ['nullable', 'string'],
            'message' => ['required', 'string'],
        ]);

        $message = ContactMessage::create($validated);

        // TODO: Send email notification
        // Mail::to(config('mail.from.address'))->send(new ContactFormMail($message));

        return redirect()->route('contact')
            ->with('success', 'Terima kasih! Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');
    }
}
