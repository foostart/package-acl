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
        '' => trans('jacopo-admin.order.no-selected'),
        'id' => trans('jacopo-admin.order.name'),
        'email' => trans('jacopo-admin.labels.email'),
        'first-name' => trans('jacopo-admin.labels.first-name'),
        'last-name' => trans('jacopo-admin.labels.last-name'),
        'active' => trans('jacopo-admin.labels.active'),
        'last-login' => trans('jacopo-admin.labels.last-login')
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
        '' => trans('jacopo-admin.order.no-selected'),
        'id' => trans('jacopo-admin.order.name'),
        'name' => trans('jacopo-admin.sortings.group-name'),
        'permissions' => trans('jacopo-admin.sortings.group-permissions'),
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
        '' => trans('jacopo-admin.order.no-selected'),
        'id' => trans('jacopo-admin.order.name'),
        'description' => trans('jacopo-admin.sortings.permission-description'),
        'permission' => trans('jacopo-admin.sortings.permission-name'),
        'url' => trans('jacopo-admin.sortings.permission-url'),
    ];
    $sortTable = new SortTable($orders);

    $view->with('sorting', $sortTable->linkOrders());
});