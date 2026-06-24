@extends('frontend.layouts.app')

@section('title', $portfolio->meta_title ?? $portfolio->title . ' - Portfolio Sekawan Putra Pratama')
@section('meta_description', $portfolio->meta_description ?? Str::limit($portfolio->short_description, 160))
@section('meta_keywords', $portfolio->meta_keywords)

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Portfolio', 'url' => route('portfolio.index')],
    ['name' => $portfolio->title, 'url' => route('portfolio.show', $portfolio->slug)],
]])

@section('content')

<style>
:root {
  --primary-blue: #3B82F6;
  --primary-hover: #2563EB;
  --accent-cyan: #06b6d4;
  --text-main: #0f172a;
  --text-muted: #475569;
  --border-card: #e2e8f0;
  --bg-alt: #f8fafc;
  --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
  --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
  --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
}

.pfs-hero {
  position: relative;
  background-color: #050b14;
  background-image:
    radial-gradient(circle at 80% 30%, rgba(30, 58, 138, 0.3) 0%, transparent 50%),
    radial-gradient(circle at 20% 80%, rgba(30, 58, 138, 0.15) 0%, transparent 40%);
  padding: 140px 0 70px;
  overflow: hidden;
}
.pfs-hero-grid {
  position: absolute; inset: 0;
  background-image:
    linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
  background-size: 50px 50px;
  mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
  -webkit-mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
}
.pfs-breadcrumb { position: relative; z-index: 2; }
.pfs-breadcrumb a { color: #94a3b8; text-decoration: none; font-size: 13px; font-weight: 600; }
.pfs-breadcrumb a:hover { color: var(--primary-blue); }
.pfs-breadcrumb .sep { color: #475569; margin: 0 8px; }
.pfs-tag {
  display: inline-flex; align-items: center; background: rgba(59,130,246,0.12);
  border: 1px solid rgba(59,130,246,0.3); color: #60a5fa; padding: 6px 16px;
  border-radius: 50px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
}
.pfs-title {
  position: relative; z-index: 2; font-size: clamp(2rem, 4.5vw, 3.2rem); font-weight: 800;
  color: #fff; margin: 24px 0 16px; letter-spacing: -1px; line-height: 1.15;
}
.pfs-desc { position: relative; z-index: 2; color: #94a3b8; font-size: 1.1rem; line-height: 1.6; max-width: 700px; }
.pfs-meta { position: relative; z-index: 2; display: flex; gap: 20px; margin-top: 20px; flex-wrap: wrap; }
.pfs-meta span { color: #64748b; font-size: 13px; font-weight: 600; }
.pfs-meta span i { color: var(--primary-blue); margin-right: 6px; }

.pfs-body { background: #ffffff; padding: 60px 0 100px; }
.pfs-featured-img {
  border-radius: 24px; overflow: hidden; box-shadow: var(--shadow-lg); margin-top: -90px;
  position: relative; z-index: 5; border: 1px solid var(--border-card);
}
.pfs-featured-img img { width: 100%; max-height: 560px; object-fit: cover; display: block; }

.pfs-csr-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin: 50px 0; }
.pfs-csr-card {
  background: var(--bg-alt); border: 1px solid var(--border-card); border-radius: 18px; padding: 28px;
  transition: all 0.3s ease;
}
.pfs-csr-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
.pfs-csr-card h6 { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
.pfs-csr-card.challenge h6 { color: #f59e0b; }
.pfs-csr-card.solution h6 { color: var(--primary-blue); }
.pfs-csr-card.results h6 { color: #22c55e; }
.pfs-csr-card p {
  color: var(--text-muted); font-size: 0.92rem; line-height: 1.6; margin: 0;
  display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 7; overflow: hidden;
}

.pfs-content { color: var(--text-muted); font-size: 1.05rem; line-height: 1.85; margin: 50px 0; }
.pfs-content h2, .pfs-content h3 { color: var(--text-main); font-weight: 800; margin-top: 32px; }
.pfs-content img { border-radius: 16px; box-shadow: var(--shadow-sm); margin: 20px 0; }

.pfs-section-title { font-size: 1.4rem; font-weight: 800; color: var(--text-main); margin-bottom: 24px; }

.pfs-metrics { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 20px; margin: 50px 0; }
.pfs-metric-card {
  text-align: center; padding: 30px 20px; border-radius: 18px; background: var(--bg-alt);
  border: 1px solid var(--border-card); transition: all 0.3s ease;
}
.pfs-metric-card:hover { transform: translateY(-4px); border-color: rgba(59,130,246,0.3); box-shadow: var(--shadow-md); }
.pfs-metric-card h3 {
  font-size: 2.2rem; font-weight: 800; margin-bottom: 6px;
  background: linear-gradient(135deg, var(--primary-blue), var(--accent-cyan));
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;
}
.pfs-metric-card p { color: var(--text-muted); font-size: 0.85rem; margin: 0; font-weight: 600; }

.pfs-gallery { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin: 50px 0; }
.pfs-gallery-item { border-radius: 16px; overflow: hidden; aspect-ratio: 4/3; border: 1px solid var(--border-card); }
.pfs-gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
.pfs-gallery-item:hover img { transform: scale(1.08); }

.pfs-tech-pill {
  display: inline-flex; align-items: center; background: rgba(59,130,246,0.08); color: var(--primary-blue);
  border: 1px solid rgba(59,130,246,0.15); padding: 8px 18px; border-radius: 50px; font-size: 13px; font-weight: 600;
}

.pfs-cta-box {
  background: var(--bg-alt); border: 1px solid var(--border-card); border-radius: 20px; padding: 32px;
  margin-top: 50px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;
}
.pfs-cta-box .client-label { color: var(--text-muted); font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; }
.pfs-cta-box .client-name { color: var(--text-main); font-size: 1.2rem; font-weight: 800; }
.pfs-cta-box .client-industry { color: var(--text-muted); font-size: 0.9rem; }
.pfs-visit-btn {
  display: inline-flex; align-items: center; gap: 8px; background: var(--primary-blue); color: #fff;
  padding: 14px 28px; border-radius: 50px; font-weight: 700; font-size: 14px; text-decoration: none;
  transition: all 0.3s ease; box-shadow: 0 10px 25px rgba(59,130,246,0.3);
}
.pfs-visit-btn:hover { background: var(--primary-hover); transform: translateY(-2px); color: #fff; }

.pfs-related-section { background: var(--bg-alt); padding: 80px 0; border-top: 1px solid var(--border-card); }

@media (max-width: 768px) {
  .pfs-csr-grid { grid-template-columns: 1fr; }
  .pfs-gallery { grid-template-columns: repeat(2, 1fr); }
  .pfs-featured-img { margin-top: -50px; }
}
</style>

{{-- HERO --}}
<section class="pfs-hero">
  <div class="pfs-hero-grid"></div>
  <div class="container">
    <nav class="pfs-breadcrumb mb-3">
      <a href="{{ route('portfolio.index') }}">Portfolio</a>
      @if($portfolio->category)
        <span class="sep">/</span>
        <a href="{{ route('portfolio.index', ['category' => $portfolio->category->slug]) }}">{{ $portfolio->category->name }}</a>
      @endif
      <span class="sep">/</span>
      <span class="text-white">{{ Str::limit($portfolio->title, 40) }}</span>
    </nav>

    @if($portfolio->category)
      <span class="pfs-tag">{{ $portfolio->category->name }}</span>
    @endif

    <h1 class="pfs-title">{{ $portfolio->title }}</h1>
    <p class="pfs-desc">{{ $portfolio->short_description }}</p>

    <div class="pfs-meta">
        <span><i class="fas fa-calendar"></i>{{ $portfolio->created_at->format('M Y') }}</span>
        @if($portfolio->client_name)
            <span><i class="fas fa-user-tie"></i>{{ $portfolio->client_name }}</span>
        @endif
    </div>
  </div>
</section>

<section class="pfs-body">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">

        @php
            $showImg = $portfolio->getFirstMediaUrl('featured_image') ?: ($portfolio->featured_image ? Storage::url($portfolio->featured_image) : null);
        @endphp
        @if($showImg)
        <div class="pfs-featured-img">
          <img src="{{ $showImg }}" alt="{{ $portfolio->title }}" loading="lazy">
        </div>
        @endif

        @if($portfolio->challenge || $portfolio->solution || $portfolio->results)
        <div class="pfs-csr-grid">
          @if($portfolio->challenge)
          <div class="pfs-csr-card challenge">
            <h6>Challenge</h6>
            <p>{{ $portfolio->challenge }}</p>
          </div>
          @endif
          @if($portfolio->solution)
          <div class="pfs-csr-card solution">
            <h6>Solution</h6>
            <p>{{ $portfolio->solution }}</p>
          </div>
          @endif
          @if($portfolio->results)
          <div class="pfs-csr-card results">
            <h6>Results</h6>
            <p>{{ $portfolio->results }}</p>
          </div>
          @endif
        </div>
        @endif

        @if($portfolio->content)
        <div class="pfs-content">
          {!! $portfolio->content !!}
        </div>
        @endif

        @if($portfolio->metrics && is_array($portfolio->metrics) && count($portfolio->metrics) > 0)
        <div>
          <h5 class="pfs-section-title">Key Metrics</h5>
          <div class="pfs-metrics">
            @foreach($portfolio->metrics as $metric)
                @if(isset($metric['label']) && isset($metric['value']))
                <div class="pfs-metric-card">
                  <h3>{{ $metric['value'] }}</h3>
                  <p>{{ $metric['label'] }}</p>
                </div>
                @endif
            @endforeach
          </div>
        </div>
        @endif

        @if($portfolio->images && is_array($portfolio->images) && count($portfolio->images) > 0)
        <div>
          <h5 class="pfs-section-title">Gallery</h5>
          <div class="pfs-gallery">
            @foreach($portfolio->images as $image)
                <a href="{{ Storage::url($image) }}" data-lightbox="gallery" data-title="{{ $portfolio->title }}" class="pfs-gallery-item">
                  <img src="{{ Storage::url($image) }}" alt="{{ $portfolio->title }}" loading="lazy">
                </a>
            @endforeach
          </div>
        </div>
        @endif

        @if($portfolio->technologies)
        <div class="mb-5">
          <h5 class="pfs-section-title">Technologies</h5>
          <div class="d-flex flex-wrap gap-2">
            @foreach(is_array($portfolio->technologies) ? $portfolio->technologies : explode(',', $portfolio->technologies) as $tech)
                <span class="pfs-tech-pill">{{ is_array($tech) ? $tech : trim($tech) }}</span>
            @endforeach
          </div>
        </div>
        @endif

        @if($portfolio->client_name || $portfolio->project_url)
        <div class="pfs-cta-box">
            @if($portfolio->client_name)
            <div>
              <p class="client-label mb-0">Client</p>
              <p class="client-name mb-0">{{ $portfolio->client_name }}</p>
              @if($portfolio->client_industry)
                <p class="client-industry mb-0">{{ $portfolio->client_industry }}</p>
              @endif
            </div>
            @endif

            @if($portfolio->project_url)
            <a href="{{ $portfolio->project_url }}" target="_blank" class="pfs-visit-btn">
              Visit Project <i class="fas fa-arrow-right"></i>
            </a>
            @endif
        </div>
        @endif

      </div>
    </div>
  </div>
</section>

{{-- RELATED PROJECTS --}}
@if(isset($relatedPortfolios) && $relatedPortfolios->count() > 0)
<section class="pfs-related-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <h5 class="pfs-section-title">Related Projects</h5>

        <div class="row g-4">
          @foreach($relatedPortfolios as $related)
          <div class="col-md-4">
            <a href="{{ route('portfolio.show', $related->slug) }}" class="text-decoration-none">
              <div class="pfs-related-card">
                <div class="pfs-related-img">
                  @php
                      $relImg = $related->getFirstMediaUrl('featured_image') ?: ($related->featured_image ? Storage::url($related->featured_image) : null);
                  @endphp
                  @if($relImg)
                      <img src="{{ $relImg }}" alt="{{ $related->title }}" loading="lazy">
                  @else
                      <div class="pfs-related-placeholder"><i class="fas fa-briefcase"></i></div>
                  @endif
                </div>
                <div class="pfs-related-body">
                  @if($related->category)
                      <span class="pfs-tech-pill mb-2">{{ $related->category->name }}</span>
                  @endif
                  <h6>{{ Str::limit($related->title, 50) }}</h6>
                  <p>{{ Str::limit($related->short_description, 80) }}</p>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<style>
.pfs-related-card {
  background: #fff; border: 1px solid var(--border-card); border-radius: 18px; overflow: hidden;
  height: 100%; transition: all 0.3s ease; box-shadow: var(--shadow-sm);
}
.pfs-related-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); border-color: rgba(59,130,246,0.3); }
.pfs-related-img { height: 170px; overflow: hidden; }
.pfs-related-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
.pfs-related-card:hover .pfs-related-img img { transform: scale(1.08); }
.pfs-related-placeholder {
  width: 100%; height: 100%; background: var(--bg-alt); display: flex; align-items: center;
  justify-content: center; color: var(--text-muted); opacity: 0.4; font-size: 2rem;
}
.pfs-related-body { padding: 20px; }
.pfs-related-body h6 { color: var(--text-main); font-weight: 800; margin: 4px 0 8px; }
.pfs-related-body p { color: var(--text-muted); font-size: 0.85rem; margin: 0; }
</style>
@endif

@endsection
