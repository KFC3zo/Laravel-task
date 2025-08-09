<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // تأكد إن المستخدم مسجل دخول
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        // لو مش admin، ممكن ترجّع 403 Forbidden أو تديه ريديركت
        return response()->json(['error' => 'Unauthorized - Admins only'], 403);
    }
}
