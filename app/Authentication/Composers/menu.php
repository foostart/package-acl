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
            trans('jacopo-admin.dashboard') => [
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
               ], function ($view)
{

    $fooCategory = new FooCategory();
    $key = $fooCategory->getContextKey('user/department');
    $view->with('sidebar_items', [
            trans('jacopo-admin.users-list') => [
                    'url'  => URL::route('users.list'),
                    'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('jacopo-admin.add-user')   => [
                    'url'  => URL::route('users.edit'),
                    'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            ],
            trans('jacopo-admin.user-department')   => [
                    'url'  => URL::route('categories.list',['_key='.$key]),
                    'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
            ],
    ]);
});
/**
 *  Group sidebar
 */
View::composer(['laravel-authentication-acl::admin.group.*'], function ($view)
{
    $view->with('sidebar_items', [
            trans('jacopo-admin.groups-list') => [
                    'url'  => URL::route('groups.list'),
                    'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('jacopo-admin.add-group')   => [
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
    $key = $fooCategory->getContextKey('admin/permissions');
    $view->with('sidebar_items', [
            trans('jacopo-admin.permissions-list') => [
                    'url'  => URL::route('permissions.list'),
                    'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('jacopo-admin.add-permission')   => [
                    'url'  => URL::route('permissions.edit'),
                    'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            ],
            trans('jacopo-admin.category')   => [
                    'url'  => URL::route('categories.list',['_key='.$key]),
                    'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
            ],

    ]);
});