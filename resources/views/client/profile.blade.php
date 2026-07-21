@extends('client.layouts.app')

@section('title', 'Pengaturan Profil Klien - Client Portal')
@section('page_title', 'Pengaturan Profil & Keamanan Akun')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="portal-card">
            <h5 class="fw-bold text-dark mb-1">Pengaturan Profil Perusahaan</h5>
            <p class="text-muted small mb-4">Perbarui informasi penanggung jawab kontak dan password login portal Anda.</p>

            <form action="{{ route('client.profile.update') }}" method="POST">
                @csrf

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark">Nama Perusahaan</label>
                        <input type="text" class="form-control bg-light" value="{{ $customer->company_name }}" disabled>
                        <span class="form-text text-muted" style="font-size: 11px;">Nama perusahaan dikelola oleh Superadmin di `/admin`.</span>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark">Email Portal Login</label>
                        <input type="email" class="form-control bg-light" value="{{ $customer->email }}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label for="contact_person" class="form-label small fw-bold text-dark">Nama Contact Person</label>
                        <input type="text" name="contact_person" id="contact_person" class="form-control @error('contact_person') is-invalid @enderror" value="{{ old('contact_person', $customer->contact_person) }}" required>
                        @error('contact_person')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label small fw-bold text-dark">Nomor Telepon / WA</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $customer->phone) }}" required>
                        @error('phone')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label small fw-bold text-dark">Alamat Perusahaan</label>
                        <textarea name="address" id="address" class="form-control" rows="2">{{ old('address', $customer->address) }}</textarea>
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold text-dark mb-3"><i class="fas fa-lock text-primary me-2"></i> Ubah Password Portal</h6>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="current_password" class="form-label small fw-bold text-dark">Password Saat Ini</label>
                        <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="••••••••">
                        @error('current_password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="new_password" class="form-label small fw-bold text-dark">Password Baru</label>
                        <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="••••••••">
                        @error('new_password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="new_password_confirmation" class="form-label small fw-bold text-dark">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="••••••••">
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold py-2">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
