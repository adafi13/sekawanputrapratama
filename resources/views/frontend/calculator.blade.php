@extends('frontend.layouts.app')

@section('title', 'Kalkulator Simulasi Biaya & Durasi Proyek IT - PT Sekawan Putra Pratama')
@section('meta_description', 'Hitung estimasi biaya pembuatan website, aplikasi mobile, dan setup server kantor secara otomatis, transparan, dan gratis. Kirim hasil estimasi ke WhatsApp Sales!')

@push('styles')
<style>
    .calc-hero {
        background: radial-gradient(circle at 50% 0%, #1e293b 0%, #0f172a 60%, #020617 100%);
        position: relative;
        overflow: hidden;
    }
    .calc-hero::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.15) 0%, transparent 40%),
                    radial-gradient(circle at 20% 80%, rgba(14, 165, 233, 0.12) 0%, transparent 40%);
        pointer-events: none;
    }
    .platform-card {
        border: 2px solid #e2e8f0;
        background: #ffffff;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
    }
    .platform-card:hover {
        transform: translateY(-3px);
        border-color: #93c5fd;
        box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.15);
    }
    .platform-card.active {
        border-color: #2563eb !important;
        background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%) !important;
        box-shadow: 0 12px 28px -5px rgba(37, 99, 235, 0.25) !important;
    }
    .platform-card.active .platform-icon {
        background: #2563eb !important;
        color: #ffffff !important;
        transform: scale(1.1);
    }
    .platform-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #f1f5f9;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        transition: all 0.3s ease;
    }
    .feature-card {
        border: 1.5px solid #cbd5e1;
        background: #ffffff;
        transition: all 0.25s ease;
        cursor: pointer;
    }
    .feature-card:hover {
        border-color: #3b82f6;
        background: #f8fafc;
    }
    .feature-card.active {
        border-color: #2563eb !important;
        background: #eff6ff !important;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.12);
    }
    .speed-card {
        border: 2px solid #e2e8f0;
        background: #ffffff;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .speed-card.active {
        border-color: #2563eb !important;
        background: #eff6ff !important;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.18) !important;
    }
    .summary-card {
        background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
    }
    .feature-list-container {
        animation: fadeIn 0.4s ease-in-out;
    }
    .summary-feature-list {
        max-height: 180px;
        overflow-y: auto;
        padding-right: 5px;
    }
    .summary-feature-list::-webkit-scrollbar {
        width: 4px;
    }
    .summary-feature-list::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 4px;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')

{{-- HERO SECTION --}}
<section class="calc-hero py-5 text-white">
    <div class="container py-4 text-center position-relative" style="z-index: 2;">
        <span class="badge bg-primary bg-opacity-25 text-info border border-info border-opacity-30 rounded-pill px-4 py-2 mb-3 fs-6">
            <i class="fas fa-calculator me-2"></i> Interactive Cost & Duration Estimator
        </span>
        <h1 class="display-4 fw-black text-white mb-3" style="letter-spacing: -1px;">
            Kalkulator Simulasi Proyek IT
        </h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 720px; font-size: 1.15rem;">
            Dapatkan estimasi biaya & estimasi durasi pengerjaan proyek software/infrastruktur Anda secara transparan, instan, dan disesuaikan dengan fitur spesifik pilihan Anda.
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
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 1.1rem;">1</div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Pilih Jenis Platform / Solusi</h5>
                            <p class="text-muted small mb-0">Pilih kategori layanan utama yang ingin Anda kembangkan</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        @foreach($platforms as $key => $p)
                            <div class="col-md-6">
                                <div class="platform-card p-4 rounded-4 h-100 {{ $loop->first ? 'active' : '' }}"
                                     onclick="selectPlatform('{{ $key }}')"
                                     id="platform-{{ $key }}">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="platform-icon">
                                            <i class="{{ $p['icon'] }}"></i>
                                        </div>
                                        <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold rounded-pill px-3 py-1 small">
                                            {{ $p['badge'] }}
                                        </span>
                                    </div>
                                    <h6 class="fw-bold text-dark fs-6 mb-1">{{ $p['name'] }}</h6>
                                    <p class="text-muted small mb-3" style="min-height: 38px;">{{ $p['description'] }}</p>
                                    <div class="pt-2 border-top d-flex align-items-center justify-content-between">
                                        <span class="text-muted small">Mulai Dari</span>
                                        <span class="text-primary fw-bold fs-6">Rp{{ number_format($p['base_price'], 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- STEP 2: DYNAMIC FEATURES --}}
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 1.1rem;">2</div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Pilih Fitur Tambahan (Opsional)</h5>
                                <p class="text-muted small mb-0" id="feature-subtitle">Fitur otomatis menyesuaikan dengan platform terpilih</p>
                            </div>
                        </div>
                        <span class="badge bg-info bg-opacity-10 text-info fw-bold rounded-pill px-3 py-2 small d-none d-md-inline-block">
                            <i class="fas fa-magic me-1"></i> Auto-Filtered
                        </span>
                    </div>

                    {{-- DYNAMIC FEATURE WRAPPER --}}
                    <div id="features-container" class="feature-list-container">
                        {{-- Injected dynamically by JS --}}
                    </div>
                </div>

                {{-- STEP 3: TIMELINE SPEED --}}
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 1.1rem;">3</div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Target Kecepatan Pengerjaan</h5>
                            <p class="text-muted small mb-0">Tentukan ritme pengerjaan proyek sesuai deadline Anda</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="speed-card p-4 rounded-4 active" id="speed-standard" onclick="selectSpeed('standard', 1, 1)">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <div class="text-primary fs-4"><i class="fas fa-clock"></i></div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0">Standard Pace (Normal)</h6>
                                        <span class="badge bg-secondary opacity-75 small">Tanpa Tambahan Biaya</span>
                                    </div>
                                </div>
                                <p class="text-muted small mb-0">Pengerjaan sesuai jadwal dan standar durasi pengerjaan reguler.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="speed-card p-4 rounded-4" id="speed-express" onclick="selectSpeed('express', 1.25, 0.7)">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <div class="text-warning fs-4"><i class="fas fa-bolt"></i></div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0">Express Priority (+25%)</h6>
                                        <span class="badge bg-warning text-dark small">30% Lebih Cepat</span>
                                    </div>
                                </div>
                                <p class="text-muted small mb-0">Alokasi tim terdedikasi & penanganan prioritas kilat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SUMMARY SIDEBAR (CLEAN, PROPORTIONAL & LUXURIOUS) --}}
            <div class="col-lg-4">
                <div class="summary-card text-white p-4 rounded-4 sticky-top" style="top: 100px;">
                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom border-secondary pb-3">
                        <div>
                            <span class="text-white-50 small d-block">Ringkasan Simulasi</span>
                            <h5 class="fw-bold text-white mb-0">Hasil Estimasi</h5>
                        </div>
                        <span class="badge bg-success rounded-pill px-3 py-2 small fw-bold">
                            <i class="fas fa-check-circle me-1"></i> Live
                        </span>
                    </div>

                    {{-- PLATFORM SUMMARY --}}
                    <div class="mb-3">
                        <span class="text-white-50 small d-block mb-1">Platform Terpilih:</span>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-layer-group text-primary"></i>
                            <h6 class="fw-bold text-info mb-0 text-truncate" id="summary-platform-name">-</h6>
                        </div>
                    </div>

                    {{-- DURATION SUMMARY --}}
                    <div class="mb-3 p-3 rounded-3" style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);">
                        <span class="text-white-50 small d-block mb-1"><i class="fas fa-calendar-alt text-info me-1"></i> Estimasi Waktu Pengerjaan:</span>
                        <h5 class="fw-bold text-white mb-0" id="summary-duration">0 Hari Kerja</h5>
                    </div>

                    {{-- PRICE SUMMARY (CLEAN & NO WRAPPING OVERFLOW) --}}
                    <div class="p-3 rounded-4 mb-3" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.25) 0%, rgba(14, 165, 233, 0.15) 100%); border: 1.5px solid rgba(59, 130, 246, 0.35);">
                        <span class="text-white-50 small d-block mb-1"><i class="fas fa-coins text-warning me-1"></i> Perkiraan Range Biaya:</span>
                        <h4 class="fw-black text-warning mb-1" id="summary-price-short" style="letter-spacing: -0.5px;">Rp 0</h4>
                        <div class="text-white-50 small font-monospace" id="summary-price-full" style="font-size: 12px;">-</div>
                        <p class="text-white-50 mt-1 mb-0" style="font-size: 10px;">*Harga final disesuaikan setelah diskusi detail.</p>
                    </div>

                    {{-- SELECTED FEATURES LIST (SLEEK VERTICAL CHECKLIST) --}}
                    <div class="mb-4">
                        <span class="text-white-50 small d-block mb-2">Fitur Tambahan Terpilih:</span>
                        <div id="summary-features-chips" class="summary-feature-list">
                            <span class="badge bg-secondary opacity-50 small">Paket Standar Tanpa Add-on</span>
                        </div>
                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="d-grid gap-2">
                        <a href="#" id="wa-btn" target="_blank" class="btn btn-success rounded-3 fw-bold py-3 shadow fs-6">
                            <i class="fab fa-whatsapp me-2 fa-lg"></i> Konsultasi Estimasi via WA
                        </a>

                        <a href="{{ route('contact') }}" class="btn btn-outline-light rounded-3 fw-semibold py-2 small">
                            <i class="fas fa-file-invoice me-2"></i> Minta Penawaran Resmi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Platforms Data passed from Laravel Controller
    const platformsData = @json($platforms);

    let activePlatformKey = 'web_company';
    let selectedFeatureKeys = [];
    let speedMultiplier = 1;
    let speedDaysMultiplier = 1;

    function selectPlatform(key) {
        activePlatformKey = key;
        selectedFeatureKeys = []; // Reset selected features when platform changes

        $('.platform-card').removeClass('active');
        $('#platform-' + key).addClass('active');

        // Render platform-specific features
        renderFeatures(key);

        // Recalculate summary
        calculateTotal();
    }

    function renderFeatures(platformKey) {
        const platform = platformsData[platformKey];
        const features = platform.features || {};

        let html = '<div class="row g-3">';

        for (const [fKey, f] of Object.entries(features)) {
            html += `
                <div class="col-md-6">
                    <div class="feature-card p-3 rounded-4 h-100 d-flex align-items-center justify-content-between"
                         id="feature-card-${fKey}"
                         onclick="toggleFeature('${fKey}')">
                        <div class="d-flex align-items-center gap-3">
                            <div class="form-check me-0">
                                <input class="form-check-input feature-checkbox cursor-pointer" 
                                       type="checkbox" 
                                       id="feature-${fKey}" 
                                       value="${f.price}" 
                                       data-days="${f.days}"
                                       data-name="${f.name}"
                                       onclick="event.stopPropagation(); toggleFeature('${fKey}')">
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark small mb-1">
                                    <i class="${f.icon || 'fas fa-check-circle'} text-primary me-1"></i> ${f.name}
                                </h6>
                                ${f.days > 0 ? `<span class="text-muted" style="font-size: 11px;"><i class="fas fa-clock me-1"></i>+${f.days} Hari Kerja</span>` : '<span class="text-success" style="font-size: 11px;"><i class="fas fa-bolt me-1"></i>Instant Setup</span>'}
                            </div>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-pill small ms-2 px-2 py-1">
                            +Rp${(f.price / 1000000).toFixed(1)}Jt
                        </span>
                    </div>
                </div>
            `;
        }

        html += '</div>';

        $('#features-container').html(html);
        $('#feature-subtitle').text(`Fitur spesifik untuk ${platform.name}`);
    }

    function toggleFeature(fKey) {
        const checkbox = $(`#feature-${fKey}`);
        const card = $(`#feature-card-${fKey}`);
        
        const isChecked = !checkbox.prop('checked');
        checkbox.prop('checked', isChecked);

        if (isChecked) {
            card.addClass('active');
            if (!selectedFeatureKeys.includes(fKey)) {
                selectedFeatureKeys.push(fKey);
            }
        } else {
            card.removeClass('active');
            selectedFeatureKeys = selectedFeatureKeys.filter(k => k !== fKey);
        }

        calculateTotal();
    }

    function selectSpeed(type, priceMult, daysMult) {
        $('.speed-card').removeClass('active');
        $('#speed-' + type).addClass('active');
        speedMultiplier = priceMult;
        speedDaysMultiplier = daysMult;
        calculateTotal();
    }

    function calculateTotal() {
        const platform = platformsData[activePlatformKey];
        const features = platform.features || {};

        let totalFeaturePrice = 0;
        let totalFeatureDays = 0;
        let selectedFeatureNames = [];

        selectedFeatureKeys.forEach(fKey => {
            if (features[fKey]) {
                totalFeaturePrice += features[fKey].price;
                totalFeatureDays += features[fKey].days;
                selectedFeatureNames.push(features[fKey].name);
            }
        });

        let basePrice = (platform.base_price + totalFeaturePrice) * speedMultiplier;
        let maxPrice = basePrice * 1.2;

        let baseDays = Math.ceil((platform.base_days + totalFeatureDays) * speedDaysMultiplier);
        let maxDays = Math.ceil(baseDays * 1.25);

        // Update UI Summary
        $('#summary-platform-name').text(platform.name);
        $('#summary-duration').text(`${baseDays} - ${maxDays} Hari Kerja`);
        
        // Compact & clean price formatting (e.g., Rp 19,0 Jt - Rp 22,8 Jt)
        let minJt = (basePrice / 1000000).toFixed(1);
        let maxJt = (maxPrice / 1000000).toFixed(1);
        $('#summary-price-short').text(`Rp ${minJt} Jt - Rp ${maxJt} Jt`);
        $('#summary-price-full').text(`Rp ${formatRupiah(basePrice)} s/d Rp ${formatRupiah(maxPrice)}`);

        // Update Feature List as a clean vertical checklist
        if (selectedFeatureNames.length > 0) {
            let listHtml = selectedFeatureNames.map(name => 
                `<div class="d-flex align-items-start gap-2 mb-2 text-white-50 small">
                    <i class="fas fa-check-circle text-info mt-1"></i>
                    <span>${name}</span>
                </div>`
            ).join('');
            $('#summary-features-chips').html(listHtml);
        } else {
            $('#summary-features-chips').html('<div class="text-white-50 small"><i class="fas fa-info-circle me-1"></i> Paket Standar Tanpa Add-on</div>');
        }

        // Generate WA Text
        let waMessage = `Halo Tim Sekawan Putra Pratama,%0A%0ASaya telah mencoba *Kalkulator Simulasi Proyek* di website dan tertarik dengan estimasi berikut:%0A%0A- *Platform:* ${encodeURIComponent(platform.name)}%0A- *Fitur Tambahan:* ${selectedFeatureNames.length > 0 ? encodeURIComponent(selectedFeatureNames.join(', ')) : 'Paket Standar'}%0A- *Estimasi Waktu:* ${baseDays}-${maxDays} Hari Kerja%0A- *Estimasi Biaya:* Rp ${formatRupiah(basePrice)} - Rp ${formatRupiah(maxPrice)}%0A%0AMohon info jadwal diskusi/konsultasi resminya. Terima kasih.`;
        
        $('#wa-btn').attr('href', 'https://wa.me/6285156412702?text=' + waMessage);
    }

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(Math.round(number));
    }

    $(document).ready(function() {
        // Initialize with default platform
        selectPlatform('web_company');
    });
</script>
@endpush
@endsection
