@php
    // Load all settings at once to avoid multiple queries
    $siteSettings = \App\Models\Setting::getGroup('site');
    $contactSettings = \App\Models\Setting::getGroup('contact');
    $siteName = $siteSettings['site.company_name'] ?? 'Sekawan Putra Pratama';
    $siteUrl = url('/');
    $logoUrl = asset('assets/media/logo.png');
    $contactPhone = $contactSettings['contact.phone'] ?? '0851-5641-2702';
    $contactEmail = $contactSettings['contact.email'] ?? 'sekawanputrapratama@gmail.com';
    $contactAddress = $contactSettings['contact.address'] ?? 'Sekawan Office - Bekasi, Jawa Barat';
    $siteDescription = $siteSettings['site.description'] ?? 'Jasa Pembuatan Website, Aplikasi Android/iOS, dan Instalasi Server Kantor Terpercaya. Solusi IT Terintegrasi untuk bisnis Anda.';
@endphp

{{-- 1. Organization Schema (Homepage) --}}
@if(request()->routeIs('home'))
@php
    // Load social settings once
    $socialSettings = \App\Models\Setting::getGroup('social');
    $socials = [];
    if(!empty($socialSettings['social.facebook_url'])) $socials[] = $socialSettings['social.facebook_url'];
    if(!empty($socialSettings['social.instagram_url'])) $socials[] = $socialSettings['social.instagram_url'];
    if(!empty($socialSettings['social.linkedin_url'])) $socials[] = $socialSettings['social.linkedin_url'];

    $orgSchema = [
        "@context" => "https://schema.org",
        "@type" => "Organization",
        "name" => $siteName,
        "url" => $siteUrl,
        "logo" => $logoUrl,
         "description" => $siteDescription,
        "address" => [
            "@type" => "PostalAddress",
            "addressLocality" => "Bekasi",
            "addressRegion" => "Jawa Barat",
            "addressCountry" => "ID"
        ],
        "contactPoint" => [
            "@type" => "ContactPoint",
            "telephone" => $contactPhone,
            "contactType" => "Customer Service",
            "email" => $contactEmail,
            "areaServed" => "ID",
            "availableLanguage" => ["Indonesian", "English"]
        ]
    ];

    if (!empty($socials)) {
        $orgSchema['sameAs'] = $socials;
    }
    
    // Merge Reviews into Organization if existing (Optional, or keep separate)
    if(isset($testimonials) && $testimonials->count() > 0) {
        $orgSchema['aggregateRating'] = [
            "@type" => "AggregateRating",
            "ratingValue" => $testimonials->avg('rating') ?? 5,
            "reviewCount" => $testimonials->count()
        ];
        
        $reviews = [];
        foreach($testimonials->take(5) as $testimonial) {
            $reviews[] = [
                "@type" => "Review",
                "author" => ["@type" => "Person", "name" => $testimonial->client_name],
                "reviewRating" => ["@type" => "Rating", "ratingValue" => $testimonial->rating ?? 5, "bestRating" => "5"],
                "reviewBody" => $testimonial->testimonial
            ];
        }
        $orgSchema['review'] = $reviews;
    }
@endphp
<script type="application/ld+json">
    {!! json_encode($orgSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif

{{-- 2. LocalBusiness Schema (Contact Page) --}}
@if(request()->routeIs('contact'))
@php
    $localSchema = [
        "@context" => "https://schema.org",
        "@type" => "LocalBusiness",
        "name" => $siteName,
        "image" => $logoUrl,
        "url" => $siteUrl,
        "telephone" => $contactPhone,
        "email" => $contactEmail,
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => $contactAddress,
            "addressLocality" => "Bekasi",
            "addressRegion" => "Jawa Barat",
            "addressCountry" => "ID"
        ],
        "geo" => [
            "@type" => "GeoCoordinates",
            "latitude" => "-6.3776515",
            "longitude" => "107.1246921"
        ],
        "openingHoursSpecification" => [
            "@type" => "OpeningHoursSpecification",
            "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            "opens" => "09:00",
            "closes" => "17:00"
        ],
        "priceRange" => "$$",
        "areaServed" => ["@type" => "Country", "name" => "Indonesia"]
    ];
@endphp
<script type="application/ld+json">
    {!! json_encode($localSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif

{{-- 3. Service Schema --}}
@if(isset($service) && request()->routeIs('services.show'))
@php
    $serviceSchema = [
        "@context" => "https://schema.org",
        "@type" => "Service",
        "serviceType" => $service->title,
        "provider" => [
            "@type" => "Organization",
            "name" => $siteName,
            "url" => $siteUrl
        ],
        "areaServed" => [
            "@type" => "Country",
            "name" => "Indonesia"
        ],
        "description" => $service->description ?? $service->meta_description ?? '',
        "url" => route('services.show', $service->slug)
    ];

    if ($service->pricing_starting_from) {
        $serviceSchema['offers'] = [
            "@type" => "Offer",
            "price" => $service->pricing_starting_from,
            "priceCurrency" => "IDR"
        ];
    }
@endphp
<script type="application/ld+json">
    {!! json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif

{{-- 4. Article Schema --}}
@if(isset($post) && request()->routeIs('blog.show'))
@php
    $articleSchema = [
        "@context" => "https://schema.org",
        "@type" => "Article",
        "headline" => $post->title,
        "description" => $post->excerpt ?? Str::limit(strip_tags($post->content ?? ''), 160),
        "image" => $post->getFirstMediaUrl('featured_image') ?: asset('assets/media/images/blog-image-1.png'),
        "author" => [
            "@type" => "Organization",
            "name" => $siteName
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $siteName,
            "logo" => [
                "@type" => "ImageObject",
                "url" => $logoUrl
            ]
        ],
        "datePublished" => $post->published_at ? $post->published_at->toIso8601String() : $post->created_at->toIso8601String(),
        "dateModified" => $post->updated_at->toIso8601String(),
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => route('blog.show', $post->slug)
        ]
    ];
@endphp
<script type="application/ld+json">
    {!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif

{{-- 5. FAQ Schema --}}
@if(request()->routeIs('faq'))
@php
    $faqs = \App\Models\Faq::where('is_active', true)->orderBy('order')->get();
@endphp
@if($faqs->count() > 0)
@php
    $faqList = [];
    foreach($faqs as $faq) {
        $faqList[] = [
            "@type" => "Question",
            "name" => $faq->question,
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => strip_tags($faq->answer)
            ]
        ];
    }
    $faqSchema = [
        "@context" => "https://schema.org",
        "@type" => "FAQPage",
        "mainEntity" => $faqList
    ];
@endphp
<script type="application/ld+json">
    {!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
@endif