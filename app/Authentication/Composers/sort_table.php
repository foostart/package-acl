<?php

use Foostart\Category\Helpers\SortTable;

$plang_admin = 'acl-admin';
$plang_front = 'acl-front';
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
View::composer(['package-acl::admin.user.list'], function ($view) use ($plang_admin, $plang_front) {

    //List of sorting
    $orders = [
        '' => trans($plang_admin . '.order.no-selected'),
        'id' => trans($plang_admin . '.order.name'),
        'email' => trans($plang_admin . '.labels.email'),
        'first_name' => trans($plang_admin . '.labels.first_name'),
        'last_name' => trans($plang_admin . '.labels.last_name'),
        'active' => trans($plang_admin . '.labels.active'),
        'last_login' => trans($plang_admin . '.labels.last_login')
    ];
    $sortTable = new SortTable($orders);

    $view->with('sorting', $sortTable->linkOrders());
});

/**
 * Group table
 */
View::composer(['package-acl::admin.group.list'], function ($view) use ($plang_admin, $plang_front) {

    //List of sorting
    $orders = [
        '' => trans($plang_admin . '.order.no-selected'),
        'id' => trans($plang_admin . '.order.name'),
        'name' => trans($plang_admin . '.sortings.group-name'),
        'permissions' => trans($plang_admin . '.sortings.group-permissions'),
    ];
    $sortTable = new SortTable($orders);

    $view->with('sorting', $sortTable->linkOrders());
});

/**
 * Permission table
 */
View::composer(['package-acl::admin.permission.list'], function ($view) use ($plang_admin, $plang_front) {

    //List of sorting
    $orders = [
        '' => trans($plang_admin . '.order.no-selected'),
        'id' => trans($plang_admin . '.order.name'),
        'description' => trans($plang_admin . '.sortings.permission-description'),
        'permission' => trans($plang_admin . '.sortings.permission-name'),
        'url' => trans($plang_admin . '.sortings.permission-url'),
    ];
    $sortTable = new SortTable($orders);

    $view->with('sorting', $sortTable->linkOrders());
});
