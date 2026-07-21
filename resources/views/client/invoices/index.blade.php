@extends('client.layouts.app')

@section('title', 'Daftar Invoice & Tagihan - Client Portal')
@section('page_title', 'Daftar Invoice & Tagihan')

@section('content')
<div class="portal-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold text-dark mb-1">Riwayat Tagihan & Invoice</h5>
            <p class="text-muted small mb-0">Pantau status pembayaran DP, Termin, dan Pelunasan proyek Anda.</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No. Invoice</th>
                    <th>Proyek</th>
                    <th>Termin Pembayaran</th>
                    <th>Jumlah Tagihan</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $inv)
                    <tr>
                        <td class="fw-bold text-dark">{{ $inv->invoice_number }}</td>
                        <td class="fw-semibold text-dark">{{ $inv->project->name ?? 'Proyek IT' }}</td>
                        <td><span class="badge bg-light text-dark border">{{ strtoupper($inv->payment_stage ?? 'DP') }}</span></td>
                        <td class="fw-bold text-primary">Rp{{ number_format($inv->amount, 0, ',', '.') }}</td>
                        <td class="small text-muted">{{ $inv->due_date ? $inv->due_date->format('d M Y') : '-' }}</td>
                        <td>
                            @if($inv->status === 'paid')
                                <span class="badge bg-success rounded-pill px-3 py-2">LUNAS</span>
                            @elseif($inv->status === 'sent')
                                <span class="badge bg-info rounded-pill px-3 py-2">VERIFIKASI ADMIN</span>
                            @elseif($inv->status === 'overdue')
                                <span class="badge bg-danger rounded-pill px-3 py-2">OVERDUE</span>
                            @else
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">BELUM DIBAYAR</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('client.invoices.show', $inv->id) }}" class="btn btn-sm btn-primary rounded-pill fw-bold">
                                Rincian / Upload Proof <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            Belum ada tagihan invoice terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $invoices->links() }}
    </div>
</div>
@endsection
