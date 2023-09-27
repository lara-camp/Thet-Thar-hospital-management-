<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CamelToSnakeCase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $input = $request->all();

        $converted = [];
        foreach ($input as $key => $value) {
            $converted[Str::snake($key)] = $value;
        }

        $request->replace($converted);

        return $next($request);
    }
}
