<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class Localization
{

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // read the language from the request header
        $locale = $request->header('Accept-Language');

        // if the header is missed
        if (! $locale || ! array_key_exists($locale, app()->config->get('app.supported_languages'))) {
            $locale = 'en';
        }

        // set the local language
        app()->setLocale($locale);

        // get the response after the request is done
        $response = $next($request);

        // set Content Languages header in the response
        $response->headers->set('Accept-Language', $locale);

        // return the response
        return $response;
    }
}
