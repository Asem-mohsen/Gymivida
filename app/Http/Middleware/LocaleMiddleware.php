<?php



namespace App\Http\Middleware;

use App\Enums\AppLocale;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->detectLocale($request);

        App::setLocale($locale);
        Session::put('locale', $locale);

        return $next($request);
    }

    protected function detectLocale(Request $request): string
    {
        $segments = $request->segments();
        if (! empty($segments) && AppLocale::isSupported($segments[0])) {
            return $segments[0];
        }

        $sessionLocale = Session::get('locale');
        if (is_string($sessionLocale) && AppLocale::isSupported($sessionLocale)) {
            return $sessionLocale;
        }

        return AppLocale::normalize(config('app.fallback_locale'))->value;
    }
}
