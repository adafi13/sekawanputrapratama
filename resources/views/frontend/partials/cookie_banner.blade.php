<!-- Cookie Consent Banner Component -->
<div id="cookie-consent-banner" class="cookie-banner-wrapper" style="display: none;">
    <div class="cookie-banner-card">
        <div class="cookie-icon-wrapper">
            <i class="fa-solid fa-cookie-bite"></i>
        </div>
        <div class="cookie-content">
            <h4 class="cookie-title">Kami Menggunakan Cookie 🍪</h4>
            <p class="cookie-description">
                Kami menggunakan cookie untuk meningkatkan pengalaman Anda, menganalisis lalu lintas situs, dan menyajikan konten yang relevan sesuai <a href="{{ route('privacy-policy') }}" class="cookie-link">Kebijakan Privasi</a> kami.
            </p>
        </div>
        <div class="cookie-actions">
            <button id="btn-cookie-decline" class="btn-cookie btn-cookie-secondary">
                Hanya Esensial
            </button>
            <button id="btn-cookie-settings" class="btn-cookie btn-cookie-outline" title="Pengaturan Cookie">
                <i class="fa-solid fa-gear"></i>
            </button>
            <button id="btn-cookie-accept" class="btn-cookie btn-cookie-primary">
                Setujui Semua
            </button>
        </div>
    </div>
</div>

<!-- Modal Preferences Cookie -->
<div id="cookie-settings-modal" class="cookie-modal-overlay" style="display: none;">
    <div class="cookie-modal-card">
        <div class="cookie-modal-header">
            <h3><i class="fa-solid fa-sliders text-primary me-2"></i> Pengaturan Privasi & Cookie</h3>
            <button id="btn-close-cookie-modal" class="cookie-modal-close">&times;</button>
        </div>
        <div class="cookie-modal-body">
            <p class="text-muted text-sm mb-4">
                Atur preferensi cookie Anda di bawah ini. Cookie esensial sangat dibutuhkan agar fungsi dasar website bekerja dengan baik.
            </p>

            <div class="cookie-option-item">
                <div class="cookie-option-info">
                    <div class="cookie-option-title">
                        <span>Cookie Esensial</span>
                        <span class="badge bg-secondary">Wajib</span>
                    </div>
                    <p class="cookie-option-desc">Diperlukan untuk keamanan situs, navigasi dasar, dan fungsi inti aplikasi.</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" checked disabled>
                </div>
            </div>

            <div class="cookie-option-item">
                <div class="cookie-option-info">
                    <div class="cookie-option-title">
                        <span>Cookie Analitis & Performa</span>
                    </div>
                    <p class="cookie-option-desc">Membantu kami memahami bagaimana pengunjung berinteraksi dengan website ini secara anonim (Google Analytics).</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="cookie-opt-analytics" checked>
                </div>
            </div>

            <div class="cookie-option-item">
                <div class="cookie-option-info">
                    <div class="cookie-option-title">
                        <span>Cookie Pemasaran & Media Sosial</span>
                    </div>
                    <p class="cookie-option-desc">Dugunakan untuk menyajikan iklan atau konten media sosial yang relevan bagi Anda.</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="cookie-opt-marketing">
                </div>
            </div>
        </div>
        <div class="cookie-modal-footer">
            <button id="btn-save-cookie-settings" class="btn-cookie btn-cookie-primary w-100">
                Simpan Preferensi
            </button>
        </div>
    </div>
</div>

<style>
/* CSS styles for Cookie Consent Banner & Modal */
.cookie-banner-wrapper {
    position: fixed;
    bottom: 24px;
    left: 24px;
    right: 24px;
    z-index: 99999;
    max-width: 620px;
    margin: 0 auto;
    animation: cookieSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes cookieSlideUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.cookie-banner-card {
    background: rgba(15, 23, 42, 0.95);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.12);
    box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.05);
    border-radius: 16px;
    padding: 20px 24px;
    color: #f8fafc;
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.cookie-icon-wrapper {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: #ffffff;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.cookie-content {
    flex: 1 1 260px;
}

.cookie-title {
    font-size: 15px;
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 4px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.cookie-description {
    font-size: 12.5px;
    color: #94a3b8;
    margin: 0;
    line-height: 1.5;
}

.cookie-link {
    color: #60a5fa;
    text-decoration: underline;
    text-underline-offset: 2px;
    transition: color 0.2s;
}

.cookie-link:hover {
    color: #93c5fd;
}

.cookie-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-left: auto;
}

.btn-cookie {
    border: none;
    border-radius: 10px;
    padding: 9px 16px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-cookie-primary {
    background: #2563eb;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.btn-cookie-primary:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
}

.btn-cookie-secondary {
    background: rgba(255, 255, 255, 0.08);
    color: #cbd5e1;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.btn-cookie-secondary:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
}

.btn-cookie-outline {
    background: transparent;
    color: #94a3b8;
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 9px 12px;
}

.btn-cookie-outline:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
}

/* Modal Styling */
.cookie-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(15, 23, 42, 0.7);
    backdrop-filter: blur(8px);
    z-index: 100000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.cookie-modal-card {
    background: #0f172a;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
    overflow: hidden;
    color: #f8fafc;
    animation: modalPop 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes modalPop {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.cookie-modal-header {
    padding: 20px 24px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.cookie-modal-header h3 {
    font-size: 16px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
}

.cookie-modal-close {
    background: transparent;
    border: none;
    color: #94a3b8;
    font-size: 24px;
    cursor: pointer;
    line-height: 1;
    transition: color 0.2s;
}

.cookie-modal-close:hover {
    color: #ffffff;
}

.cookie-modal-body {
    padding: 24px;
    max-height: 65vh;
    overflow-y: auto;
}

.cookie-option-item {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.06);
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}

.cookie-option-title {
    font-size: 14px;
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.cookie-option-desc {
    font-size: 12px;
    color: #94a3b8;
    margin: 0;
    line-height: 1.4;
}

.cookie-modal-footer {
    padding: 16px 24px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    background: rgba(0, 0, 0, 0.2);
}

@media (max-width: 576px) {
    .cookie-banner-wrapper {
        bottom: 12px;
        left: 12px;
        right: 12px;
    }
    .cookie-banner-card {
        padding: 16px;
    }
    .cookie-actions {
        width: 100%;
        margin-top: 8px;
    }
    .btn-cookie-primary, .btn-cookie-secondary {
        flex: 1;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const COOKIE_NAME = 'sp_cookie_consent_v1';
    const banner = document.getElementById('cookie-consent-banner');
    const modal = document.getElementById('cookie-settings-modal');
    
    // Buttons
    const btnAccept = document.getElementById('btn-cookie-accept');
    const btnDecline = document.getElementById('btn-cookie-decline');
    const btnSettings = document.getElementById('btn-cookie-settings');
    const btnCloseModal = document.getElementById('btn-close-cookie-modal');
    const btnSaveSettings = document.getElementById('btn-save-cookie-settings');

    // Check existing consent
    function getConsent() {
        const saved = localStorage.getItem(COOKIE_NAME);
        if (saved) {
            try { return JSON.parse(saved); } catch(e) { return null; }
        }
        return null;
    }

    function saveConsent(data) {
        const consentData = {
            status: data.status || 'accepted',
            essential: true,
            analytics: data.analytics !== undefined ? data.analytics : true,
            marketing: data.marketing !== undefined ? data.marketing : false,
            timestamp: new Date().toISOString()
        };
        localStorage.setItem(COOKIE_NAME, JSON.stringify(consentData));
        
        // Also set a standard document cookie
        const d = new Date();
        d.setTime(d.getTime() + (365*24*60*60*1000));
        document.cookie = COOKIE_NAME + "=" + consentData.status + ";expires=" + d.toUTCString() + ";path=/;SameSite=Lax";
        
        hideBanner();
        hideModal();

        // Trigger Google Analytics if allowed
        if (consentData.analytics && typeof gtag === 'function') {
            gtag('consent', 'update', {
                'analytics_storage': 'granted'
            });
        }
    }

    function showBanner() {
        if (banner) banner.style.display = 'block';
    }

    function hideBanner() {
        if (banner) banner.style.display = 'none';
    }

    function showModal() {
        if (modal) modal.style.display = 'flex';
    }

    function hideModal() {
        if (modal) modal.style.display = 'none';
    }

    // Init check
    const currentConsent = getConsent();
    if (!currentConsent) {
        setTimeout(showBanner, 1200); // 1.2s delay for smooth entrance
    }

    // Event Listeners
    if (btnAccept) {
        btnAccept.addEventListener('click', function() {
            saveConsent({ status: 'accepted', analytics: true, marketing: true });
        });
    }

    if (btnDecline) {
        btnDecline.addEventListener('click', function() {
            saveConsent({ status: 'essential_only', analytics: false, marketing: false });
        });
    }

    if (btnSettings) {
        btnSettings.addEventListener('click', function() {
            showModal();
        });
    }

    if (btnCloseModal) {
        btnCloseModal.addEventListener('click', hideModal);
    }

    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) hideModal();
        });
    }

    if (btnSaveSettings) {
        btnSaveSettings.addEventListener('click', function() {
            const analytics = document.getElementById('cookie-opt-analytics')?.checked || false;
            const marketing = document.getElementById('cookie-opt-marketing')?.checked || false;
            saveConsent({
                status: 'custom',
                analytics: analytics,
                marketing: marketing
            });
        });
    }

    // Expose global method to re-open cookie settings (e.g., from footer link)
    window.openCookieSettings = function() {
        const consent = getConsent();
        if (consent) {
            const analyticsInput = document.getElementById('cookie-opt-analytics');
            const marketingInput = document.getElementById('cookie-opt-marketing');
            if (analyticsInput) analyticsInput.checked = consent.analytics;
            if (marketingInput) marketingInput.checked = consent.marketing;
        }
        showModal();
    };
});
</script>
