<?php

use Foostart\Acl\Authentication\Classes\Menu\SentryMenuFactory;
use Foostart\Category\Helpers\FoostartCategory;

$plang_admin = 'acl-admin';
$plang_front = 'acl-front';
/**
 * menu items available depending on permissions
 */
View::composer('package-acl::admin.layouts.*', function ($view) {
    $menu_items = SentryMenuFactory::create()->getItemListAvailable();
    $view->with('menu_items', $menu_items);
});

/**
 * Dashboard sidebar
 */
View::composer(['package-acl::admin.dashboard.*'], function ($view) use ($plang_admin, $plang_front) {

    $view->with('sidebar_items', [
        trans($plang_admin . '.menu.dashboard') => [
            'url' => URL::route('dashboard.default'),
            'icon' => '<i class="fa fa-tachometer"></i>'
        ]
    ]);
});

/**
 * User sidebar
 */
View::composer([
    'package-acl::admin.user.edit',
    'package-acl::admin.user.groups',
    'package-acl::admin.user.list',
    'package-acl::admin.user.profile',
    'package-acl::admin.acl-lang',
    'package-acl::admin.acl-lang-backup',
        ], function ($view) use ($plang_admin, $plang_front) {

    $fooCategory = new FoostartCategory();
    $key_department = $fooCategory->getContextKeyByRef('user/department');
    $key_level = $fooCategory->getContextKeyByRef('user/level');
    $view->with('sidebar_items', [
        trans($plang_admin . '.sidebars.users-list') => [
            'url' => URL::route('users.list'),
            'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
        ],
        trans($plang_admin . '.sidebars.add-user') => [
            'url' => URL::route('users.edit'),
            'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
        ],
        trans($plang_admin . '.sidebars.user-department') => [
            'url' => URL::route('categories.list', ['_key=' . $key_department]),
            'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
        ],
        trans($plang_admin . '.sidebars.user-level') => [
            'url' => URL::route('categories.list', ['_key=' . $key_level]),
            'icon' => '<i class="fa fa-bars" aria-hidden="true"></i>'
        ],
        trans($plang_admin . '.sidebars.user-lang') => [
            'url' => URL::route('users.lang', []),
            'icon' => '<i class="fa fa-language" aria-hidden="true"></i>'
        ],
    ]);
});
/**
 *  Group sidebar
 */
View::composer(['package-acl::admin.group.*'], function ($view) use ($plang_admin, $plang_front) {
    $view->with('sidebar_items', [
        trans($plang_admin . '.sidebars.groups-list') => [
            'url' => URL::route('groups.list'),
            'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
        ],
        trans($plang_admin . '.sidebars.add-group') => [
            'url' => URL::route('groups.edit'),
            'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
        ]
    ]);
});
/**
 *  Permission sidebar
 */
View::composer(['package-acl::admin.permission.*'], function ($view) use ($plang_admin, $plang_front) {
    $fooCategory = new FoostartCategory();
    $key = $fooCategory->getContextKeyByRef('admin/permissions');
    $view->with('sidebar_items', [
        trans($plang_admin . '.sidebars.permissions-list') => [
            'url' => URL::route('permissions.list'),
            'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
        ],
        trans($plang_admin . '.sidebars.add-permission') => [
            'url' => URL::route('permissions.edit'),
            'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
        ],
        trans($plang_admin . '.sidebars.category') => [
            'url' => URL::route('categories.list', ['_key=' . $key]),
            'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
        ],
    ]);
});
