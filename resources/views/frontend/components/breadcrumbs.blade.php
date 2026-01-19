@php
    $breadcrumbs = [];
    
    // Home is always first
    $breadcrumbs[] = [
        'title' => 'Beranda',
        'url' => route('home'),
        'active' => false
    ];
    
    // Get current route
    $routeName = request()->route()->getName();
    $currentRoute = request()->route();
    
    // Add breadcrumbs based on route
    if ($routeName === 'about') {
        $breadcrumbs[] = [
            'title' => 'Tentang Kami',
            'url' => route('about'),
            'active' => true
        ];
    } elseif ($routeName === 'services.index') {
        $breadcrumbs[] = [
            'title' => 'Layanan',
            'url' => route('services.index'),
            'active' => true
        ];
    } elseif ($routeName === 'services.show') {
        $breadcrumbs[] = [
            'title' => 'Layanan',
            'url' => route('services.index'),
            'active' => false
        ];
        $breadcrumbs[] = [
            'title' => $service->title ?? 'Detail Layanan',
            'url' => route('services.show', $service->slug ?? ''),
            'active' => true
        ];
    } elseif ($routeName === 'portfolio.index') {
        $breadcrumbs[] = [
            'title' => 'Portfolio',
            'url' => route('portfolio.index'),
            'active' => true
        ];
    } elseif ($routeName === 'portfolio.show') {
        $breadcrumbs[] = [
            'title' => 'Portfolio',
            'url' => route('portfolio.index'),
            'active' => false
        ];
        $breadcrumbs[] = [
            'title' => $portfolio->title ?? 'Detail Portfolio',
            'url' => route('portfolio.show', $portfolio->slug ?? ''),
            'active' => true
        ];
    } elseif ($routeName === 'blog.index') {
        $breadcrumbs[] = [
            'title' => 'Blog',
            'url' => route('blog.index'),
            'active' => true
        ];
    } elseif ($routeName === 'blog.show') {
        $breadcrumbs[] = [
            'title' => 'Blog',
            'url' => route('blog.index'),
            'active' => false
        ];
        $breadcrumbs[] = [
            'title' => $post->title ?? 'Detail Artikel',
            'url' => route('blog.show', $post->slug ?? ''),
            'active' => true
        ];
    } elseif ($routeName === 'contact') {
        $breadcrumbs[] = [
            'title' => 'Kontak',
            'url' => route('contact'),
            'active' => true
        ];
    }
    
    // Don't show breadcrumbs on homepage
    // Logic: If only "Beranda" exists (count <= 1) AND we are on home
    if (count($breadcrumbs) <= 1 && $routeName === 'home') {
        $showBreadcrumbs = false;
    } else {
        $showBreadcrumbs = true;
    }
@endphp

@if($showBreadcrumbs ?? true)
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container-fluid">
            <ol class="breadcrumb">
                @foreach($breadcrumbs as $index => $breadcrumb)
                    @if($loop->last)
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $breadcrumb['title'] }}
                        </li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ol>
        </div>
    </nav>

    <style>
        .breadcrumb-nav {
            background: rgba(0, 0, 0, 0.3);
            padding: 20px 0;
            margin-bottom: 0;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .breadcrumb-item {
            display: flex;
            align-items: center;
        }
        
        .breadcrumb-item:not(:last-child)::after {
            content: '/';
            margin-left: 8px;
            color: rgba(255, 255, 255, 0.5);
        }
        
        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .breadcrumb-item a:hover {
            color: var(--color-primary);
        }
        
        .breadcrumb-item.active {
            color: #fff;
        }
    </style>

    {{-- JSON-LD Schema (Safe Version) --}}
    @php
        $schemaList = [];
        foreach($breadcrumbs as $index => $item) {
            $schemaList[] = [
                "@type" => "ListItem",
                "position" => $index + 1,
                "name" => $item['title'],
                "item" => url($item['url'])
            ];
        }
        
        $breadcrumbSchema = [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $schemaList
        ];
    @endphp
    <script type="application/ld+json">
        {!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

@endif {{-- <-- INI YANG TADI HILANG --}}