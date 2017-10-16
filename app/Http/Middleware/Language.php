<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;


class Language {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $defaultLanguageId = 1;


        $lang = $defaultLanguageId;
        $headerlang = null;
        if (Request::server('HTTP_ACCEPT_LANGUAGE') !== null)
        {
            $headerlang = substr(Request::server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        }
        if ($headerlang !== null)
        {
            $language = \Agilin\Models\Language\Language::whereCode($headerlang)->first();
            $lang = $language->id;
        }

        session(['language' => $lang]);
        return $next($request);
    }
}
