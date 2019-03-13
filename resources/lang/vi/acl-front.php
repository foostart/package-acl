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

        'sex' => [
           0 => 'Any',
           1 => 'Female',
           2 => 'Male',
           3 => 'Other',
        ],
        'banned' => [
            0 => 'Any',
            1 => 'Yes',
            2 => 'No',
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
            'update-avatar' => 'Update avatar',
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
            'user-edit-profile' => 'Edit user page',
            'permission-list' => 'List of permissions',
            'permission-edit' => 'Edit permission page',
            'group-list' => 'List of groups',
            'group-edit' => 'Edit group page',

            'title-config' => 'Current configurations',
            'title-lang' => 'Manage languages',
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
            'user-level' => 'Level',
            'user-language' => 'Language',
            'permissions-list' => 'List of permissions',
            'add-permission' => 'Add permission',
            'category' => 'Category',
            'user-lang' => 'Languages',
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
            'full_name' => 'Full name',
            'active' => 'Active',
            'last_login' => 'Last login',
            'sorting' => 'Sorting',
            'sex'       => 'Sex',
            'category'  => 'Category',
            'code'  => 'User code',
            'group' => 'Group',
            'permission-name'    => 'Permission name',
            'login-data'    => 'Login data',
            'password'     => 'Password',
            'change-password'     => 'Change password',
            'confirm-password'     => 'Confirm password',
            'confirm-change-password'   => 'Confirm change password',
            'banned'    => 'Banned',
            'user-profile'  => 'User profile',
            'new-password'  => 'New password',
            'user-data' => 'User data',
            'edit-user' => 'Edit user',
            'phone' => 'Phone',
            'state' => 'State',
            'vat'   => 'Vat',
            'city'  => 'City',
            'country'   => 'Country',
            'level'     => 'Level',
            'address'   => 'Address',
            'custom-fields' => 'Custom fields',
            'change-avt'   => 'Change avatar',
            'update-avt'    => 'Update avatar',
            'avatar'         => 'Avatar',
            'description'   => 'Description',
            'link-url'      => 'Link URL',
            'overview'      => 'Overview',
            'general-data'  => 'General data',
            'group-name' => 'Group name',
            'title-backup' => 'Backups',
            'config' => 'Configurations',
            'filename' => 'File name',
            'order' => '#',
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
            'permission-not-found'  => 'No permissions found.',
            'empty-data'        => 'Empty data',
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





    /*
    |-----------------------------------------------------------------------
    | Description
    |-----------------------------------------------------------------------
    | Description
    |
    */
    'descriptions' => [
        'category-form' => 'Category form',
        'overview' => '<p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>',
        'description' => '<p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>',
        'context-form' => 'Context form',
        'update' => 'Update category',
        'category-name' => '<p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>',
        'category' => '<p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>',
        'list' => 'List of items',
        'counters' => 'There are <b>:number</b> items',
        'counter' => 'There is <b>:number</b> item',
        'not-found' => 'Not found items',
        'config' => 'List of configurations',
        'lang' => 'List of languages',
        'category-slug' =>'Category Slug',
        'context-name' => '<p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>',
        'context-ref' => '<p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>',
        'context-key' => '<p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>',
        'context-status' => '<p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>',
        'status' => '<p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>',
    ],





    /*
    |-----------------------------------------------------------------------
    | Table column
    |-----------------------------------------------------------------------
    | The list of columns in table
    |
    */
    'columns' => [
        'any'   => 'Any',
        'order' => '#',
        'id'    => 'ID',
        'user-full-name' => 'User full name',
        'operations' => 'Operations',
        'updated_at' => 'Updated at',
        'filename' => 'File name',
        'context-ref' => 'Ref',
        'context-status' => 'Status',
        'key' => 'Key',
        'status' => 'Status',
    ],





    /*
    |-----------------------------------------------------------------------
    | Button
    |-----------------------------------------------------------------------
    | The list of buttons
    |
    */
    'buttons' => [
        'search' => 'Search',
        'reset' => 'Resest',
        'add' => 'Add',
        'save' => 'Save',
        'delete' => 'Delete',
    ],





    /*
    |-----------------------------------------------------------------------
    | Error message
    |-----------------------------------------------------------------------
    | The list of error message
    |
    */
    'error' => [
        'login-failed' => 'The username or password entered is incorrect. Please try again',
    ],

];
