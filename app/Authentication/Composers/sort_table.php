<?php
use Foostart\Category\Helpers\SortTable;

/*
|-----------------------------------------------------------------------
| Sort table
|-----------------------------------------------------------------------
| Add link to title in table
|
|
*/

/**
 * User table
 */
View::composer(['laravel-authentication-acl::admin.user.list'], function ($view){

    //List of sorting
    $orders = [
        '' => trans('tailieuweb.no_selected'),
        'email' => trans('tailieuweb.email'),
        'first_name' => trans('tailieuweb.first_name'),
        'last_name' => trans('tailieuweb.last_name'),
        'active' => trans('tailieuweb.active'),
        'last_login' => trans('tailieuweb.last_login')
    ];
    $sortTable = new SortTable($orders);

    $view->with('sorting', $sortTable->linkOrders());
});

/**
 * Group table
 */
View::composer(['laravel-authentication-acl::admin.group.list'], function ($view){

    //List of sorting
    $orders = [
        '' => trans('tailieuweb.no_selected'),
        'name' => trans('tailieuweb.group_name'),
        'permissions' => trans('tailieuweb.group_permissions'),
    ];
    $sortTable = new SortTable($orders);

    $view->with('sorting', $sortTable->linkOrders());
});

/**
 * Permission table
 */
View::composer(['laravel-authentication-acl::admin.permission.list'], function ($view){

    //List of sorting
    $orders = [
        '' => trans('tailieuweb.no_selected'),
        'description' => trans('tailieuweb.permission_description'),
        'permission' => trans('tailieuweb.permission_name'),
        'url' => trans('tailieuweb.permission_url'),
    ];
    $sortTable = new SortTable($orders);

    $view->with('sorting', $sortTable->linkOrders());
});