@extends('client.layouts.app')

@section('title', 'Dokumen Kontrak - Client Portal')
@section('page_title', 'Dokumen Perjanjian & Kontrak Kerjasama')

@section('content')
<div class="portal-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold text-dark mb-1">Daftar Kontrak Legal</h5>
            <p class="text-muted small mb-0">Arsip dokumen perjanjian resmi & MoU proyek antara perusahaan Anda dan PT Sekawan Putra Pratama.</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No. Kontrak</th>
                    <th>Proyek Terkait</th>
                    <th>Nilai Kontrak</th>
                    <th>Jangka Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contracts as $ctr)
                    <tr>
                        <td>
                            <div class="fw-bold text-primary"><i class="fas fa-file-contract me-2"></i>{{ $ctr->contract_number }}</div>
                            <div class="text-muted small">Ditandatangani: {{ $ctr->signed_at ? $ctr->signed_at->format('d M Y') : '-' }}</div>
                        </td>
                        <td class="fw-semibold text-dark">
                            {{ $ctr->project->name ?? 'Pengembangan Software' }}
                        </td>
                        <td class="fw-bold text-dark">
                            Rp{{ number_format($ctr->contract_value, 0, ',', '.') }}
                        </td>
                        <td class="small text-muted">
                            {{ $ctr->start_date ? $ctr->start_date->format('d M Y') : '-' }} s/d {{ $ctr->end_date ? $ctr->end_date->format('d M Y') : '-' }}
                        </td>
                        <td>
                            <span class="badge bg-{{ $ctr->status_color }} rounded-pill px-3 py-2">
                                {{ \App\Models\Contract::getStatuses()[$ctr->status] ?? $ctr->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('client.contracts.download', $ctr->id) }}" class="btn btn-sm btn-outline-primary rounded-pill fw-bold">
                                <i class="fas fa-download me-1"></i> Unduh PDF
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            Belum ada dokumen kontrak terdaftar untuk perusahaan Anda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $contracts->links() }}
    </div>
</div>
@endsection
