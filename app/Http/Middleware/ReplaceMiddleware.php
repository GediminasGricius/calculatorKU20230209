<?php

namespace App\Http\Middleware;

use App\Models\ShortCode;
use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class ReplaceMiddleware
{

    public function handle(Request $request, Closure $next):Response
    {
        $response= $next($request);


        $content= $response->getContent();
        foreach (ShortCode::all() as $code){
            $content=str_replace("[[$code->name]]", $code->value, $content);
        }

        $response->setContent($content);


        return $response;
    }
}
