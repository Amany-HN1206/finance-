<?php
// app/Http/Middleware/RedirectIfAuthenticated.php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * The URIs that should be accessible after authentication.
     *
     * @var array<int, string>
     */
    protected $redirectTo = [
        'member' => '/member/dashboard',
        'admin'  => '/admin/dashboard',
    ];

    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $redirectPath = $guard ? ($this->redirectTo[$guard] ?? RouteServiceProvider::HOME) : RouteServiceProvider::HOME;
                return redirect($redirectPath);
            }
        }

        return $next($request);
    }
}