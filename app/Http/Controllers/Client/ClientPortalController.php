<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Contract;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClientPortalController extends Controller
{
    /**
     * Get currently logged-in customer.
     */
    protected function customer()
    {
        return Auth::guard('customer')->user();
    }

    /**
     * Client Portal Dashboard Summary.
     */
    public function dashboard()
    {
        $customer = $this->customer();

        // Projects for this customer
        $projects = Project::where('customer_id', $customer->id)
            ->with(['contract', 'invoices'])
            ->orderBy('created_at', 'desc')
            ->get();

        $activeProjects = $projects->whereNotIn('status', [Project::STATUS_COMPLETED, Project::STATUS_CANCELLED]);
        $completedProjects = $projects->where('status', Project::STATUS_COMPLETED);

        // Contracts for this customer
        $contracts = Contract::where('customer_id', $customer->id)->get();

        // Invoices through customer's projects
        $invoices = Invoice::whereIn('project_id', $projects->pluck('id'))
            ->orderBy('due_date', 'asc')
            ->get();

        $pendingInvoices = $invoices->whereIn('status', [Invoice::STATUS_PENDING, Invoice::STATUS_SENT, Invoice::STATUS_OVERDUE]);
        $outstandingTotal = $pendingInvoices->sum('amount');
        $paidTotal = $invoices->where('status', Invoice::STATUS_PAID)->sum('amount');

        return view('client.dashboard', compact(
            'customer',
            'projects',
            'activeProjects',
            'completedProjects',
            'contracts',
            'invoices',
            'pendingInvoices',
            'outstandingTotal',
            'paidTotal'
        ));
    }

    /**
     * List all projects for logged-in client.
     */
    public function projects()
    {
        $customer = $this->customer();

        $projects = Project::where('customer_id', $customer->id)
            ->with(['contract', 'invoices', 'assignedTo'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.projects.index', compact('customer', 'projects'));
    }

    /**
     * Show single project details & milestone timeline.
     */
    public function projectShow($id)
    {
        $customer = $this->customer();

        $project = Project::where('customer_id', $customer->id)
            ->where('id', $id)
            ->with(['contract', 'invoices', 'assignedTo'])
            ->firstOrFail();

        return view('client.projects.show', compact('customer', 'project'));
    }

    /**
     * List all contracts for logged-in client.
     */
    public function contracts()
    {
        $customer = $this->customer();

        $contracts = Contract::where('customer_id', $customer->id)
            ->with('project')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.contracts.index', compact('customer', 'contracts'));
    }

    /**
     * Download contract PDF.
     */
    public function contractDownload($id)
    {
        $customer = $this->customer();

        $contract = Contract::where('customer_id', $customer->id)
            ->where('id', $id)
            ->firstOrFail();

        if ($contract->file_path && Storage::disk('public')->exists($contract->file_path)) {
            return Storage::disk('public')->download($contract->file_path, 'Contract-' . $contract->contract_number . '.pdf');
        }

        if ($contract->file_path && Storage::exists($contract->file_path)) {
            return Storage::download($contract->file_path, 'Contract-' . $contract->contract_number . '.pdf');
        }

        // Auto-generate PDF on the fly if custom PDF scan wasn't uploaded
        $company = [
            'name' => 'PT. SEKAWAN PUTRA PRATAMA',
            'address' => 'Grand Galaxy City, Jl. Boulevard Raya, Bekasi',
            'phone' => '+62 21 8888 9999',
            'email' => 'info@sekawanputrapratama.com',
        ];

        $paymentTerms = $contract->payment_terms ?? [
            [
                'description' => 'Termin 1 (DP - Down Payment)',
                'percentage' => 30,
                'amount' => $contract->contract_value * 0.30
            ],
            [
                'description' => 'Termin 2 (Progress Development)',
                'percentage' => 40,
                'amount' => $contract->contract_value * 0.40
            ],
            [
                'description' => 'Termin 3 (Serah Terima / UAT)',
                'percentage' => 30,
                'amount' => $contract->contract_value * 0.30
            ],
        ];

        $calculations = [
            'grand_total' => $contract->contract_value,
            'payment_terms' => $paymentTerms,
        ];

        $threshold = 15000000;
        if ($contract->project_type === 'managed_service') {
            $viewFile = 'pdf.contract_managed_service';
            $fileName = 'Contract-ManagedService-' . $contract->contract_number;
        } elseif ($contract->contract_value >= $threshold) {
            $viewFile = 'pdf.contract_enterprise';
            $fileName = 'Contract-Enterprise-' . $contract->contract_number;
        } else {
            $viewFile = 'pdf.contract_simple';
            $fileName = 'SPK-' . $contract->contract_number;
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView($viewFile, [
            'contract' => $contract,
            'quotation' => $contract->quotation,
            'company' => $company,
            'calculations' => $calculations,
        ]);

        $pdf->setPaper('a4', 'portrait');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $fileName . '.pdf');
    }

    /**
     * List all invoices for logged-in client.
     */
    public function invoices()
    {
        $customer = $this->customer();
        $projectIds = Project::where('customer_id', $customer->id)->pluck('id');

        $invoices = Invoice::whereIn('project_id', $projectIds)
            ->with('project')
            ->orderBy('due_date', 'desc')
            ->paginate(10);

        return view('client.invoices.index', compact('customer', 'invoices'));
    }

    /**
     * Show single invoice & payment instructions.
     */
    public function invoiceShow($id)
    {
        $customer = $this->customer();
        $projectIds = Project::where('customer_id', $customer->id)->pluck('id');

        $invoice = Invoice::whereIn('project_id', $projectIds)
            ->where('id', $id)
            ->with('project')
            ->firstOrFail();

        return view('client.invoices.show', compact('customer', 'invoice'));
    }

    /**
     * Handle payment proof file upload from client.
     */
    public function uploadPaymentProof(Request $request, $id)
    {
        $customer = $this->customer();
        $projectIds = Project::where('customer_id', $customer->id)->pluck('id');

        $invoice = Invoice::whereIn('project_id', $projectIds)
            ->where('id', $id)
            ->firstOrFail();

        $request->validate([
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'payment_method' => 'required|string',
            'payment_notes' => 'nullable|string|max:500',
        ], [
            'payment_proof.required' => 'File bukti pembayaran wajib diunggah.',
            'payment_proof.mimes' => 'Format file bukti bayar harus berupa JPG, PNG, atau PDF.',
            'payment_proof.max' => 'Ukuran file maksimal 5MB.',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment-proofs', 'public');
            
            $invoice->update([
                'payment_proof_path' => $path,
                'payment_method' => $request->payment_method,
                'payment_notes' => $request->payment_notes,
                'status' => Invoice::STATUS_SENT, // Waiting for admin verification
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diunggah! Admin kami di /admin akan memverifikasi pembayaran Anda.');
    }

    /**
     * Show client profile page.
     */
    public function profile()
    {
        $customer = $this->customer();
        return view('client.profile', compact('customer'));
    }

    /**
     * Update client profile & password.
     */
    public function profileUpdate(Request $request)
    {
        $customer = $this->customer();

        $request->validate([
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ], [
            'contact_person.required' => 'Nama kontak person wajib diisi.',
            'phone.required' => 'Nomor Telepon/WA wajib diisi.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $customer->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah.']);
            }
            $customer->password = Hash::make($request->new_password);
        }

        $customer->contact_person = $request->contact_person;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        return back()->with('success', 'Profil portal Anda berhasil diperbarui!');
    }
}
