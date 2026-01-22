@extends('frontend.layouts.app')

@section('content')

<section class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="white mb-16">Contact Us</h1>
                <p class="medium-gray">Hubungi kami untuk konsultasi proyek Anda</p>
            </div>
        </div>
    </div>
</section>

<section class="contact-section">
    <div class="container-fluid">
        <div class="row">
            
            {{-- Contact Info --}}
            <div class="col-lg-4 mb-48">
                <h3 class="white mb-32">Get in Touch</h3>
                
                <div class="contact-info-item mb-24">
                    <i class="fas fa-envelope color-primary mb-16"></i>
                    <h5 class="white mb-8">Email</h5>
                    <a href="mailto:info@sekawanputrapratama.com" class="medium-gray">info@sekawanputrapratama.com</a>
                </div>

                <div class="contact-info-item mb-24">
                    <i class="fas fa-phone color-primary mb-16"></i>
                    <h5 class="white mb-8">Phone</h5>
                    <a href="tel:+6285156412702" class="medium-gray">+62 851-5641-2702</a>
                </div>

                <div class="contact-info-item mb-24">
                    <i class="fas fa-map-marker-alt color-primary mb-16"></i>
                    <h5 class="white mb-8">Address</h5>
                    <p class="medium-gray">Bekasi, West Java, Indonesia</p>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="col-lg-8">
                <div class="contact-form-wrapper">
                    <h3 class="white mb-32">Send Us a Message</h3>

                    @if(session('success'))
                        <div class="alert alert-success mb-24">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger mb-24">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-24">
                                    <label for="name" class="mb-8">Nama Lengkap</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           name="name" 
                                           id="name" 
                                           value="{{ old('name') }}"
                                           placeholder="Nama Anda" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-24">
                                    <label for="email" class="mb-8">Email</label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           name="email" 
                                           id="email"
                                           value="{{ old('email') }}"
                                           placeholder="email@contoh.com" 
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-24">
                                    <label for="phone" class="mb-8">No. Telepon</label>
                                    <input type="text" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           name="phone" 
                                           id="phone"
                                           value="{{ old('phone') }}"
                                           placeholder="+62...">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-24">
                                    <label for="service" class="mb-8">Layanan</label>
                                    <select name="service" 
                                            class="has-nice-select form-control @error('service') is-invalid @enderror" 
                                            id="service">
                                        <option value="">Pilih Layanan</option>
                                        <option value="Web Development" {{ old('service') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                        <option value="App Development" {{ old('service') == 'App Development' ? 'selected' : '' }}>App Development</option>
                                        <option value="Office Server" {{ old('service') == 'Office Server' ? 'selected' : '' }}>Office Server</option>
                                        <option value="Konsultasi" {{ old('service') == 'Konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                                    </select>
                                    @error('service')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-24">
                                    <label for="message" class="mb-8">Deskripsi Proyek</label>
                                    <textarea name="message" 
                                              class="form-control @error('message') is-invalid @enderror" 
                                              id="message" 
                                              cols="30" 
                                              rows="6" 
                                              placeholder="Ceritakan kebutuhan Anda..." 
                                              required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="cus-btn">
                                    <span>Kirim Pesan</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
