<?php

return [
        /***********************************************************************
        |-----------------------------------------------------------------------
        | MAIN MENU ADMIN
        |-----------------------------------------------------------------------
        | Top menu
        |
        */
        'menu' => [
            'dashboard' => 'Dashboard',
            'users' => 'Users',
            'groups' => 'Groups',
            'permissions' => 'Permissions',
            'operations' => 'Operations',
            'contexts'  => 'Contextes',
            'samples'   => 'Samples',
            'slideshow' => 'SlideShow',
            'posts'     => 'Posts',
        ],






        /***********************************************************************
        |-----------------------------------------------------------------------
        | ORDERS
        |-----------------------------------------------------------------------
        |
        */
        'order' => [
            'name' => 'Order',
            'no-selected' => 'No selected',
            'by-asc' => 'ASC',
            'by-desc' => 'DESC',
        ],





        /***********************************************************************
        |-----------------------------------------------------------------------
        | BUTTONS
        |-----------------------------------------------------------------------
        | List of buttons
        |
        */
        'buttons' => [
            'add' => 'Add',
            'reset' => 'Reset',
            'submit'=> 'Submit',
            'delete' => 'Delete',
        ],





        /***********************************************************************
        |-----------------------------------------------------------------------
        | PAGES
        |-----------------------------------------------------------------------
        | User
        | Permission
        | Group
        |
        |
        */

        'pages' => [
            'user-list' => 'List of users',
            'user-edit' => 'Edit user page',
            'permission-list' => 'List of permissions',
            'permission-edit' => 'Edit permission page',
            'group-edit' => 'Edit group page',
        ],





        /***********************************************************************
        |-----------------------------------------------------------------------
        | SIDEBARDS
        |-----------------------------------------------------------------------
        | User
        | Permission
        | Group
        |
        |
        */
        'sidebars' => [
            'users-list' => 'Users list',
            'add-user'  => 'Add user',
            'groups-list' => 'List of groups',
            'add-group' => 'Add group',
            'users-search' => 'Users search',
            'user-add-new' => 'Add user',
            'user-department' => 'Department',
            'permissions-list' => 'List of permissions',
            'add-permission' => 'Add permission',
            'category' => 'Category',
        ],





        /***********************************************************************
        |-----------------------------------------------------------------------
        | SEARCH FORM
        |-----------------------------------------------------------------------
        | User search
        | Group search
        | Permission search
        |
        */
        'search' => [
            'user' => 'User search',
            'permission' => 'Permission search',
            'group' => 'Group search',
            'btn-reset'     => 'Reset',
            'btn-submit'     => 'Search',
            'btn-advance' => 'Search advance',
        ],


        /***********************************************************************
        |-----------------------------------------------------------------------
        | LABLES
        |-----------------------------------------------------------------------
        | Elements in form
        | Columns in table
        |
        */
        'labels' => [
            'email' => 'Email',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'full-name' => 'Full name',
            'active' => 'Active',
            'last_login' => 'Last login',
            'sorting' => 'Sorting',
        ],





        /***********************************************************************
        |-----------------------------------------------------------------------
        | MESSAGES
        |-----------------------------------------------------------------------
        |
        */
        'messages' => [
            'message-last-login' => 'not logged yet.',
            'user-delete' => 'Are you sure to delete this item?',
        ],




    
        /*
        |-----------------------------------------------------------------------
        | FORM
        |-----------------------------------------------------------------------
        | All the elements in form
        |
        |
        |
        */
        'form' => [
            'any' => 'Any',
        ],
        'banned' => [
            'yes' => 'Yes',
            'no' => 'No',
            'any' => 'Any',
        ],
        



        
        /***********************************************************************
        |-----------------------------------------------------------------------
        | SORTING
        |-----------------------------------------------------------------------
        |
        */
        'sortings' => [
            'group-name' => 'Group name',
            'group-permissions' => 'Permissions',
            'permission-description' => 'Description',
            'permission-code' => 'Permission code',
            'permission-name' => 'Permission name',
            'permission-url' => 'URL',
        ],
                



        
        /***********************************************************************
        |-----------------------------------------------------------------------
        | TABLE
        |-----------------------------------------------------------------------
        |User
        |Group
        |Pemission
        */
        'tables' => [
            'permission-description' => 'Description',
            'permission-code' => 'Permission code',
            'permission-name' => 'Permission name',
            'permission-url' => 'URL',
            'group-name' => 'Group name',
            'group-permissions' => 'Permissions',
        ],
];
