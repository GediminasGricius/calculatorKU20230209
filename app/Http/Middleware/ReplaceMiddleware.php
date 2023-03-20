<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class ReplaceMiddleware
{

    public function handle(Request $request, Closure $next):Response
    {
        $response= $next($request);


        $content= $response->getContent();
        $content=str_replace('Gediminas', 'G*****', $content);
        $response->setContent($content);


        return $response;
    }
}
