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
        '' => trans('jacopo-admin.no-selected'),
         'id' => trans('jacopo-admin.order'),
        'email' => trans('jacopo-admin.email'),
        'first_name' => trans('jacopo-admin.first-name'),
        'last_name' => trans('jacopo-admin.last-name'),
        'active' => trans('jacopo-admin.active'),
        'last_login' => trans('jacopo-admin.last-login')
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
        '' => trans('jacopo-admin.no-selected'),
        'id' => trans('jacopo-admin.order'),
        'name' => trans('jacopo-admin.group-name'),
        'permissions' => trans('jacopo-admin.group-permissions'),
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
        '' => trans('jacopo-admin.no-selected'),
        'description' => trans('jacopo-admin.permission-description'),
        'permission' => trans('jacopo-admin.permission-name'),
        'url' => trans('jacopo-admin.permission-url'),
    ];
    $sortTable = new SortTable($orders);

    $view->with('sorting', $sortTable->linkOrders());
});