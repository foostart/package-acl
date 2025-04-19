<?php

return [
    /***********************************************************************
     * |-----------------------------------------------------------------------
     * | MAIN MENU ADMIN
     * |-----------------------------------------------------------------------
     * | Top menu
     * |
     */
    'menu' => [
        'dashboard' => 'Dashboard',
        'users' => 'Users',
        'groups' => 'Groups',
        'permissions' => 'Permissions',
        'operations' => 'Operations',
        'contexts' => 'Contextes',
    ],


    /***********************************************************************
     * |-----------------------------------------------------------------------
     * | ORDERS
     * |-----------------------------------------------------------------------
     * |
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
     * |-----------------------------------------------------------------------
     * | BUTTONS
     * |-----------------------------------------------------------------------
     * | List of buttons
     * |
     */
    'buttons' => [
        'add' => 'Add',
        'reset' => 'Reset',
        'submit' => 'Submit',
        'delete' => 'Delete',
        'update-avatar' => 'Update avatar',
    ],


    /***********************************************************************
     * |-----------------------------------------------------------------------
     * | PAGES
     * |-----------------------------------------------------------------------
     * | User
     * | Permission
     * | Group
     * |
     * |
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
        'recovery-password' => 'Khôi phục mật khẩu',
        'login' => 'Internship',
        'title-register-complelete' => 'Registration completed',
        'title-password-recovery' => 'Khôi phục mật khẩu',
        'title-signup-email' => 'Registration request received',
        'title-signup-success' => 'Registration completed',

        'signup' => 'Signup',
        'change-password' => 'Chanage password',
        'change-password-success-title' => 'Change password success title',
        'home-page' => 'Login page',
    ],


    /***********************************************************************
     * |-----------------------------------------------------------------------
     * | SIDEBARDS
     * |-----------------------------------------------------------------------
     * | User
     * | Permission
     * | Group
     * |
     * |
     */
    'sidebars' => [
        'users-list' => 'Users list',
        'add-user' => 'Add user',
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
     * |-----------------------------------------------------------------------
     * | SEARCH FORM
     * |-----------------------------------------------------------------------
     * | User search
     * | Group search
     * | Permission search
     * |
     */
    'search' => [
        'user' => 'User search',
        'permission' => 'Permission search',
        'group' => 'Group search',
        'btn-reset' => 'Reset',
        'btn-submit' => 'Search',
        'btn-advance' => 'Advanced search',
    ],


    /***********************************************************************
     * |-----------------------------------------------------------------------
     * | LABLES
     * |-----------------------------------------------------------------------
     * | Elements in form
     * | Columns in table
     * |
     */
    'labels' => [
        'email' => 'Email',
        'first_name' => 'Họ lót',
        'last_name' => 'Tên',
        'full_name' => 'Full name',
        'active' => 'Active',
        'last_login' => 'Last login',
        'sorting' => 'Sorting',
        'sex' => 'Giới tính',
        'category' => 'Category',
        'code' => 'User code',
        'group' => 'Group',
        'permission-name' => 'Permission name',
        'login-data' => 'Login data',
        'password' => 'Password',
        'change-password' => 'Change password',
        'confirm_password' => 'Xác nhận lại mật khẩu',
        'confirm-change-password' => 'Confirm change password',
        'banned' => 'Banned',
        'user-profile' => 'User profile',
        'new-password' => 'Mật khẩu mới',
        'user-data' => 'User data',
        'edit-user' => 'Edit user',
        'phone' => 'Phone',
        'state' => 'State',
        'vat' => 'Vat',
        'city' => 'Thành phố',
        'country' => 'Country',
        'level' => 'Level',
        'address' => 'Địa chỉ',
        'custom-fields' => 'Custom fields',
        'change-avt' => 'Cập nhật ảnh đại diện',
        'update-avt' => 'Cập nhật',
        'avatar' => 'Ảnh đại diện',
        'description' => 'Description',
        'link-url' => 'Link URL',
        'overview' => 'Overview',
        'general-data' => 'General data',
        'group-name' => 'Group name',
        'title-backup' => 'Backups',
        'config' => 'Configurations',
        'filename' => 'File name',
        'order' => '#',
        'recovery-email' => 'Nhập email cần khôi phục mật khẩu',
        'captcha' => 'Captcha',
        'new_password' => 'Mật khẩu mới',
    ],


    /***********************************************************************
     * |-----------------------------------------------------------------------
     * | MESSAGES
     * |-----------------------------------------------------------------------
     * |
     */
    'messages' => [
        'message-last-login' => 'not logged yet.',
        'email-not-found' => 'Không tìm thấy email, vui lòng kiểm tra lại email khôi phục',
        'user-delete' => 'Are you sure to delete this item?',
        'permission-not-found' => 'No permissions found.',
        'empty-data' => 'Empty data',
        'change-password-success' => "Your password has been reset successfully.",
        'try-again' => 'Please try again',
        'token-valid' => 'Oops, something went wrong: the token is invalid',
        'email-valid' => 'Oops, something went wrong: the email is invalid',
        'register-success' => 'Congratulations, you successfully registered to',
        'following-link' => ' Your email has been confirmed. Now you can login to the website using the',
        'reminder-heading' => 'Khôi phục mật khẩu',
        'reminder-sent' => 'Hệ thống quản lý thực tập đã gửi thông tin khôi phục mật khẩu đến email đã đăng ký, vui lòng kiểm tra email và thực hiện.',
        'signup-email-heading' => 'Request received',
        'signup-email-info' => 'You account has been created. However, before you can use it you need to confirm your email address.<br/>
            We sent you a confirmation email, please check your inbox.',
        'signup-success-heading' => 'Congratulations, you successfully registered to',
        'signup-success-info' => 'Your user has been registered succesfully. Now you can login to the website using the ',
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
     * |-----------------------------------------------------------------------
     * | SORTING
     * |-----------------------------------------------------------------------
     * |
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
     * |-----------------------------------------------------------------------
     * | TABLE
     * |-----------------------------------------------------------------------
     * |User
     * |Group
     * |Pemission
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
        'category-slug' => 'Category Slug',
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
        'any' => 'Any',
        'order' => '#',
        'id' => 'ID',
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
        'recover' => 'Khôi phục',
        'register' => 'Register',
        'change_password' => 'Change password',
    ],


    /*
    |-----------------------------------------------------------------------
    | Error message
    |-----------------------------------------------------------------------
    | The list of error message
    |
    */
    'error' => [
        'login-error-failed' => 'The username or password entered is incorrect. Please try again',
        'login-error-required-field' => 'Login error required field',
        'login-error-not-active' => 'Login error not active',
        'login-error-required-password' => 'Login error required password',
        'login-error-many-attempts' => 'Login error many attempts',
    ],

];
