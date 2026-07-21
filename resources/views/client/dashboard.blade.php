@extends('client.layouts.app')

@section('title', 'Dashboard Client - PT Sekawan Putra Pratama')
@section('page_title', 'Ringkasan Dashboard')

@section('content')

{{-- STAT WIDGETS --}}
<div class="row g-4 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="portal-card d-flex align-items-center gap-3">
            <div class="rounded-4 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; font-size: 22px;">
                <i class="fas fa-project-diagram"></i>
            </div>
            <div>
                <div class="text-muted small fw-semibold text-uppercase">Proyek Aktif</div>
                <h3 class="fw-bold text-dark mb-0">{{ $activeProjects->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="portal-card d-flex align-items-center gap-3">
            <div class="rounded-4 bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; font-size: 22px;">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div>
                <div class="text-muted small fw-semibold text-uppercase">Total Tagihan (Pending)</div>
                <h4 class="fw-bold text-dark mb-0">Rp{{ number_format($outstandingTotal, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="portal-card d-flex align-items-center gap-3">
            <div class="rounded-4 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; font-size: 22px;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <div class="text-muted small fw-semibold text-uppercase">Total Pembayaran</div>
                <h4 class="fw-bold text-dark mb-0">Rp{{ number_format($paidTotal, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="portal-card d-flex align-items-center gap-3">
            <div class="rounded-4 bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; font-size: 22px;">
                <i class="fas fa-file-contract"></i>
            </div>
            <div>
                <div class="text-muted small fw-semibold text-uppercase">Total Kontrak</div>
                <h3 class="fw-bold text-dark mb-0">{{ $contracts->count() }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- LIVE PROJECTS PROGRESS --}}
    <div class="col-lg-8">
        <div class="portal-card h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-dark mb-0"><i class="fas fa-tasks text-primary me-2"></i> Progres Proyek Aktif</h5>
                <a href="{{ route('client.projects.index') }}" class="btn btn-sm btn-outline-primary rounded-pill fw-bold">Lihat Semua</a>
            </div>

            @forelse($activeProjects as $proj)
                <div class="p-3 bg-light rounded-4 border mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold text-dark mb-0">
                            <a href="{{ route('client.projects.show', $proj->id) }}" class="text-dark text-decoration-none hover-primary">
                                {{ $proj->name }}
                            </a>
                        </h6>
                        <span class="badge bg-primary rounded-pill small">{{ \App\Models\Project::getStatuses()[$proj->status] ?? $proj->status }}</span>
                    </div>

                    <p class="text-muted small mb-3">{{ Str::limit($proj->description, 100) }}</p>

                    <div class="d-flex justify-content-between align-items-center small text-muted mb-1">
                        <span>Pengerjaan Sistem</span>
                        <span class="fw-bold text-primary">{{ $proj->completion_percentage ?? 0 }}%</span>
                    </div>

                    <div class="progress rounded-pill mb-3" style="height: 10px;">
                        <div class="progress-bar bg-gradient bg-primary" role="progressbar" style="width: {{ $proj->completion_percentage ?? 0 }}%;"></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center small text-muted">
                        <span><i class="far fa-calendar-alt me-1"></i> Mulai: {{ $proj->start_date ? $proj->start_date->format('d M Y') : '-' }}</span>
                        <span><i class="fas fa-user-tie me-1"></i> PM: {{ $proj->assignedTo->name ?? 'Tim Sekawan' }}</span>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-0">Belum ada proyek aktif saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- PENDING INVOICES & QUICK SUPPORT --}}
    <div class="col-lg-4">
        <div class="portal-card mb-4">
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-file-invoice text-warning me-2"></i> Tagihan Menunggu</h5>

            @forelse($pendingInvoices->take(3) as $inv)
                <div class="p-3 bg-light rounded-3 border mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold small text-dark">{{ $inv->invoice_number }}</span>
                        @if($inv->status === 'paid')
                            <span class="badge bg-success rounded-pill">Lunas</span>
                        @elseif($inv->status === 'sent')
                            <span class="badge bg-info rounded-pill">Verifikasi Admin</span>
                        @else
                            <span class="badge bg-warning text-dark rounded-pill">Belum Dibayar</span>
                        @endif
                    </div>
                    <div class="fw-bold text-primary mb-2">Rp{{ number_format($inv->amount, 0, ',', '.') }}</div>
                    <div class="d-flex justify-content-between align-items-center small">
                        <span class="text-muted">Tempo: {{ $inv->due_date ? $inv->due_date->format('d M Y') : '-' }}</span>
                        <a href="{{ route('client.invoices.show', $inv->id) }}" class="btn btn-sm btn-primary rounded-pill">Bayar / Detail</a>
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <i class="fas fa-check-circle text-success fa-2x mb-2"></i>
                    <p class="text-muted small mb-0">Tidak ada tagihan tertunda.</p>
                </div>
            @endforelse
        </div>

        {{-- QUICK SUPPORT --}}
        <div class="portal-card bg-dark text-white">
            <h6 class="fw-bold mb-2 text-white"><i class="fab fa-whatsapp text-success me-2"></i> Bantuan Langsung Tim IT</h6>
            <p class="text-white-50 small mb-3">Ada kendala teknis atau pertanyaan seputar proyek Anda?</p>
            <a href="https://wa.me/6285156412702?text=Halo%20Tim%20Sekawan%2C%20saya%20klien%20*{{ rawurlencode($customer->company_name) }}*%20ingin%20berdiskusi." target="_blank" class="btn btn-success w-100 rounded-3 fw-bold small">
                <i class="fab fa-whatsapp me-2"></i> Chat Technical Support
            </a>
        </div>
    </div>
</div>

@endsection
