<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobOpening;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display list of active careers.
     */
    public function index()
    {
        $jobs = JobOpening::where('is_active', true)->latest()->get();
        return view('frontend.careers.index', compact('jobs'));
    }

    /**
     * Display job details & application form.
     */
    public function show($slug)
    {
        $job = JobOpening::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('frontend.careers.show', compact('job'));
    }

    /**
     * Handle job application form submission.
     */
    public function apply(Request $request, $slug)
    {
        $job = JobOpening::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'portfolio_link' => 'nullable|url|max:255',
            'resume' => 'required|file|mimes:pdf|max:5120',
            'cover_letter' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'phone.required' => 'Nomor HP/WA wajib diisi.',
            'resume.required' => 'File Resume / CV (PDF) wajib diunggah.',
            'resume.mimes' => 'Format resume harus berupa PDF.',
            'resume.max' => 'Ukuran file resume maksimal 5MB.',
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        JobApplication::create([
            'job_opening_id' => $job->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'portfolio_link' => $request->portfolio_link,
            'resume_path' => $resumePath,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Terima kasih! Lamaran posisi ' . $job->title . ' berhasil dikirim. Tim HR Sekawan Putra Pratama akan meninjau CV Anda.');
    }

    /**
     * Handle spontaneous / open application CV submission.
     */
    public function applySpontaneous(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'portfolio_link' => 'nullable|url|max:255',
            'resume' => 'required|file|mimes:pdf|max:5120',
            'cover_letter' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'phone.required' => 'Nomor HP/WA wajib diisi.',
            'resume.required' => 'File Resume / CV (PDF) wajib diunggah.',
            'resume.mimes' => 'Format resume harus berupa PDF.',
            'resume.max' => 'Ukuran file resume maksimal 5MB.',
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        JobApplication::create([
            'job_opening_id' => null,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'portfolio_link' => $request->portfolio_link,
            'resume_path' => $resumePath,
            'cover_letter' => $request->cover_letter ?? 'Lamaran CV Spontan (Open Application)',
            'status' => 'pending',
        ]);

        return back()->with('success', 'Terima kasih! CV & Lamaran Spontan Anda berhasil dikirim ke Superadmin. Tim HR Sekawan Putra Pratama akan meninjau berkas Anda.');
    }

    /**
     * Check job application status by email or phone.
     */
    public function checkStatus(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:255',
        ], [
            'search.required' => 'Masukkan Email atau Nomor HP/WA Anda.',
        ]);

        $search = trim($request->search);

        $applications = JobApplication::with('jobOpening')
            ->where(function($query) use ($search) {
                $query->where('email', $search)
                      ->orWhere('phone', $search)
                      ->orWhere('email', 'LIKE', "%{$search}%")
                      ->orWhere('phone', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->get();

        if ($applications->isEmpty()) {
            return back()->with('error_status', 'Tidak ditemukan berkas lamaran dengan Email/Nomor HP: ' . $search);
        }

        return back()->with('application_results', $applications)->with('search_query', $search);
    }
}
