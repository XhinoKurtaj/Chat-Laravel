<?php

namespace App\Http\Middleware;

use Closure;
use App\Conversation;
class BelongsTo
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
        $user = auth()->user()->id;
        $conversation = Conversation::findOrFail($request->id);
        $belongs = $conversation->users->contains($user);
        if($belongs || auth()->user()->type == "admin") {
            return $next($request);
        }
        return redirect('home');
    }
}
