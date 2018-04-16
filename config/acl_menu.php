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
                /*
                 * the actual link associated to the menu item
                */
                "link"        => '/admin/users/list',
                /*
                 * the list of 'permission name' associated to the menu
                 * item: if the logged user has one or more of the permission
                 * in the list he can see the menu link and access the area
                 * associated with that.
                 * Every route that you create with the 'route' as a prefix
                 * will check for the permissions and throw a 401 error if the
                 * check fails (for example in this case every route named users.*)
                 */
                "permissions" => [$admin, '_user-editor', '_user-leader'],
                /*
                 * if there is any route that you want to skip for the permission check
                 * put it in this array
                 */
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
                "name"        => 'sample-admin.menus.top-menu',
                "route"       => "samples",
                "link"        => '/admin/samples/list',
                "permissions" => [$admin]
            ],
            //Posts
            [
                "name"        => 'post-admin.menus.top-menu',
                "route"       => "posts",
                "link"        => '/admin/posts',
                "permissions" => [$admin]
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