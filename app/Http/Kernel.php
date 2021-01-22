<?php namespace Foostart\Acl\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
            \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];
    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
            'web' => [
                    'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
                    'Illuminate\Session\Middleware\StartSession',
                    'Illuminate\View\Middleware\ShareErrorsFromSession',
                    'Foostart\Acl\Http\Middleware\VerifyCsrfToken',
                    'Foostart\Acl\Http\Middleware\EncryptCookies',
            ],
            'api' => [
                    'throttle:60,1',
            ],
    ];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
        // 5.2 laravel default middleware
        //            'auth' => \App\Http\Middleware\Authenticate::class,
        //            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        //            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        //            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'admin_logged' => \Foostart\Acl\Http\Middleware\AdminLogged::class,
        'can_see' => \Foostart\Acl\Http\Middleware\CanSee::class,
        'has_perm' => \Foostart\Acl\Http\Middleware\HasPerm::class,
	];
}
