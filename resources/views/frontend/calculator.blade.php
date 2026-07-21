@extends('frontend.layouts.app')

@section('title', 'Kalkulator Simulasi Biaya & Durasi Proyek IT - PT Sekawan Putra Pratama')
@section('meta_description', 'Hitung estimasi biaya pembuatan website, aplikasi mobile, dan setup server kantor secara otomatis, transparan, dan gratis. Kirim hasil estimasi ke WhatsApp Sales!')

@section('content')

{{-- HERO SECTION --}}
<section class="py-5 text-white" style="background: linear-gradient(135deg, #050b14 0%, #0f172a 100%);">
    <div class="container py-4 text-center">
        <span class="badge bg-primary bg-opacity-20 text-info border border-info border-opacity-30 rounded-pill px-3 py-2 mb-3">
            <i class="fas fa-calculator me-1"></i> Interactive Project Calculator
        </span>
        <h1 class="display-4 fw-bold mb-3">Kalkulator Simulasi Biaya & Durasi Proyek</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 700px;">
            Pilih jenis platform, skala fitur, dan target pengerjaan untuk mendapatkan perkiraan biaya & durasi pengerjaan proyek Anda secara transparan dan instan.
        </p>
    </div>
</section>

{{-- CALCULATOR CONTAINER --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            {{-- SELECTION FORM --}}
            <div class="col-lg-8">
                {{-- STEP 1: PLATFORM --}}
                <div class="bg-white p-4 rounded-4 border shadow-sm mb-4">
                    <h5 class="fw-bold text-dark mb-3">
                        <span class="badge bg-primary rounded-circle me-2">1</span> Pilih Jenis Platform / Solusi
                    </h5>
                    <div class="row g-3">
                        @foreach($platforms as $key => $p)
                            <div class="col-md-6">
                                <div class="platform-card p-3 rounded-3 border cursor-pointer h-100 transition-all {{ $loop->first ? 'active border-primary bg-primary bg-opacity-10' : '' }}"
                                     onclick="selectPlatform('{{ $key }}', {{ $p['base_price'] }}, {{ $p['base_days'] }}, '{{ $p['name'] }}')"
                                     id="platform-{{ $key }}">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="text-primary fs-3"><i class="{{ $p['icon'] }}"></i></div>
                                        <div>
                                            <h6 class="fw-bold text-dark mb-1">{{ $p['name'] }}</h6>
                                            <p class="text-muted small mb-0">{{ $p['description'] }}</p>
                                            <div class="text-primary fw-semibold small mt-1">Mulai Rp{{ number_format($p['base_price'], 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- STEP 2: FEATURES --}}
                <div class="bg-white p-4 rounded-4 border shadow-sm mb-4">
                    <h5 class="fw-bold text-dark mb-3">
                        <span class="badge bg-primary rounded-circle me-2">2</span> Pilih Fitur Tambahan (Opsional)
                    </h5>
                    <div class="row g-3">
                        @foreach($features as $key => $f)
                            <div class="col-md-6">
                                <div class="form-check p-3 rounded-3 border bg-light d-flex align-items-center justify-content-between">
                                    <div>
                                        <input class="form-check-input feature-checkbox me-2" type="checkbox" 
                                               id="feature-{{ $key }}" 
                                               value="{{ $f['price'] }}" 
                                               data-days="{{ $f['days'] }}"
                                               data-name="{{ $f['name'] }}"
                                               onchange="calculateTotal()">
                                        <label class="form-check-label fw-bold text-dark small" for="feature-{{ $key }}">
                                            {{ $f['name'] }}
                                        </label>
                                    </div>
                                    <span class="badge bg-white text-primary border small">+Rp{{ number_format($f['price'] / 1000000, 1) }}Jt</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- STEP 3: TIMELINE SPEED --}}
                <div class="bg-white p-4 rounded-4 border shadow-sm">
                    <h5 class="fw-bold text-dark mb-3">
                        <span class="badge bg-primary rounded-circle me-2">3</span> Target Kecepatan Pengerjaan
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="speed-card p-3 rounded-3 border cursor-pointer active border-primary bg-primary bg-opacity-10" id="speed-standard" onclick="selectSpeed('standard', 1, 1)">
                                <div class="fw-bold text-dark"><i class="fas fa-clock text-primary me-2"></i> Standard Pace (Normal)</div>
                                <div class="text-muted small">Pengerjaan sesuai durasi standar tanpa biaya tambahan.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="speed-card p-3 rounded-3 border cursor-pointer" id="speed-express" onclick="selectSpeed('express', 1.25, 0.7)">
                                <div class="fw-bold text-dark"><i class="fas fa-bolt text-warning me-2"></i> Express Priority (+25% Biaya)</div>
                                <div class="text-muted small">Pengerjaan kilat 30% lebih cepat dengan tim terdedikasi.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SUMMARY SIDEBAR --}}
            <div class="col-lg-4">
                <div class="bg-dark text-white p-4 rounded-4 border shadow-lg sticky-top" style="top: 100px;">
                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom border-secondary pb-3">
                        <h5 class="fw-bold text-white mb-0">Hasil Estimasi</h5>
                        <span class="badge bg-success rounded-pill px-3 py-1">Gratis Simulasi</span>
                    </div>

                    <div class="mb-3">
                        <span class="text-white-50 small d-block">Platform Terpilih:</span>
                        <h6 class="fw-bold text-info mb-0" id="selected-platform-name">Website Company Profile</h6>
                    </div>

                    <div class="mb-3">
                        <span class="text-white-50 small d-block">Estimasi Durasi Pengerjaan:</span>
                        <h4 class="fw-bold text-white mb-0" id="estimated-duration">10 - 14 Hari Kerja</h4>
                    </div>

                    <div class="p-3 bg-secondary bg-opacity-20 rounded-3 mb-4 border border-secondary">
                        <span class="text-white-50 small d-block">Perkiraan Range Biaya:</span>
                        <h3 class="fw-bold text-warning mb-0" id="estimated-price">Rp 3.500.000 - Rp 4.500.000</h3>
                        <div class="text-white-50" style="font-size: 11px;">*Harga final disesuaikan setelah konsultasi detail.</div>
                    </div>

                    <a href="#" id="wa-btn" target="_blank" class="btn btn-success w-100 rounded-3 fw-bold py-3 mb-3 shadow">
                        <i class="fab fa-whatsapp me-2 fa-lg"></i> Kirim Estimasi ke WhatsApp Sales
                    </a>

                    <a href="{{ route('contact') }}" class="btn btn-outline-light w-100 rounded-3 fw-bold py-2">
                        <i class="fas fa-paper-plane me-2"></i> Minta Penawaran Resmi
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    let selectedPlatform = {
        name: 'Website Company Profile',
        price: 3500000,
        days: 10
    };
    let speedMultiplier = 1;
    let speedDaysMultiplier = 1;

    function selectPlatform(key, price, days, name) {
        $('.platform-card').removeClass('active border-primary bg-primary bg-opacity-10');
        $('#platform-' + key).addClass('active border-primary bg-primary bg-opacity-10');
        selectedPlatform = { name: name, price: price, days: days };
        calculateTotal();
    }

    function selectSpeed(type, priceMult, daysMult) {
        $('.speed-card').removeClass('active border-primary bg-primary bg-opacity-10');
        $('#speed-' + type).addClass('active border-primary bg-primary bg-opacity-10');
        speedMultiplier = priceMult;
        speedDaysMultiplier = daysMult;
        calculateTotal();
    }

    function calculateTotal() {
        let totalFeaturePrice = 0;
        let totalFeatureDays = 0;
        let selectedFeatureNames = [];

        $('.feature-checkbox:checked').each(function() {
            totalFeaturePrice += parseFloat($(this).val());
            totalFeatureDays += parseInt($(this).data('days'));
            selectedFeatureNames.push($(this).data('name'));
        });

        let basePrice = (selectedPlatform.price + totalFeaturePrice) * speedMultiplier;
        let maxPrice = basePrice * 1.25;

        let baseDays = Math.ceil((selectedPlatform.days + totalFeatureDays) * speedDaysMultiplier);
        let maxDays = Math.ceil(baseDays * 1.3);

        $('#selected-platform-name').text(selectedPlatform.name);
        $('#estimated-duration').text(baseDays + ' - ' + maxDays + ' Hari Kerja');
        $('#estimated-price').text('Rp ' + formatRupiah(basePrice) + ' - Rp ' + formatRupiah(maxPrice));

        // Generate WA Text
        let waMessage = `Halo Tim Sekawan Putra Pratama,%0A%0ASaya mencoba *Kalkulator Simulasi Proyek* di website dan tertarik dengan estimasi berikut:%0A%0A- *Solusi/Platform:* ${encodeURIComponent(selectedPlatform.name)}%0A- *Fitur Tambahan:* ${selectedFeatureNames.length > 0 ? encodeURIComponent(selectedFeatureNames.join(', ')) : 'Standar'}%0A- *Estimasi Waktu:* ${baseDays}-${maxDays} Hari Kerja%0A- *Estimasi Biaya:* Rp ${formatRupiah(basePrice)} - Rp ${formatRupiah(maxPrice)}%0A%0AMohon infonya untuk jadwal diskusi/konsultasi resminya. Terima kasih.`;
        
        $('#wa-btn').attr('href', 'https://wa.me/6285156412702?text=' + waMessage);
    }

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(Math.round(number));
    }

    $(document).ready(function() {
        calculateTotal();
    });
</script>
@endpush
@endsection
