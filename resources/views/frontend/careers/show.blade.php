@extends('frontend.layouts.app')

@section('title', $job->title . ' - Karir PT Sekawan Putra Pratama')
@section('meta_description', 'Lamar posisi ' . $job->title . ' di PT Sekawan Putra Pratama. Bergabunglah bersama tim developer & IT consultant profesional!')

@push('styles')
<style>
    .career-detail-container {
        padding-top: 140px; /* Offset for fixed navbar header */
    }
    @media (max-width: 768px) {
        .career-detail-container {
            padding-top: 115px !important;
        }
        .career-detail-container h1 {
            font-size: 1.5rem !important;
            line-height: 1.3 !important;
        }
    }
</style>
@endpush

@section('content')

<div class="career-detail-container">
    <div class="py-3 bg-light border-bottom">
        <div class="container">
            <a href="{{ route('careers.index') }}" class="text-decoration-none text-muted small fw-bold">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Karir
            </a>
        </div>
    </div>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-5">
                {{-- JOB DETAILS --}}
                <div class="col-lg-7">
                    <div class="mb-4">
                        <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-2 me-2 mb-2 rounded-pill">{{ $job->department }}</span>
                        <span class="badge bg-light text-dark border px-3 py-2 mb-2 rounded-pill">{{ $job->type }}</span>
                        <h1 class="display-6 fw-bold text-dark mt-2 mb-3">{{ $job->title }}</h1>

                        <div class="d-flex flex-wrap gap-4 text-muted small border-bottom pb-3 mb-4">
                            <span><i class="fas fa-map-marker-alt text-primary me-1"></i> {{ $job->location }}</span>
                            <span><i class="fas fa-user-clock text-primary me-1"></i> Pengalaman: {{ $job->experience }}</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3">Deskripsi Pekerjaan</h5>
                        <p class="text-muted leading-relaxed">{{ $job->description }}</p>
                    </div>

                    @if(!empty($job->responsibilities))
                        <div class="mb-4">
                            <h5 class="fw-bold text-dark mb-3">Tanggung Jawab Utama</h5>
                            <ul class="list-unstyled">
                                @foreach($job->responsibilities as $resp)
                                    <li class="d-flex align-items-start mb-2">
                                        <i class="fas fa-check-circle text-primary me-2 mt-1"></i>
                                        <span class="text-muted">{{ is_array($resp) ? ($resp['item'] ?? '') : $resp }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(!empty($job->requirements))
                        <div class="mb-4">
                            <h5 class="fw-bold text-dark mb-3">Kualifikasi & Persyaratan</h5>
                            <ul class="list-unstyled">
                                @foreach($job->requirements as $req)
                                    <li class="d-flex align-items-start mb-2">
                                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                        <span class="text-muted">{{ is_array($req) ? ($req['item'] ?? '') : $req }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- APPLICATION FORM --}}
                <div class="col-lg-5">
                    <div class="bg-light p-4 p-md-5 rounded-4 border shadow-sm sticky-top" style="top: 110px;">
                        <h4 class="fw-bold text-dark mb-1">Formulir Lamaran Online</h4>
                        <p class="text-muted small mb-4">Isi data diri Anda dan unggah berkas Resume/CV (PDF).</p>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3 small mb-4" role="alert">
                                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('careers.apply', $job->slug) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label small fw-bold text-dark">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Ahmad Subagyo" required>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label small fw-bold text-dark">Alamat Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label small fw-bold text-dark">Nomor HP / WhatsApp</label>
                                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="0812xxxxxxxx" required>
                                @error('phone')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="portfolio_link" class="form-label small fw-bold text-dark">Link Portofolio / GitHub / LinkedIn (Opsional)</label>
                                <input type="url" name="portfolio_link" id="portfolio_link" class="form-control" value="{{ old('portfolio_link') }}" placeholder="https://github.com/username">
                            </div>

                            <div class="mb-3">
                                <label for="resume" class="form-label small fw-bold text-dark">Upload Resume / CV (Format PDF max 5MB)</label>
                                <input type="file" name="resume" id="resume" class="form-control @error('resume') is-invalid @enderror" accept=".pdf" required>
                                @error('resume')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="cover_letter" class="form-label small fw-bold text-dark">Pesan Singkat / Cover Letter (Opsional)</label>
                                <textarea name="cover_letter" id="cover_letter" class="form-control" rows="3" placeholder="Ceritakan singkat pengalaman dan alasan Anda melamar posisi ini..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold py-3 shadow">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Lamaran Pekerjaan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
