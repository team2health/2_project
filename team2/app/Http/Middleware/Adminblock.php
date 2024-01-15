<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Adminblock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $admin_id = session('admin_id');
        $u_id = session('id');

        if (!isset($admin_id) && !isset($u_id)) {
            return $next($request);
        } else if (isset($admin_id)) {
            return redirect()->route('admin.main');
        }

        return redirect()->back();
    }
}
