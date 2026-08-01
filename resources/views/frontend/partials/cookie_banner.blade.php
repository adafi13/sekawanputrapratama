<!-- Cookie Consent Banner Component (Ultra Premium Redesign) -->
<div id="cookie-consent-banner" class="sp-cookie-wrapper" style="display: none;">
    <div class="sp-cookie-card">
        <div class="sp-cookie-main">
            <div class="sp-cookie-icon-badge">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 21C16.9706 21 21 16.9706 21 12C21 11.5307 20.9639 11.0699 20.8943 10.6198C20.0829 11.2384 19.0567 11.5 18 11.5C15.5147 11.5 13.5 9.48528 13.5 7C13.5 6.0792 13.7766 5.22301 14.2504 4.51009C13.5233 4.17937 12.7818 4 12 4C7.02944 4 3 8.02944 3 13C3 17.9706 7.02944 21 12 21Z" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="8.5" cy="11.5" r="1.5" fill="#F59E0B"/>
                    <circle cx="11.5" cy="16.5" r="1.5" fill="#F59E0B"/>
                    <circle cx="16.5" cy="15.5" r="1.5" fill="#F59E0B"/>
                    <circle cx="8.5" cy="16.5" r="1" fill="#F59E0B"/>
                </svg>
            </div>
            <div class="sp-cookie-text">
                <h5 class="sp-cookie-heading">Persetujuan Cookie & Privasi</h5>
                <p class="sp-cookie-body">
                    Kami menggunakan cookie untuk mengoptimalkan performa situs dan menganalisis pengunjung. Baca <a href="{{ route('privacy-policy') }}" class="sp-cookie-link">Kebijakan Privasi</a>.
                </p>
            </div>
        </div>
        <div class="sp-cookie-btn-group">
            <button id="btn-cookie-decline" type="button" class="sp-cookie-btn sp-btn-secondary">
                Esensial
            </button>
            <button id="btn-cookie-settings" type="button" class="sp-cookie-btn sp-btn-icon" title="Pengaturan Cookie">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19.4 15A1.65 1.65 0 0 0 20 16.8L20.1 16.9A2 2 0 1 1 17.3 19.7L17.2 19.6A1.65 1.65 0 0 0 15.4 19.4A1.65 1.65 0 0 0 14.6 20.9L14.6 21A2 2 0 1 1 10.6 21L10.6 20.9A1.65 1.65 0 0 0 9.8 19.4A1.65 1.65 0 0 0 8 19.6L7.9 19.7A2 2 0 1 1 5.1 16.9L5.2 16.8A1.65 1.65 0 0 0 5.4 15A1.65 1.65 0 0 0 3.9 14.2L3.8 14.2A2 2 0 1 1 3.8 10.2L3.9 10.2A1.65 1.65 0 0 0 5.4 9.4A1.65 1.65 0 0 0 5.2 7.6L5.1 7.5A2 2 0 1 1 7.9 4.7L8 4.8A1.65 1.65 0 0 0 9.8 5A1.65 1.65 0 0 0 10.6 3.5L10.6 3.4A2 2 0 1 1 14.6 3.4L14.6 3.5A1.65 1.65 0 0 0 15.4 5A1.65 1.65 0 0 0 17.2 4.8L17.3 4.7A2 2 0 1 1 20.1 7.5L20 7.6A1.65 1.65 0 0 0 19.8 9.4A1.65 1.65 0 0 0 21.3 10.2L21.4 10.2A2 2 0 1 1 21.4 14.2L21.3 14.2A1.65 1.65 0 0 0 19.8 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button id="btn-cookie-accept" type="button" class="sp-cookie-btn sp-btn-primary">
                Setujui Semua
            </button>
        </div>
    </div>
</div>

<!-- Modal Preferences Cookie -->
<div id="cookie-settings-modal" class="sp-modal-overlay">
    <div class="sp-modal-card">
        <div class="sp-modal-header">
            <div class="sp-modal-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                <span>Pengaturan Privasi & Cookie</span>
            </div>
            <button id="btn-close-cookie-modal" type="button" class="sp-modal-close-btn">&times;</button>
        </div>
        <div class="sp-modal-body">
            <p class="sp-modal-desc">
                Atur preferensi penggunaan cookie di bawah ini. Cookie esensial wajib aktif demi keamanan & fungsi situs.
            </p>

            <div class="sp-cookie-row">
                <div class="sp-cookie-row-left">
                    <div class="sp-cookie-row-title">
                        Cookie Esensial <span class="sp-badge-required">Wajib</span>
                    </div>
                    <div class="sp-cookie-row-sub">Navigasi dasar, keamanan SSL, dan perlindungan formulir.</div>
                </div>
                <div class="sp-switch-wrapper">
                    <input type="checkbox" class="sp-toggle-input" checked disabled>
                </div>
            </div>

            <div class="sp-cookie-row">
                <div class="sp-cookie-row-left">
                    <div class="sp-cookie-row-title">Analisis Performa</div>
                    <div class="sp-cookie-row-sub">Membantu kami menghitung statistik pengunjung anonim (Google Analytics).</div>
                </div>
                <div class="sp-switch-wrapper">
                    <input type="checkbox" id="cookie-opt-analytics" class="sp-toggle-input" checked>
                </div>
            </div>

            <div class="sp-cookie-row">
                <div class="sp-cookie-row-left">
                    <div class="sp-cookie-row-title">Pemasaran & Ads</div>
                    <div class="sp-cookie-row-sub">Digunakan untuk menyajikan konten promosi atau iklan yang relevan.</div>
                </div>
                <div class="sp-switch-wrapper">
                    <input type="checkbox" id="cookie-opt-marketing" class="sp-toggle-input">
                </div>
            </div>
        </div>
        <div class="sp-modal-footer">
            <button id="btn-save-cookie-settings" type="button" class="sp-cookie-btn sp-btn-primary style-full">
                Simpan Preferensi
            </button>
        </div>
    </div>
</div>

<style>
.sp-cookie-wrapper {
    position: fixed !important;
    bottom: 24px !important;
    left: 24px !important;
    z-index: 999999 !important;
    max-width: 500px !important;
    width: calc(100% - 48px) !important;
    font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
}

.sp-cookie-card {
    background: #0f172a !important;
    background: rgba(15, 23, 42, 0.96) !important;
    backdrop-filter: blur(16px) !important;
    -webkit-backdrop-filter: blur(16px) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.05) !important;
    border-radius: 16px !important;
    padding: 18px 20px !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 14px !important;
    box-sizing: border-box !important;
}

.sp-cookie-main {
    display: flex !important;
    align-items: flex-start !important;
    gap: 14px !important;
}

.sp-cookie-icon-badge {
    width: 40px !important;
    height: 40px !important;
    background: rgba(245, 158, 11, 0.12) !important;
    border: 1px solid rgba(245, 158, 11, 0.25) !important;
    border-radius: 10px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    flex-shrink: 0 !important;
}

.sp-cookie-text {
    flex: 1 !important;
}

.sp-cookie-heading {
    font-size: 14px !important;
    font-weight: 700 !important;
    color: #ffffff !important;
    margin: 0 0 4px 0 !important;
    line-height: 1.3 !important;
}

.sp-cookie-body {
    font-size: 12px !important;
    color: #94a3b8 !important;
    margin: 0 !important;
    line-height: 1.45 !important;
}

.sp-cookie-link {
    color: #60a5fa !important;
    text-decoration: underline !important;
    text-underline-offset: 2px !important;
}

.sp-cookie-link:hover {
    color: #93c5fd !important;
}

.sp-cookie-btn-group {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    justify-content: flex-end !important;
}

.sp-cookie-btn {
    border: none !important;
    border-radius: 8px !important;
    padding: 8px 14px !important;
    font-size: 12.5px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    line-height: 1.2 !important;
    outline: none !important;
}

.sp-btn-primary {
    background: #2563eb !important;
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
}

.sp-btn-primary:hover {
    background: #1d4ed8 !important;
    transform: translateY(-1px) !important;
}

.sp-btn-secondary {
    background: rgba(255, 255, 255, 0.08) !important;
    color: #cbd5e1 !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
}

.sp-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.16) !important;
    color: #ffffff !important;
}

.sp-btn-icon {
    background: rgba(255, 255, 255, 0.05) !important;
    color: #94a3b8 !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    padding: 8px 10px !important;
}

.sp-btn-icon:hover {
    background: rgba(255, 255, 255, 0.15) !important;
    color: #ffffff !important;
}

/* Modal Styling - Default Hidden without display:flex !important */
.sp-modal-overlay {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    background: rgba(15, 23, 42, 0.75) !important;
    backdrop-filter: blur(8px) !important;
    -webkit-backdrop-filter: blur(8px) !important;
    z-index: 9999999 !important;
    display: none;
    align-items: center !important;
    justify-content: center !important;
    padding: 16px !important;
    box-sizing: border-box !important;
}

.sp-modal-overlay.active {
    display: flex !important;
}

.sp-modal-card {
    background: #0f172a !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    border-radius: 16px !important;
    width: 100% !important;
    max-width: 480px !important;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7) !important;
    overflow: hidden !important;
    color: #f8fafc !important;
    font-family: 'Inter', system-ui, sans-serif !important;
}

.sp-modal-header {
    padding: 16px 20px !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
}

.sp-modal-title {
    font-size: 15px !important;
    font-weight: 700 !important;
    color: #ffffff !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
}

.sp-modal-close-btn {
    background: transparent !important;
    border: none !important;
    color: #94a3b8 !important;
    font-size: 22px !important;
    cursor: pointer !important;
    padding: 0 !important;
    line-height: 1 !important;
}

.sp-modal-close-btn:hover {
    color: #ffffff !important;
}

.sp-modal-body {
    padding: 20px !important;
}

.sp-modal-desc {
    font-size: 12px !important;
    color: #94a3b8 !important;
    margin: 0 0 16px 0 !important;
    line-height: 1.45 !important;
}

.sp-cookie-row {
    background: rgba(255, 255, 255, 0.03) !important;
    border: 1px solid rgba(255, 255, 255, 0.06) !important;
    border-radius: 10px !important;
    padding: 12px 14px !important;
    margin-bottom: 10px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 12px !important;
}

.sp-cookie-row-title {
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #ffffff !important;
    margin-bottom: 2px !important;
}

.sp-badge-required {
    background: rgba(255, 255, 255, 0.1) !important;
    color: #94a3b8 !important;
    font-size: 10px !important;
    padding: 2px 6px !important;
    border-radius: 4px !important;
    margin-left: 6px !important;
}

.sp-cookie-row-sub {
    font-size: 11.5px !important;
    color: #64748b !important;
    line-height: 1.35 !important;
}

.sp-toggle-input {
    width: 36px !important;
    height: 20px !important;
    cursor: pointer !important;
    accent-color: #2563eb !important;
}

.sp-modal-footer {
    padding: 14px 20px !important;
    border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
    background: rgba(0, 0, 0, 0.2) !important;
}

.style-full {
    width: 100% !important;
}

@media (max-width: 576px) {
    .sp-cookie-wrapper {
        bottom: 12px !important;
        left: 12px !important;
        width: calc(100% - 24px) !important;
    }
    .sp-cookie-card {
        padding: 14px 16px !important;
    }
    .sp-cookie-btn-group {
        width: 100% !important;
    }
    .sp-btn-primary, .sp-btn-secondary {
        flex: 1 !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const COOKIE_KEY = 'sp_cookie_consent_v1';
    const banner = document.getElementById('cookie-consent-banner');
    const modal = document.getElementById('cookie-settings-modal');
    
    const btnAccept = document.getElementById('btn-cookie-accept');
    const btnDecline = document.getElementById('btn-cookie-decline');
    const btnSettings = document.getElementById('btn-cookie-settings');
    const btnCloseModal = document.getElementById('btn-close-cookie-modal');
    const btnSaveSettings = document.getElementById('btn-save-cookie-settings');

    function getConsent() {
        const saved = localStorage.getItem(COOKIE_KEY);
        if (saved) {
            try { return JSON.parse(saved); } catch(e) { return null; }
        }
        return null;
    }

    function showModal() {
        if (modal) modal.classList.add('active');
    }

    function hideModal() {
        if (modal) modal.classList.remove('active');
    }

    function saveConsent(data) {
        const consentData = {
            status: data.status || 'accepted',
            essential: true,
            analytics: data.analytics !== undefined ? data.analytics : true,
            marketing: data.marketing !== undefined ? data.marketing : false,
            timestamp: new Date().toISOString()
        };
        localStorage.setItem(COOKIE_KEY, JSON.stringify(consentData));
        
        const d = new Date();
        d.setTime(d.getTime() + (365*24*60*60*1000));
        document.cookie = COOKIE_KEY + "=" + consentData.status + ";expires=" + d.toUTCString() + ";path=/;SameSite=Lax";
        
        if (banner) banner.style.display = 'none';
        hideModal();

        if (consentData.analytics && typeof gtag === 'function') {
            gtag('consent', 'update', { 'analytics_storage': 'granted' });
        }
    }

    // Only show small bottom banner if consent not yet given
    if (!getConsent() && banner) {
        setTimeout(() => { banner.style.display = 'block'; }, 1000);
    }

    if (btnAccept) btnAccept.onclick = () => saveConsent({ status: 'accepted', analytics: true, marketing: true });
    if (btnDecline) btnDecline.onclick = () => saveConsent({ status: 'essential_only', analytics: false, marketing: false });
    if (btnSettings) btnSettings.onclick = () => showModal();
    if (btnCloseModal) btnCloseModal.onclick = () => hideModal();

    if (modal) {
        modal.onclick = (e) => { if (e.target === modal) hideModal(); };
    }

    if (btnSaveSettings) {
        btnSaveSettings.onclick = () => {
            const analytics = document.getElementById('cookie-opt-analytics')?.checked || false;
            const marketing = document.getElementById('cookie-opt-marketing')?.checked || false;
            saveConsent({ status: 'custom', analytics, marketing });
        };
    }

    window.openCookieSettings = function() {
        const consent = getConsent();
        if (consent) {
            const a = document.getElementById('cookie-opt-analytics');
            const m = document.getElementById('cookie-opt-marketing');
            if (a) a.checked = consent.analytics;
            if (m) m.checked = consent.marketing;
        }
        showModal();
    };
});
</script>
