<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptimizeImages
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Add image optimization headers
        if ($response->headers->has('Content-Type') && str_contains($response->headers->get('Content-Type'), 'text/html')) {
            $content = $response->getContent();
            
            // Add loading="lazy" to images that don't have it (except above the fold)
            // This is handled in views, but we can add additional optimizations here
            
            // Add preconnect for external resources
            if (str_contains($content, 'fonts.googleapis.com')) {
                $preconnect = '<link rel="preconnect" href="https://fonts.googleapis.com">';
                $preconnect .= '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
                $content = str_replace('</head>', $preconnect . '</head>', $content);
            }
            
            $response->setContent($content);
        }

        return $response;
    }
}


