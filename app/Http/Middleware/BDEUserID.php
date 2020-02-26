<?php

namespace App\Http\Middleware;

use Closure;
use DevDojo\Chatter\Models\Models;

class BDEUserID
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
        if ($request->user()->hasRole('bde')) {
            $post = Models::post()->with('discussion')->findOrFail($request->post);
            $request->user()->id = $post->user_id;
        }
        return $next($request);
    }
}
