@extends('client.layouts.app')

@section('title', 'Daftar Proyek Saya - Client Portal')
@section('page_title', 'Daftar Proyek Saya')

@section('content')
<div class="portal-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold text-dark mb-1">Daftar Proyek</h5>
            <p class="text-muted small mb-0">Seluruh proyek pengembangan software & IT infrastructure perusahaan Anda.</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Proyek</th>
                    <th>Status Pengerjaan</th>
                    <th>Progress Bar</th>
                    <th>Tanggal Mulai</th>
                    <th>Penanggung Jawab</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $proj)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $proj->name }}</div>
                            <div class="text-muted small">{{ Str::limit($proj->description, 60) }}</div>
                        </td>
                        <td>
                            <span class="badge bg-primary rounded-pill small">
                                {{ \App\Models\Project::getStatuses()[$proj->status] ?? $proj->status }}
                            </span>
                        </td>
                        <td style="min-width: 160px;">
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1 rounded-pill" style="height: 8px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $proj->completion_percentage ?? 0 }}%;"></div>
                                </div>
                                <span class="fw-bold small text-primary">{{ $proj->completion_percentage ?? 0 }}%</span>
                            </div>
                        </td>
                        <td class="small text-muted">
                            {{ $proj->start_date ? $proj->start_date->format('d M Y') : '-' }}
                        </td>
                        <td class="small fw-semibold text-dark">
                            {{ $proj->assignedTo->name ?? 'Tim Sekawan' }}
                        </td>
                        <td>
                            <a href="{{ route('client.projects.show', $proj->id) }}" class="btn btn-sm btn-outline-primary rounded-pill fw-bold">
                                Detail Progres <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            Belum ada proyek terdaftar untuk perusahaan Anda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $projects->links() }}
    </div>
</div>
@endsection
