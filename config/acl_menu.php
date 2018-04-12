<?php

$admin = '_superadmin';

$permissions = [
    'categories' => [
        'all' => '_category-editor',
        'list' => '_category-list',
        'edit' => '_category-edit',
        'delete' => '_category-delete',
        'add' => '_category-add',
        'external' => '_external',
    ]
];

return [
    /*
    |--------------------------------------------------------------------------
    | Admin panel menu items
    |--------------------------------------------------------------------------
    |
    | Here you can edit the items to show in the admin menu(on top of the page)
    |
    */
    "list" => [


            //Dashboard page
            [
                "name"        => "jacopo-admin.menu.dashboard",
                "route"       => "dashboard",
                "link"        => '/admin/users/dashboard',
                "permissions" => []
            ],

            /*
            |-----------------------------------------------------------------------
            | Admin permissions
            |-----------------------------------------------------------------------
            | 1. Users page
            | 2. Groups page
            | 3. Permissions page
            | 4. Categories
            |
            */


            //Users page
            [
                "name"        => "jacopo-admin.menu.users",
                "route"       => "users",
                "link"        => '/admin/users/list',
                "permissions" => [$admin, '_user-editor', '_user-leader'],
                "skip_permissions" => ["users.selfprofile.edit", "users.profile.edit", "users.profile.addfield", "users.profile.deletefield"]
            ],


            //Groups page
            [
                "name"        => "jacopo-admin.menu.groups",
                "route"       => "groups",
                "link"        => '/admin/groups/list',
                "permissions" => [$admin, "_group-editor"]
            ],


            //Permissions page
            [
                "name"        => "jacopo-admin.menu.permissions",
                "route"       => "permissions",
                "link"        => '/admin/permissions/list',
                "permissions" => [$admin, "_permission-editor"]
            ],

            //Contexts
            [

                'name'        => 'category-admin.menus.top-menu-contexts',
                "route"       => "contexts",
                "link"        => '/admin/contexts/list',
                "permissions" => [$admin]
            ],

            //Categories
            [
                "route"       => "category-admin.menus.top-menu",
                "link"        => '/admin/categories/list',
                "permissions" => [$admin, '_user-editor']
            ],

            //Samples
            [
                "name"        => 'jacopo-admin.menu.samples',
                "route"       => "samples",
                "link"        => '/admin/samples/list',
                "permissions" => [$admin]
            ],
            //Posts
            [
                "name"        => 'jacopo-admin.menu.posts',
                "route"       => "posts",
                "link"        => '/admin/posts',
                "permissions" => [$admin]
            ],
            //Slideshow
            [
                "name"        => 'jacopo-admin.menu.slideshow',
                "route"       => "slideshows",
                "link"        => '/admin/slideshows',
                "permissions" => [$admin]
            ],
    ]
];