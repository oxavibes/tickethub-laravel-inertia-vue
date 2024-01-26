<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next, $permission)
	{
		if (!auth()->user()->hasPermissionTo($permission)) {
			// Redirect or return an error response
			return redirect()->back()->with('message', 'Unauthorized access');
		}

		return $next($request);
	}
}
