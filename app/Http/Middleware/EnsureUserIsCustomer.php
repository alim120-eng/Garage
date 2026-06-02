<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure user is logged in
        if ($request->user()) {
            // If they are admin, they shouldn't view user pages, redirect them to admin dashboard
            if ($request->user()->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('error', '🔒 كمدير، لا يمكنك تصفح واجهات الزبائن العادية، تم توجيهك للوحة التحكم الخاصة بك.');
            }

            // If they are regular user, proceed
            if ($request->user()->role === 'user') {
                return $next($request);
            }
        }

        // Default unauthorized access
        abort(403, 'Unauthorized access.');
    }
}
