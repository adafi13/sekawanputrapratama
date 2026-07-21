@extends('client.layouts.app')

@section('title', 'Detail Proyek - ' . $project->name)
@section('page_title', 'Detail Proyek & Milestone Timeline')

@section('content')
<div class="mb-3">
    <a href="{{ route('client.projects.index') }}" class="text-decoration-none text-muted small fw-semibold">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Proyek
    </a>
</div>

<div class="row g-4">
    {{-- PROJECT DETAILS --}}
    <div class="col-lg-8">
        <div class="portal-card mb-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <span class="badge bg-primary bg-opacity-10 text-primary fw-bold mb-2">ID Proyek #PRJ-{{ $project->id }}</span>
                    <h3 class="fw-bold text-dark mb-1">{{ $project->name }}</h3>
                    <p class="text-muted small mb-0">{{ $project->description }}</p>
                </div>
                <span class="badge bg-success px-3 py-2 rounded-pill fs-6">
                    {{ \App\Models\Project::getStatuses()[$project->status] ?? $project->status }}
                </span>
            </div>

            <hr class="my-4">

            {{-- PROGRESS BAR LARGE --}}
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold text-dark">Prosentase Kelengkapan Sistem</span>
                    <span class="fw-bold text-primary fs-5">{{ $project->completion_percentage ?? 0 }}%</span>
                </div>
                <div class="progress rounded-pill" style="height: 14px;">
                    <div class="progress-bar bg-gradient bg-primary" role="progressbar" style="width: {{ $project->completion_percentage ?? 0 }}%;"></div>
                </div>
            </div>

            {{-- MILESTONE STAGE FLOW --}}
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-route text-primary me-2"></i> Tahapan Milestone Pengerjaan</h5>
            <div class="p-3 bg-light rounded-4 border mb-4">
                @php
                    $stages = [
                        'awaiting_dp' => '1. Perencanaan & DP Pembayaran',
                        'planning' => '2. Desain & Arsitektur Sistem',
                        'dev_phase_1' => '3. Development Phase 1 (Core Coding)',
                        'dev_phase_2' => '4. Development Phase 2 (Integrasi Fitur)',
                        'uat' => '5. UAT & Testing Klien',
                        'deployment' => '6. Serah Terima & Live Deployment',
                        'completed' => '7. Proyek Selesai',
                    ];
                    $stageKeys = array_keys($stages);
                    $currentIndex = array_search($project->status, $stageKeys);
                    if ($currentIndex === false) {
                        $currentIndex = 0;
                    }
                @endphp

                <ul class="list-group list-group-flush bg-transparent">
                    @foreach($stages as $key => $label)
                        @php
                            $stageIndex = array_search($key, $stageKeys);
                            $isPast = $stageIndex < $currentIndex || $project->status === 'completed';
                            $isCurrent = $project->status === $key && $project->status !== 'completed';
                        @endphp
                        <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center py-3">
                            <span class="fw-semibold {{ $isCurrent ? 'text-primary fw-bold' : ($isPast ? 'text-dark' : 'text-muted') }}">
                                {{ $label }}
                            </span>
                            @if($isCurrent)
                                <span class="badge bg-primary rounded-pill px-3 py-2"><i class="fas fa-spinner fa-spin me-1"></i> Sedang Berjalan</span>
                            @elseif($isPast)
                                <span class="badge bg-success rounded-pill px-3 py-2"><i class="fas fa-check me-1"></i> Selesai</span>
                            @else
                                <span class="badge bg-secondary opacity-50 rounded-pill px-3 py-2">Menunggu Stage</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- PROJECT INVOICES --}}
        <div class="portal-card">
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-receipt text-warning me-2"></i> Invoice & Termin Pembayaran</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>No. Invoice</th>
                            <th>Termin / Stage</th>
                            <th>Jumlah Tagihan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($project->invoices as $inv)
                            <tr>
                                <td class="fw-bold text-dark">{{ $inv->invoice_number }}</td>
                                <td><span class="badge bg-light text-dark border">{{ strtoupper($inv->payment_stage ?? 'DP') }}</span></td>
                                <td class="fw-bold text-primary">Rp{{ number_format($inv->amount, 0, ',', '.') }}</td>
                                <td>
                                    @if($inv->status === 'paid')
                                        <span class="badge bg-success rounded-pill">LUNAS</span>
                                    @elseif($inv->status === 'sent')
                                        <span class="badge bg-info rounded-pill">VERIFIKASI ADMIN</span>
                                    @else
                                        <span class="badge bg-warning text-dark rounded-pill">PENDING</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('client.invoices.show', $inv->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">Detail / Upload Proof</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted small">Belum ada invoice untuk proyek ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- SIDEBAR SUMMARY --}}
    <div class="col-lg-4">
        <div class="portal-card mb-4">
            <h5 class="fw-bold text-dark mb-3">Informasi Proyek</h5>

            <div class="mb-3">
                <span class="text-muted small d-block">Kontrak Terkait:</span>
                <span class="fw-bold text-dark">
                    @if($project->contract)
                        <i class="fas fa-file-contract text-primary me-1"></i> {{ $project->contract->contract_number }}
                    @else
                        -
                    @endif
                </span>
            </div>

            <div class="mb-3">
                <span class="text-muted small d-block">Tanggal Mulai:</span>
                <span class="fw-bold text-dark">{{ $project->start_date ? $project->start_date->format('d M Y') : '-' }}</span>
            </div>

            <div class="mb-3">
                <span class="text-muted small d-block">Target Rilis / End Date:</span>
                <span class="fw-bold text-dark">{{ $project->end_date ? $project->end_date->format('d M Y') : 'Estimasi Sesuai Milestone' }}</span>
            </div>

            <div class="mb-3">
                <span class="text-muted small d-block">Project Manager (PM):</span>
                <span class="fw-bold text-dark"><i class="fas fa-user-tie me-1"></i> {{ $project->assignedTo->name ?? 'Tim Sekawan Putra Pratama' }}</span>
            </div>
        </div>

        <div class="portal-card bg-light border">
            <h6 class="fw-bold text-dark mb-2"><i class="fas fa-headset text-primary me-2"></i> Diskusi Progres Proyek</h6>
            <p class="text-muted small mb-3">Ingin mendiskusikan perubahan fitur atau jadwal demo proyek ini?</p>
            <a href="https://wa.me/6285156412702?text=Halo%20Tim%20Sekawan%2C%20saya%20klien%20ingin%20diskusi%20progres%20proyek%20*{{ rawurlencode($project->name) }}*." target="_blank" class="btn btn-outline-success w-100 rounded-3 fw-bold small">
                <i class="fab fa-whatsapp me-1"></i> Hubungi PM di WhatsApp
            </a>
        </div>
    </div>
</div>

@endsection
