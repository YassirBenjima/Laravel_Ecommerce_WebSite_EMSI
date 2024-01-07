<?php

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
        return $request->expectsJson() ? null : route('account.login');
    }
    // protected function authenticate($request, array $guards)
    // {
    //     if ($this->auth->guard('admin')->check()) {
    //         return $this->auth->shouldUse('admin');
    //     }
    //     $this->unauthenticated($request, ['admin']);
    // }

}
