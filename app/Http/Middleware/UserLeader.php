<?php  namespace Foostart\Acl\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

/*
 * Check that the user has one of the permission given
 */
class UserLeader {

    public function handle($request, Closure $next)
    {
        var_dump(11);
        die();
//        $permissions = array_slice(func_get_args(), 2);
//
//        $authentication_helper = App::make('authentication_helper');
//        if(!$authentication_helper->hasPermission($permissions)) App::abort('401');

        return $next($request);
//
//        $route_helper = App::make('route_perm_helper');
//        if(!$route_helper->hasPermForRoute(Route::currentRouteName())) App::abort('401');
//
//        return $next($request);
    }
}