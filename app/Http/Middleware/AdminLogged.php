<?php namespace Foostart\Acl\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

/*
 * Check that the current user is logged and active and redirect to client login or
 * to custom url if given
 */

class AdminLogged
{

    public function handle($request, Closure $next, $custom_url = null)
    {
        $redirect_url = $custom_url ?: '/login';
        if (!App::make('authenticator')->check()) return redirect($redirect_url);

        return $next($request);
    }
}
