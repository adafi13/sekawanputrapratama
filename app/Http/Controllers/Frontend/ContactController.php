<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactFormRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function showContactForm(): View
    {
        return view('frontend.contact');
    }

    public function submitContactForm(ContactFormRequest $request): RedirectResponse
    {
        $message = ContactMessage::create($request->validated());

        // TODO: Send email notification
        // Mail::to(config('mail.from.address'))->send(new ContactFormMail($message));

        return redirect()->route('contact')
            ->with('success', 'Terima kasih! Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');
    }
}
