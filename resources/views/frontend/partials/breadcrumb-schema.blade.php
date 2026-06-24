@push('schema')
<script type="application/ld+json">
@php
echo json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => collect($crumbs)->values()->map(fn ($crumb, $index) => [
        '@type' => 'ListItem',
        'position' => $index + 1,
        'name' => $crumb['name'],
        'item' => $crumb['url'],
    ])->all(),
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@endphp
</script>
@endpush
