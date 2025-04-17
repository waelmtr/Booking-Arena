<?php

namespace App\Http\Middleware;

use App\Domain\Users\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class ArenaOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role == RoleEnum::ArenaOwner->value)
        return $next($request);
        else throw new UnauthorizedException("unauthorized" , 401);
    }
}
