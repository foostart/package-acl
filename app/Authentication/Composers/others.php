<?php

use Foostart\Category\Helpers\FoostartCategory;

$plang_admin = 'acl-admin';
$plang_front = 'acl-front';

/**
 * All the view of Laravel Authentication ACL
 */
View::composer('package-acl::*', function ($view) use ($plang_admin, $plang_front) {
    //Logged user
    $view->with('logged_user', App::make('authenticator')->getLoggedUser());

    //application name
    $view->with('app_name', \Config::get('app.name'));

    /**
     * $plang-admin
     * $plang-front
     */
    $view->with('plang_admin', $plang_admin);
    $view->with('plang_front', $plang_front);
});

View::composer('package-acl::admin.user.*', function ($view) {
    //Load category
    $obj_category = new FoostartCategory();
    $params_department = $params_level = Request::all();

    $params_department['_key'] = $obj_category->getContextKeyByRef('user/department');
    $params_level['_key'] = $obj_category->getContextKeyByRef('user/level');

    $pluck_select_category_department = $obj_category->pluckSelect($params_department);
    $pluck_select_category_level = $obj_category->pluckSelect($params_level);

    $view->with('pluck_select_category_department', $pluck_select_category_department);
    $view->with('pluck_select_category_level', $pluck_select_category_level);
});

View::composer('package-acl::admin.permission.*', function ($view) {
    //Load category
    $obj_category = new FoostartCategory();
    $params = Request::all();
    $params['_key'] = $obj_category->getContextKeyByRef('admin/permissions');
    $pluck_select_category = $obj_category->pluckSelect($params);

    $view->with('pluck_select_category', $pluck_select_category);
});
/**
 * if the site uses gravatar for avatar handling
 */
View::composer(['package-acl::admin.user.profile', 'package-acl::admin.user.self-profile'], function ($view) {
    $view->with('use_gravatar', \Config::get('acl_config.use_gravatar'));
});

/*
  |-----------------------------------------------------------------------
  | Other data
  |-----------------------------------------------------------------------
  |
  |
 */
View::composer('package-acl::*', function ($view) use ($plang_admin, $plang_front) {
    //Order by
    $order_by = [
        'asc' => trans($plang_admin . '.order.by-asc'),
        'desc' => trans($plang_admin . '.order.by-desc'),
    ];
    $view->with('order_by', $order_by);
});
