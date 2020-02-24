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
                "name"        => "acl-admin.menu.dashboard",
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
                "name"        => "acl-admin.menu.users",
                "route"       => "users",
                "link"        => '/admin/users/list',
                "permissions" => [$admin, '_user-editor', '_user-leader'],
                "skip_permissions" => ["users.selfprofile.edit", "users.profile.edit", "users.profile.addfield", "users.profile.deletefield"]
            ],


            //Groups page
            [
                "name"        => "acl-admin.menu.groups",
                "route"       => "groups",
                "link"        => '/admin/groups/list',
                "permissions" => [$admin, "_group-editor"]
            ],


            //Permissions page
            [
                "name"        => "acl-admin.menu.permissions",
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

            //Posts
            [
                "name"        => 'post-admin.menus.top-menu',
                "route"       => "posts",
                "link"        => '/admin/posts',
                "permissions" => [$admin, "_rule"]
            ],
            //Slideshow
            [
                "name"        => 'slideshow-admin.menus.top-menu',
                "route"       => "slideshows",
                "link"        => '/admin/slideshows',
                "permissions" => [$admin]
            ],
    ]
];