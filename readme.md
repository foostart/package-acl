Step 1: Now open the file config/app.php and add to the 'providers' option the following line:

        Foostart\Acl\Authentication\AuthenticationServiceProvider::class



Step 2: Now open the file app/Http/Kernel.php and add the following lines to your $routeMiddleware array: 

        'admin_logged' => \Foostart\Acl\Http\Middleware\AdminLogged::class,
        'logged' => \Foostart\Acl\Http\Middleware\Logged::class,
        'can_see' => \Foostart\Acl\Http\Middleware\CanSee::class,
        'has_perm' => \Foostart\Acl\Http\Middleware\HasPerm::class,
        'in_context' => \Foostart\Category\Middleware\InContext::class,


Step 3: php artisan authentication:install
