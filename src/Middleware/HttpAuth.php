<?php

namespace Merkeleon\Laravel\HttpAuth\Middleware;

use Closure;
use Merkeleon\Laravel\HttpAuth\Helper;

class HttpAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function handle($request, Closure $next)
    {
        if (!Helper::isLocked())
        {
            return $next($request);
        }
        if (!$this->isWhiteListed())
        {
            $redirectUrl = Helper::getRedirect();

            if ($redirectUrl)
            {
                return redirect($redirectUrl, 302);
            }

            if (!$this->isAuthenticated())
            {
                return response(view('laravel-httpauth::unauthorized')->render(), 401, [
                    'WWW-Authenticate' => 'Basic realm="Locked"',
                ]);
            }
        }

        return $next($request);
    }

    public function isWhiteListed()
    {
        $ips = Helper::getWhiteListIps();

        return array_search(request()->server('REMOTE_ADDR'), $ips) !== false;
    }

    public function isAuthenticated()
    {
        $username = request()->server('PHP_AUTH_USER');
        if ($username === null)
        {
            return false;
        }

        return Helper::getUserPassword($username) === request()->server('PHP_AUTH_PW');
    }
}
