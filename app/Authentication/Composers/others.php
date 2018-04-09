<?php
use Foostart\Category\Helpers\FooCategory;

/**
 * All the view of Laravel Authentication ACL
 */
View::composer('laravel-authentication-acl::*', function ($view)
{
    //Logged user
    $view->with('logged_user', App::make('authenticator')->getLoggedUser());

    //application name
    $view->with('app_name', \Config::get('app.name'));

});

View::composer('laravel-authentication-acl::admin.user.*', function ($view)
{
    //Load category
    $obj_category = new FooCategory();
    $params = Request::all();
    $params['_key'] = $obj_category->getContextKeyByRef('user/department');
    $pluck_select_category = $obj_category->pluckSelect($params);

    $view->with('pluck_select_category', $pluck_select_category);

});

View::composer('laravel-authentication-acl::admin.permission.*', function ($view)
{
    //Load category
    $obj_category = new FooCategory();
    $params = Request::all();
    $params['_key'] = $obj_category->getContextKeyByRef('admin/permissions');
    $pluck_select_category = $obj_category->pluckSelect($params);

    $view->with('pluck_select_category', $pluck_select_category);

});
/**
 * if the site uses gravatar for avatar handling
 */
View::composer(['laravel-authentication-acl::admin.user.profile', 'laravel-authentication-acl::admin.user.self-profile'], function ($view)
{
    $view->with('use_gravatar', \Config::get('acl_config.use_gravatar'));
});

/*
|-----------------------------------------------------------------------
| Other data
|-----------------------------------------------------------------------
|
|
*/
View::composer('laravel-authentication-acl::*', function ($view)
{
    //Order by
    $order_by = [
        'asc' => trans('jacopo-admin.order-by-asc'),
        'desc' => trans('jacopo-admin.order-by-desc'),
    ];
    $view->with('order_by', $order_by);
});