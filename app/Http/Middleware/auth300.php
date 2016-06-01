<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class auth300
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
        if (!Auth::check())
        {
            $api_token = Input::get("api_token");
            $user = User::where('api_token', $api_token)->first();

            if($user) {
                Auth::login($user, false);
            }
        }
        return $next($request);
    }
}
