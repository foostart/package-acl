Step 1: Now open the file config/app.php and add to the 'providers' option the following line:

        LaravelAcl\Authentication\AuthenticationServiceProvider::class



Step 2: Now open the file app/Http/Kernel.php and add the following lines to your $routeMiddleware array: 

        'admin_logged' => \LaravelAcl\Http\Middleware\AdminLogged::class,
        'logged' => \LaravelAcl\Http\Middleware\Logged::class,
        'can_see' => \LaravelAcl\Http\Middleware\CanSee::class,
        'has_perm' => \LaravelAcl\Http\Middleware\HasPerm::class,
        'in_context' => \Foostart\Category\Middleware\InContext::class,


Step 3: php artisan authentication:install
