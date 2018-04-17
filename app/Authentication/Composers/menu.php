<?php
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;

use Foostart\Category\Helpers\FooCategory;

/**
 * menu items available depending on permissions
 */
View::composer('laravel-authentication-acl::admin.layouts.*', function ($view)
{
    $menu_items = SentryMenuFactory::create()->getItemListAvailable();
    $view->with('menu_items', $menu_items);
});

/**
 * Dashboard sidebar
 */
View::composer(['laravel-authentication-acl::admin.dashboard.*'], function ($view)
{
    $view->with('sidebar_items', [
            trans('jacopo-admin.menu.dashboard') => [
                    'url'  => URL::route('dashboard.default'),
                    'icon' => '<i class="fa fa-tachometer"></i>'
            ]
    ]);
});

/**
 * User sidebar
 */
View::composer([
                       'laravel-authentication-acl::admin.user.edit',
                       'laravel-authentication-acl::admin.user.groups',
                       'laravel-authentication-acl::admin.user.list',
                       'laravel-authentication-acl::admin.user.profile',
                       'laravel-authentication-acl::admin.acl-lang',
                       'laravel-authentication-acl::admin.acl-lang-backup',
               ], function ($view)
{

    $fooCategory = new FooCategory();
    $key_department = $fooCategory->getContextKeyByRef('user/department');
    $key_level = $fooCategory->getContextKeyByRef('user/level');
    $view->with('sidebar_items', [
            trans('jacopo-admin.sidebars.users-list') => [
                    'url'  => URL::route('users.list'),
                    'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('jacopo-admin.sidebars.add-user')   => [
                    'url'  => URL::route('users.edit'),
                    'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            ],
            trans('jacopo-admin.sidebars.user-department')   => [
                    'url'  => URL::route('categories.list',['_key='.$key_department]),
                    'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
            ],
            trans('jacopo-admin.sidebars.user-level')   => [
                    'url'  => URL::route('categories.list',['_key='.$key_level]),
                    'icon' => '<i class="fa fa-bars" aria-hidden="true"></i>'
            ],
            trans('jacopo-admin.sidebars.user-lang')   => [
                    'url'  => URL::route('users.lang',[]),
                    'icon' => '<i class="fa fa-language" aria-hidden="true"></i>'
            ],
     ]);
});
/**
 *  Group sidebar
 */
View::composer(['laravel-authentication-acl::admin.group.*'], function ($view)
{
    $view->with('sidebar_items', [
            trans('jacopo-admin.sidebars.groups-list') => [
                    'url'  => URL::route('groups.list'),
                    'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('jacopo-admin.sidebars.add-group')   => [
                    'url'  => URL::route('groups.edit'),
                    'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            ]
    ]);
});
/**
 *  Permission sidebar
 */
View::composer(['laravel-authentication-acl::admin.permission.*'], function ($view)
{
    $fooCategory = new FooCategory();
    $key = $fooCategory->getContextKeyByRef('admin/permissions');
    $view->with('sidebar_items', [
            trans('jacopo-admin.sidebars.permissions-list') => [
                    'url'  => URL::route('permissions.list'),
                    'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('jacopo-admin.sidebars.add-permission')   => [
                    'url'  => URL::route('permissions.edit'),
                    'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            ],
            trans('jacopo-admin.sidebars.category')   => [
                    'url'  => URL::route('categories.list',['_key='.$key]),
                    'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
            ],

    ]);
});