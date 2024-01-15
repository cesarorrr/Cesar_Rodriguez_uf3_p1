<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $image_url = $_POST["Imagen"];
        if (!filter_var($image_url, FILTER_VALIDATE_URL)) {
            return response(view("welcome", ["error" => "Error, la URL no es valida"]));
        }
        return $next($request);
    }
}
