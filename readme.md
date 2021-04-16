# Foostart: Package Acl
* Access control list
* Verson: 8.x
* Support: Laravel 8x
* Contact _**foostart.com@gmail.com**_ to support other versions

## Requirements
* Config database with *.env* file

## Requirements
* Install with composer: **composer require foostart/package-acl**

## Step 1: Regist package to Laravel
Now open the file **config/app.php** and add to the **providers** option the following line:

1. Foostart\Acl\Authentication\AuthenticationServiceProvider::class,
1. Foostart\Category\CategoryServiceProvider::class,

## Step 2: Regist middleware to Laravel
Now open the file **app/Http/Kernel.php** and add the following lines to your **routeMiddleware** array: 


1. 'admin_logged' => \Foostart\Acl\Http\Middleware\AdminLogged::class,
1. 'logged' => \Foostart\Acl\Http\Middleware\Logged::class,
1. 'can_see' => \Foostart\Acl\Http\Middleware\CanSee::class,
1. 'has_perm' => \Foostart\Acl\Http\Middleware\HasPerm::class,
1. 'in_context' => \Foostart\Category\Middleware\InContext::class,


## Step 3: Delete user and password migration file in database/migrations

## Step 4: Install

1. php artisan authentication:install
```
Which provider or tag's files would you like to publish?:
Select option [* ] Provider: Foostart\Acl\Authentication\AuthenticationServiceProvider
```
2. php artisan vendor:publish --provider="Foostart\Category\CategoryServiceProvider" --force
3. Ref: https://packagist.org/packages/foostart/package-post
