@extends('frontend.layouts.app')

@section('title', 'Portfolio Proyek IT | Website & Aplikasi - PT Sekawan Putra Pratama')
@section('meta_description', 'Lihat portfolio proyek IT kami: website perusahaan, aplikasi mobile, sistem ERP, dan instalasi server. Pengalaman 50+ proyek sukses. Konsultasi GRATIS!')

@section('content')

{{-- CSS & DESIGN SYSTEM (UI-UX-PRO-MAX) --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap');

:root {
  --font-lexend: 'Lexend', sans-serif;
  --color-primary: #0891B2; 
  --color-secondary: #22D3EE; 
  --color-accent: #22C55E; 
  --color-navy: #050b14; 
  --color-text-main: #0f172a;
  --color-text-muted: #64748b;
  --bg-light: #f8fafc;
}

body { font-family: 'Inter', sans-serif; color: var(--color-text-main); }
h1, h2, h3, h4, h5, h6 { font-family: var(--font-lexend); }

.port-grad {
  background: linear-gradient(135deg, #60A5FA, #22D3EE, #34D399);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: inline-block;
}

/* ---- HERO SECTION ---- */
.port-hero {
  position: relative;
  min-height: 50vh;
  background-color: var(--color-navy);
  display: flex;
  align-items: center;
  overflow: hidden;
  padding: 120px 0 60px;
}
.port-hero-grid {
  position: absolute;
  inset: 0;
  background-image: 
    linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
  background-size: 40px 40px;
  mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
}
.port-hero-content { position: relative; z-index: 10; text-align: center; width: 100%; }
.port-hero-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(8, 145, 178, 0.1);
  border: 1px solid rgba(8, 145, 178, 0.3);
  padding: 8px 20px;
  border-radius: 50px;
  color: #22D3EE;
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-bottom: 24px;
}
.port-hero-title {
  font-size: clamp(2.5rem, 5.5vw, 4rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.1;
  margin-bottom: 24px;
  letter-spacing: -2px;
}

/* ---- FILTERS ---- */
.port-filters { padding: 40px 0; background: #fff; border-bottom: 1px solid #f1f5f9; position: sticky; top: 70px; z-index: 100; backdrop-filter: blur(10px); background: rgba(255,255,255,0.8); }
.filter-pills { display: flex; justify-content: center; gap: 12px; flex-wrap: wrap; }
.filter-btn {
  padding: 10px 24px;
  border-radius: 50px;
  border: 1px solid #e2e8f0;
  background: #fff;
  color: var(--color-text-muted);
  font-weight: 600;
  font-size: 14px;
  transition: all 0.3s ease;
  cursor: pointer;
}
.filter-btn:hover { border-color: var(--color-primary); color: var(--color-primary); }
.filter-btn.active { background: var(--color-primary); border-color: var(--color-primary); color: #fff; box-shadow: 0 10px 20px rgba(8, 145, 178, 0.2); }

/* ---- PORTFOLIO CARDS ---- */
.port-body { padding: 80px 0; background: var(--bg-light); }
.project-card {
  background: #fff;
  border-radius: 24px;
  overflow: hidden;
  border: 1px solid #e2e8f0;
  transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  height: 100%;
  display: flex;
  flex-direction: column;
}
.project-card:hover { transform: translateY(-12px); box-shadow: 0 40px 80px -20px rgba(0,0,0,0.12); border-color: var(--color-secondary); }

.project-img-wrap { position: relative; width: 100%; aspect-ratio: 16/10; overflow: hidden; }
.project-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
.project-card:hover .project-img-wrap img { transform: scale(1.1); }

.project-overlay {
  position: absolute;
  inset: 0;
  background: rgba(5, 11, 20, 0.6);
  backdrop-filter: blur(4px);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: all 0.4s ease;
}
.project-card:hover .project-overlay { opacity: 1; }
.view-btn { background: #fff; color: var(--color-navy); padding: 12px 28px; border-radius: 50px; font-weight: 700; text-decoration: none; transform: translateY(20px); transition: all 0.4s ease; }
.project-card:hover .view-btn { transform: translateY(0); }

.project-content { padding: 30px; flex-grow: 1; display: flex; flex-direction: column; }
.project-cat { color: var(--color-primary); font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
.project-title { font-size: 1.5rem; font-weight: 700; color: var(--color-text-main); margin-bottom: 12px; line-height: 1.3; }
.project-desc { font-size: 0.95rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 20px; }

.project-meta { margin-top: auto; padding-top: 20px; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
.meta-client { font-size: 13px; font-weight: 600; color: var(--color-text-main); display: flex; align-items: center; gap: 6px; }
.meta-year { font-size: 13px; color: var(--color-text-muted); font-weight: 500; }

/* ---- FEATURED BADGE ---- */
.featured-tag {
  position: absolute;
  top: 15px; left: 15px;
  background: linear-gradient(135deg, #F59E0B, #D97706);
  color: #fff;
  padding: 6px 14px;
  border-radius: 50px;
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1px;
  box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
  z-index: 5;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .port-hero { min-height: auto; padding: 120px 0 60px; }
  .port-body { padding: 60px 0; }
}
@media (max-width: 768px) {
  .port-hero-title { font-size: 2.8rem; }
  .project-content { padding: 24px; }
  .port-filters { top: 60px; padding: 20px 0; }
  .filter-pills { justify-content: flex-start; overflow-x: auto; padding-bottom: 10px; }
  .filter-btn { white-space: nowrap; }
}
</style>

{{-- HERO --}}
<section class="port-hero">
  <div class="port-hero-grid"></div>
  <div class="container">
    <div class="port-hero-content">
      <div class="port-hero-pill reveal">
        <i class="fas fa-rocket me-2"></i> KARYA TERBAIK KAMI
      </div>
      <h1 class="port-hero-title reveal delay-100">
        Inovasi Yang <br>
        <span class="port-grad">Telah Kami Wujudkan</span>
      </h1>
      <p class="svc-hero-sub reveal delay-200 mx-auto" style="color: #94a3b8; max-width: 600px;">
        Jelajahi berbagai solusi teknologi yang telah membantu mitra kami bertransformasi dan mencapai kesuksesan digital.
      </p>
    </div>
  </div>
</section>

{{-- FILTERS --}}
<section class="port-filters">
  <div class="container">
    <div class="filter-pills reveal">
      <button class="filter-btn {{ !request('category') ? 'active' : '' }}" data-filter="">Semua Proyek</button>
      @foreach($categories as $cat)
        <button class="filter-btn {{ request('category') == $cat->slug ? 'active' : '' }}" data-filter="{{ $cat->slug }}">{{ $cat->name }}</button>
      @endforeach
    </div>
  </div>
</section>

{{-- PORTFOLIO GRID --}}
<section class="port-body">
  <div class="container">
    
    <div class="row g-4" id="portfolio-grid">
      {{-- Featured Portfolios First --}}
      @if($featuredPortfolios->count() > 0 && !request()->has('search') && !request()->has('category'))
        @foreach($featuredPortfolios as $featured)
          <div class="col-lg-4 col-md-6 portfolio-item reveal" data-category="{{ $featured->category ? $featured->category->slug : '' }}">
            <div class="project-card">
              <div class="project-img-wrap">
                <span class="featured-tag"><i class="fas fa-star me-1"></i> Featured</span>
                @php
                    $featImg = $featured->getFirstMediaUrl('featured_image') ?: ($featured->featured_image ? Storage::url($featured->featured_image) : null);
                @endphp
                @if($featImg)
                    <img src="{{ $featImg }}" alt="{{ $featured->title }}">
                @else
                    <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center">
                        <i class="fas fa-image fa-3x text-white-50"></i>
                    </div>
                @endif
                <div class="project-overlay">
                  <a href="{{ route('portfolio.show', $featured->slug) }}" class="view-btn">Lihat Detail</a>
                </div>
              </div>
              <div class="project-content">
                @if($featured->category)
                  <span class="project-cat">{{ $featured->category->name }}</span>
                @endif
                <h3 class="project-title">{{ Str::limit($featured->title, 45) }}</h3>
                <p class="project-desc">{{ Str::limit($featured->short_description, 100) }}</p>
                <div class="project-meta">
                  <div class="meta-client">
                    <i class="fas fa-building text-primary"></i> 
                    {{ $featured->client_name ?: 'Internal Project' }}
                  </div>
                  <div class="meta-year">{{ $featured->created_at->format('Y') }}</div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @endif

      {{-- Regular Portfolios --}}
      @forelse($portfolios as $portfolio)
        <div class="col-lg-4 col-md-6 portfolio-item reveal" data-category="{{ $portfolio->category ? $portfolio->category->slug : '' }}">
          <div class="project-card">
            <div class="project-img-wrap">
              @php
                  $portImg = $portfolio->getFirstMediaUrl('featured_image') ?: ($portfolio->featured_image ? Storage::url($portfolio->featured_image) : null);
              @endphp
              @if($portImg)
                  <img src="{{ $portImg }}" alt="{{ $portfolio->title }}" loading="lazy">
              @else
                  <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center">
                      <i class="fas fa-image fa-3x text-white-50"></i>
                  </div>
              @endif
              <div class="project-overlay">
                <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="view-btn">Lihat Detail</a>
              </div>
            </div>
            <div class="project-content">
              @if($portfolio->category)
                <span class="project-cat">{{ $portfolio->category->name }}</span>
              @endif
              <h3 class="project-title">{{ Str::limit($portfolio->title, 50) }}</h3>
              <p class="project-desc">{{ Str::limit($portfolio->short_description, 100) }}</p>
              <div class="project-meta">
                <div class="meta-client">
                  <i class="fas fa-building text-primary"></i> 
                  {{ $portfolio->client_name ?: 'Internal Project' }}
                </div>
                <div class="meta-year">{{ $portfolio->created_at->format('Y') }}</div>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
          <h4 class="text-muted">Belum ada portfolio tersedia</h4>
        </div>
      @endforelse
    </div>

    @if($portfolios->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $portfolios->links('pagination::bootstrap-5') }}
    </div>
    @endif

  </div>
</section>

{{-- CTA --}}
<section class="py-5 bg-white mb-5">
    <div class="container text-center py-4 reveal">
        <h3 class="fw-bold text-dark mb-3" style="font-family: var(--font-lexend);">Ingin Bisnis Anda Menjadi Portofolio Kami Selanjutnya?</h3>
        <p class="text-muted mb-4 mx-auto" style="max-width: 600px;">Diskusikan kebutuhan Anda dan mari kita bangun solusi teknologi yang tepat sasaran bersama-sama.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-lg" style="background: #007bff; border: none;">
            Mulai Proyek Sekarang <i class="fas fa-paper-plane ms-2"></i>
        </a>
    </div>
</section>

{{-- JS FILTER LOGIC --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.portfolio-item');

    filters.forEach(filter => {
        filter.addEventListener('click', function() {
            filters.forEach(f => f.classList.remove('active'));
            this.classList.add('active');

            const category = this.getAttribute('data-filter');

            items.forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                if (category === '' || itemCategory === category) {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 10);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
});
</script>

@endsection
