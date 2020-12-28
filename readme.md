#Foostart: Package Acle
* Access control list
* Source: http://plugins.netbeans.org/plugin/50964/markdown-support
* Verson: 7.0.0

##Step 1: Regist package to Laravel
Now open the file config/app.php and add to the 'providers' option the following line:

> Foostart\Acl\Authentication\AuthenticationServiceProvider::class,

> Foostart\Category\CategoryServiceProvider::class,

##Step 2: Regist middleware to Laravel
Now open the file app/Http/Kernel.php and add the following lines to your $routeMiddleware array: 

>
    'admin_logged' => \Foostart\Acl\Http\Middleware\AdminLogged::class,
    'logged' => \Foostart\Acl\Http\Middleware\Logged::class,
    'can_see' => \Foostart\Acl\Http\Middleware\CanSee::class,
    'has_perm' => \Foostart\Acl\Http\Middleware\HasPerm::class,
    'in_context' => \Foostart\Category\Middleware\InContext::class,


##Step 3: Delete user and password migration file in database/migrations

##Step 4: Install
>
* php artisan authentication:install
*  php artisan vendor:publish --provider="Foostart\Category\CategoryServiceProvider" --force
