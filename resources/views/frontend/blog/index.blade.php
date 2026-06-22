@extends('frontend.layouts.app')

@section('title', 'Blog & Artikel IT Terkini | Tips & Tutorial - PT Sekawan Putra Pratama')
@section('meta_description', 'Baca artikel terbaru seputar teknologi, tutorial programming, tips IT, dan tren digital. Update mingguan dari expert IT berpengalaman.')

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

.blog-grad {
  background: linear-gradient(135deg, #60A5FA, #22D3EE, #34D399);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: inline-block;
}

/* ---- HERO SECTION ---- */
.blog-hero {
  position: relative;
  min-height: 50vh;
  background-color: var(--color-navy);
  display: flex;
  align-items: center;
  overflow: hidden;
  padding: 120px 0 60px;
}
.blog-hero-grid {
  position: absolute;
  inset: 0;
  background-image: 
    linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
  background-size: 40px 40px;
  mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
}
.blog-hero-content { position: relative; z-index: 10; text-align: center; width: 100%; }
.blog-hero-pill {
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
.blog-hero-title {
  font-size: clamp(2.5rem, 5.5vw, 4rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.1;
  margin-bottom: 24px;
  letter-spacing: -2px;
}

/* ---- FILTERS ---- */
.blog-filters { padding: 30px 0; background: #fff; border-bottom: 1px solid #f1f5f9; position: sticky; top: 70px; z-index: 100; backdrop-filter: blur(10px); background: rgba(255,255,255,0.8); }
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

/* ---- FEATURED POST ---- */
.featured-section { padding: 80px 0 40px; background: var(--bg-light); }
.featured-card {
  background: #fff;
  border-radius: 32px;
  overflow: hidden;
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  border: 1px solid #e2e8f0;
  transition: all 0.4s ease;
}
.featured-card:hover { transform: translateY(-8px); box-shadow: 0 40px 80px -20px rgba(0,0,0,0.1); }
.featured-img-wrap { position: relative; width: 100%; height: 100%; min-height: 400px; overflow: hidden; }
.featured-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
.featured-content { padding: 60px; display: flex; flex-direction: column; justify-content: center; }
.featured-tag {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--color-primary);
  color: #fff;
  padding: 6px 16px;
  border-radius: 50px;
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 24px;
  width: fit-content;
}

/* ---- BLOG CARDS ---- */
.blog-body { padding: 40px 0 100px; background: var(--bg-light); }
.blog-card {
  background: #fff;
  border-radius: 24px;
  overflow: hidden;
  border: 1px solid #e2e8f0;
  transition: all 0.4s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
}
.blog-card:hover { transform: translateY(-10px); box-shadow: 0 30px 60px -15px rgba(0,0,0,0.08); border-color: var(--color-secondary); }
.blog-img-wrap { position: relative; width: 100%; aspect-ratio: 16/10; overflow: hidden; }
.blog-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
.blog-card:hover .blog-img-wrap img { transform: scale(1.1); }

.blog-content { padding: 30px; flex-grow: 1; display: flex; flex-direction: column; }
.blog-cat { color: var(--color-primary); font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
.blog-title { font-size: 1.35rem; font-weight: 700; color: var(--color-text-main); margin-bottom: 12px; line-height: 1.4; }
.blog-title a { color: inherit; text-decoration: none; transition: color 0.3s ease; }
.blog-title a:hover { color: var(--color-primary); }
.blog-excerpt { font-size: 0.95rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 24px; }

.blog-footer { margin-top: auto; padding-top: 20px; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
.blog-author { display: flex; align-items: center; gap: 10px; }
.author-avatar { width: 32px; height: 32px; background: var(--bg-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; color: var(--color-primary); }
.author-name { font-size: 13px; font-weight: 600; color: var(--color-text-main); }
.blog-date { font-size: 12px; color: var(--color-text-muted); font-weight: 500; }

/* ---- NEWSLETTER ---- */
.newsletter-section { padding: 100px 0; background: #fff; }
.newsletter-box {
  background: var(--color-navy);
  border-radius: 40px;
  padding: 80px 60px;
  position: relative;
  overflow: hidden;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: center;
}
.newsletter-box .glow { position: absolute; top: -50%; right: -50%; width: 100%; height: 200%; background: radial-gradient(circle at center, rgba(34, 211, 238, 0.08) 0%, transparent 60%); }
.newsletter-box h2 { font-size: 2.5rem; font-weight: 800; color: #fff; margin-bottom: 16px; position: relative; z-index: 2; }
.newsletter-box p { color: #94a3b8; font-size: 1.1rem; line-height: 1.6; margin: 0; position: relative; z-index: 2; }

.news-form { position: relative; z-index: 2; }
.news-input-group { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 8px; display: flex; gap: 10px; }
.news-input-group input { background: transparent; border: none; color: #fff; padding: 12px 20px; flex-grow: 1; outline: none; }
.news-input-group input::placeholder { color: rgba(255,255,255,0.3); }
.news-btn { background: var(--color-primary); color: #fff; border: none; padding: 12px 30px; border-radius: 14px; font-weight: 700; transition: all 0.3s ease; }
.news-btn:hover { background: var(--color-secondary); transform: scale(1.05); }

/* ---- RESPONSIVE ---- */
@media (max-width: 1200px) {
  .featured-card { grid-template-columns: 1fr; }
  .featured-content { padding: 40px; }
  .featured-img-wrap { min-height: 300px; }
  .newsletter-box { grid-template-columns: 1fr; gap: 40px; text-align: center; padding: 60px 40px; }
}
@media (max-width: 991px) {
  .blog-hero { min-height: auto; padding: 120px 0 60px; }
  .blog-body { padding: 60px 0; }
}
@media (max-width: 768px) {
  .blog-hero-title { font-size: 2.8rem; }
  .blog-filters { top: 60px; padding: 20px 0; }
  .filter-pills { justify-content: flex-start; overflow-x: auto; padding-bottom: 10px; }
  .filter-btn { white-space: nowrap; }
  .newsletter-box h2 { font-size: 2rem; }
  .news-input-group { flex-direction: column; background: transparent; border: none; padding: 0; }
  .news-input-group input { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; margin-bottom: 10px; }
  .news-btn { width: 100%; border-radius: 16px; padding: 16px; }
}
</style>

{{-- HERO --}}
<section class="blog-hero">
  <div class="blog-hero-grid"></div>
  <div class="container">
    <div class="blog-hero-content">
      <div class="blog-hero-pill reveal">
        <i class="fas fa-pen-nib me-2"></i> INSIGHT & TECH TRENDS
      </div>
      <h1 class="blog-hero-title reveal delay-100">
        Wawasan & <br>
        <span class="blog-grad">Inovasi Teknologi</span>
      </h1>
      <p class="svc-hero-sub reveal delay-200 mx-auto" style="color: #94a3b8; max-width: 620px;">
        Temukan tips, tutorial, dan berita terbaru seputar transformasi digital untuk membantu pertumbuhan bisnis Anda.
      </p>
    </div>
  </div>
</section>

{{-- FILTERS --}}
<section class="blog-filters">
  <div class="container text-center">
    <div class="filter-pills reveal">
      <button class="filter-btn {{ !request('category') ? 'active' : '' }}" data-filter="">Semua Artikel</button>
      @foreach($categories as $cat)
        <button class="filter-btn {{ request('category') == $cat->slug ? 'active' : '' }}" data-filter="{{ $cat->slug }}">{{ $cat->name }}</button>
      @endforeach
    </div>
  </div>
</section>

{{-- FEATURED POST --}}
@if($featuredPost && !request()->has('search') && !request()->has('category'))
<section class="featured-section">
  <div class="container">
    <div class="featured-card reveal">
      <div class="featured-img-wrap">
        @if($featuredPost->featured_image)
          <img src="{{ Storage::url($featuredPost->featured_image) }}" alt="{{ $featuredPost->title }}">
        @else
          <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center">
            <i class="fas fa-newspaper fa-4x text-white-50"></i>
          </div>
        @endif
        <div class="featured-tag" style="position: absolute; top: 20px; left: 20px; background: var(--color-primary);"><i class="fas fa-fire me-1"></i> Featured</div>
      </div>
      <div class="featured-content">
        @if($featuredPost->category)
          <span class="blog-cat">{{ $featuredPost->category->name }}</span>
        @endif
        <h2 class="blog-title" style="font-size: 2rem;">
          <a href="{{ route('blog.show', $featuredPost->slug) }}">{{ $featuredPost->title }}</a>
        </h2>
        <p class="blog-excerpt">{{ Str::limit($featuredPost->excerpt, 180) }}</p>
        <div class="blog-footer">
          <div class="blog-author">
            <div class="author-avatar"><i class="fas fa-user"></i></div>
            <div class="author-name">{{ $featuredPost->author->name ?? 'Admin' }}</div>
          </div>
          <div class="blog-date">{{ $featuredPost->published_at->format('d M Y') }}</div>
        </div>
        <a href="{{ route('blog.show', $featuredPost->slug) }}" class="btn btn-primary rounded-pill mt-4 px-4 py-2 fw-bold d-inline-block" style="width: fit-content; background: var(--color-primary); border: none;">
          Baca Selengkapnya <i class="fas fa-arrow-right ms-2 small"></i>
        </a>
      </div>
    </div>
  </div>
</section>
@endif

{{-- BLOG GRID --}}
<section class="blog-body">
  <div class="container">
    <div class="row g-4" id="blog-grid">
      @forelse($blogs as $blog)
        <div class="col-lg-4 col-md-6 blog-item reveal" data-category="{{ $blog->category ? $blog->category->slug : '' }}">
          <div class="blog-card">
            <div class="blog-img-wrap">
              @if($blog->featured_image)
                <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}" loading="lazy">
              @else
                <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center">
                  <i class="fas fa-newspaper fa-3x text-white-50"></i>
                </div>
              @endif
            </div>
            <div class="blog-content">
              @if($blog->category)
                <span class="blog-cat">{{ $blog->category->name }}</span>
              @endif
              <h3 class="blog-title">
                <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
              </h3>
              <p class="blog-excerpt">{{ Str::limit($blog->excerpt, 100) }}</p>
              <div class="blog-footer">
                <div class="blog-author">
                  <div class="author-avatar"><i class="fas fa-user"></i></div>
                  <span class="author-name">{{ $blog->author->name ?? 'Admin' }}</span>
                </div>
                <div class="blog-date">{{ $blog->published_at->format('d M Y') }}</div>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
          <h4 class="text-muted">Belum ada artikel tersedia</h4>
        </div>
      @endforelse
    </div>

    @if($blogs->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $blogs->links('pagination::bootstrap-5') }}
    </div>
    @endif
  </div>
</section>

{{-- NEWSLETTER --}}
<section class="newsletter-section container mb-5">
  <div class="newsletter-box reveal">
    <div class="glow"></div>
    <div class="news-text">
      <h2>Tetap Update dengan Tren Teknologi</h2>
      <p>Dapatkan kurasi berita teknologi dan update project terbaru dari PT Sekawan Putra Pratama langsung di inbox Anda.</p>
    </div>
    <div class="news-form">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3 py-2 rounded-3" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @error('email')
            <div class="alert alert-danger alert-dismissible fade show mb-3 py-2 rounded-3" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ $message }}
                <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        <form action="{{ route('newsletter.store') }}" method="POST">
            @csrf
            <div class="news-input-group">
                <input type="email" name="email" placeholder="Masukkan email Anda..." value="{{ old('email') }}" required>
                <button type="submit" class="news-btn">Subscribe</button>
            </div>
        </form>
        <p class="small mt-3 text-white-50">
            <i class="fas fa-lock me-1 opacity-50"></i> Kami menghargai privasi Anda sepenuhnya.
        </p>
    </div>
  </div>
</section>

{{-- JS FILTER LOGIC --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.blog-item');

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