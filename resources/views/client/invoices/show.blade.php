@extends('client.layouts.app')

@section('title', 'Detail Invoice - ' . $invoice->invoice_number)
@section('page_title', 'Detail Invoice & Upload Bukti Bayar')

@section('content')
<div class="mb-3">
    <a href="{{ route('client.invoices.index') }}" class="text-decoration-none text-muted small fw-semibold">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Invoice
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="portal-card mb-4">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <span class="text-muted small d-block">Tagihan Resmi</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $invoice->invoice_number }}</h3>
                    <p class="text-muted small mb-0">Proyek: {{ $invoice->project->name ?? 'Pengembangan Software' }}</p>
                </div>
                <div>
                    @if($invoice->status === 'paid')
                        <span class="badge bg-success px-4 py-2 rounded-pill fs-6">LUNAS</span>
                    @elseif($invoice->status === 'sent')
                        <span class="badge bg-info px-4 py-2 rounded-pill fs-6">MENUNGGU VERIFIKASI ADMIN</span>
                    @else
                        <span class="badge bg-warning text-dark px-4 py-2 rounded-pill fs-6">BELUM DIBAYAR</span>
                    @endif
                </div>
            </div>

            <div class="p-4 bg-light rounded-4 border mb-4">
                <div class="row text-center">
                    <div class="col-6 border-end">
                        <span class="text-muted small d-block">Total Nominal Tagihan</span>
                        <h3 class="fw-bold text-primary mb-0 mt-1">Rp{{ number_format($invoice->amount, 0, ',', '.') }}</h3>
                    </div>
                    <div class="col-6">
                        <span class="text-muted small d-block">Tanggal Jatuh Tempo</span>
                        <h4 class="fw-bold text-dark mb-0 mt-1">{{ $invoice->due_date ? $invoice->due_date->format('d M Y') : '-' }}</h4>
                    </div>
                </div>
            </div>

            {{-- BANK TRANSFER DETAILS --}}
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-university text-primary me-2"></i> Rekening Pembayaran Resmi</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="p-3 bg-white border rounded-3 h-100">
                        <div class="fw-bold text-dark"><i class="fas fa-credit-card text-primary me-1"></i> {{ \App\Models\Setting::get('bank.bca_name', 'Bank Central Asia (BCA)') }}</div>
                        <div class="fs-5 fw-bold text-primary my-1">{{ \App\Models\Setting::get('bank.bca_account', '8415-6412-702') }}</div>
                        <div class="small text-muted">a.n. {{ \App\Models\Setting::get('bank.bca_holder', 'PT Sekawan Putra Pratama') }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white border rounded-3 h-100">
                        <div class="fw-bold text-dark"><i class="fas fa-credit-card text-primary me-1"></i> {{ \App\Models\Setting::get('bank.mandiri_name', 'Bank Mandiri') }}</div>
                        <div class="fs-5 fw-bold text-primary my-1">{{ \App\Models\Setting::get('bank.mandiri_account', '156-00-1845-6412') }}</div>
                        <div class="small text-muted">a.n. {{ \App\Models\Setting::get('bank.mandiri_holder', 'PT Sekawan Putra Pratama') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- UPLOAD PAYMENT PROOF --}}
    <div class="col-lg-5">
        <div class="portal-card">
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-cloud-upload-alt text-primary me-2"></i> Form Unggah Bukti Bayar</h5>
            <p class="text-muted small mb-4">Setelah melakukan transfer bank, silakan unggah struk/bukti transfer Anda di bawah ini agar diverifikasi oleh Superadmin di `/admin`.</p>

            @if($invoice->payment_proof_path)
                <div class="alert alert-info rounded-3 mb-4">
                    <div class="fw-bold small mb-1"><i class="fas fa-file-check me-1"></i> Bukti Transfer Telah Diunggah:</div>
                    <a href="{{ Storage::url($invoice->payment_proof_path) }}" target="_blank" class="btn btn-sm btn-outline-info bg-white rounded-pill fw-bold">
                        <i class="fas fa-external-link-alt me-1"></i> Lihat File Bukti Bayar
                    </a>
                </div>
            @endif

            @if($invoice->status !== 'paid')
                <form action="{{ route('client.invoices.upload-proof', $invoice->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="payment_method" class="form-label small fw-bold text-dark">Metode Transfer</label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="bank_transfer_bca">Bank Transfer - BCA</option>
                            <option value="bank_transfer_mandiri">Bank Transfer - Mandiri</option>
                            <option value="cash">Cash / Tunai</option>
                            <option value="credit_card">Kartu Kredit / EDC</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="payment_proof" class="form-label small fw-bold text-dark">File Bukti Transfer (JPG, PNG, PDF max 5MB)</label>
                        <input type="file" name="payment_proof" id="payment_proof" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label for="payment_notes" class="form-label small fw-bold text-dark">Catatan Pembayaran (Opsional)</label>
                        <textarea name="payment_notes" id="payment_notes" class="form-control" rows="2" placeholder="Contoh: Transfer atas nama Budi dari Rekening BCA xxx"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold py-2">
                        <i class="fas fa-paper-plane me-1"></i> Unggah & Kirim Konfirmasi
                    </button>
                </form>
            @else
                <div class="text-center py-4 bg-success bg-opacity-10 text-success rounded-3 border border-success">
                    <i class="fas fa-check-circle fa-3x mb-2"></i>
                    <h6 class="fw-bold mb-1">Tagihan Ini Telah LUNAS</h6>
                    <p class="small mb-0 text-muted">Terima kasih atas kepercayaan Anda menggunakan layanan Sekawan Putra Pratama.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
