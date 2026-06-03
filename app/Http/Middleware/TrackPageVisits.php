<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisits
{
    public function handle(Request $request, Closure $next): Response
    {
        // Don't track:
        if (
            $request->is('admin*') ||          // Admin panel
            $request->ajax() ||                // AJAX/API
            $request->is('api/*') ||           // API
            $request->is('login') ||           // Login page
            $request->is('livewire/*') ||      // Livewire system routes
            $request->method() !== 'GET'       // Only track GET requests
        ) {
            return $next($request);
        }

        // Exclude asset file extensions
        $path = $request->path();
        if (preg_match('/\.(js|css|png|jpg|jpeg|gif|svg|ico|map|json|xml|txt|woff|woff2|ttf|eot)$/i', $path)) {
            return $next($request);
        }

        // Log the page visit
        PageVisit::create([
            'url' => '/'.ltrim($request->path(), '/'), // ensure leading slash
            'full_url' => $request->fullUrl(),
            'referer' => $request->header('referer'),
            'ip' => substr(hash('sha256', $request->ip()), 0, 16), // anonymized IP
            'user_agent' => $request->userAgent(),
            'visited_at' => now(),
        ]);

        return $next($request);
    }
}
