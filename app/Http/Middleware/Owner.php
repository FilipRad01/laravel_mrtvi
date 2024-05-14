<?php

namespace App\Http\Middleware;

use App\Models\Course;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $resource = 'course'): Response
    {
        if(Auth::user()->role == 'admin') {
            return $next($request);
        }

        if ($resource == 'course') {
            $course = Course::where(['id' => $request->route('course'), 'professor' => Auth::user()->id])->get()->first();
            if($course) { 
              return $next($request); 
            }
        }
        abort(403);

    }
}
