<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Collage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckCollageAccess
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
        $route = Route::current();
        $parameters = $route->parameters();
        $collage_id = null;
        foreach ($parameters as $name => $value) {
            
            switch ($name) {
                case 'collage':
                    $collage_id = $value->id;
                    break;
                case 'term':
                    $collage_id = $value->collage_id;
                    break;
                case 'specialization':
                    $collage_id = $value->collage_id;
                    break;
                case 'question':
                    $collage_id = $value->collage_id;
                    break;
            }

            if (!$collage_id || !Auth::user()->hasAccessToCollage($collage_id)) {
                return response()->json([
                    'message' => 'Unauthorized. You Can Access Your Collage Information Only.'
                ], 403);
            }
        }

        return $next($request);
    }
}