<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // التحقق مما إذا كان المستخدم مسجلاً للدخول ولديه صلاحية 'admin'
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }
        
        // إذا لم يكن مديراً، يتم منعه من الدخول
        abort(403, 'Unauthorized access');
    }
}