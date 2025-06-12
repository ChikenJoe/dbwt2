<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleCors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedOrigin = 'http://127.0.0.1:8000';
        $allowedMethods = 'POST, GET, OPTIONS, PUT, DELETE';
        $allowedHeaders = 'X-CSRF-TOKEN, Content-Type, Authorization, Accept, Origin';

        if ($request->isMethod('OPTIONS')) {
            return response('', 204)
                ->header('Access-Control-Allow-Origin', $allowedOrigin)
                ->header('Access-Control-Allow-Methods', $allowedMethods)
                ->header('Access-Control-Allow-Headers', $allowedHeaders)
                ->header('Access-Control-Allow-Credentials', 'true'); // 🔥 Wichtig für Cookies
        }

        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', $allowedOrigin);
        $response->headers->set('Access-Control-Allow-Methods', $allowedMethods);
        $response->headers->set('Access-Control-Allow-Headers', $allowedHeaders);
        $response->headers->set('Access-Control-Allow-Credentials', 'true'); // 🔥

        return $response;
    }
}
