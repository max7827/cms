<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;
use Illuminate\Support\Facades\Session;

class categoryRequired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Category::all()->count() == 0) {
            Session::flash('error', 'create category first');
            return redirect()->route('category.create');
        }
        return $next($request);
    }
}
