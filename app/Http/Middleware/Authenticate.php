<?php
// app/Http/Middleware/Authenticate.php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Cek route saat ini untuk menentukan redirect
            $routeName = $request->route()->getName();

            if (str_starts_with($routeName, 'admin.')) {
                return route('admin.login');
            }

            return route('member.login');
        }

        return null;
    }
}