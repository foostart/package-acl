<?php

return [
    /***********************************************************************
     * |-----------------------------------------------------------------------
     * | Breadcrumbs
     * |-----------------------------------------------------------------------
     * | Top menu
     * |
     */
    'breadcrumbs' => [
        'admin' => 'Admin',
        'teacher' => 'Teacher',
        'view' => 'View',
        'diary' => 'Diary',
        'diary_edit' => 'Nhật ký thực tập',
        'edit_company' => 'Edit company',
        'internship' => 'Internship',
        'courses' => 'Courses',
        'course' => 'Course',
        'class' => 'Lớp học',
        'groups' => 'Groups',
        'edit' => 'Edit',
        'list' => 'List',
        'users' => 'Users',
        'sites' => 'Sites',
        'site' => 'Site',
        'permissions' => 'Permissions',
        'crawler' => 'Crawlers',
        'works' => 'Works',
        'work' => 'Work',
        'jobs' => 'Jobs',
        'job' => 'Job',
        'categories' => 'Categories',
        'category' => 'Category',
        'pattern' => 'Pattern',
        'pexcel' => 'Pexcel',
        'company' => 'Company',
        'forums' => 'Hỏi - đáp',
    ],

    /***********************************************************************
     * |-----------------------------------------------------------------------
     * | MAIN MENU ADMIN
     * |-----------------------------------------------------------------------
     * | Top menu
     * |
     */
    'menu' => [
        'dashboard' => 'Dashboard',
        'internship' => 'Internship',
        'course' => 'Course',
        'users' => 'Users',
        'groups' => 'Groups',
        'posts' => 'Posts',
        'sites' => 'Sites',
        'crawler_works' => 'Crawler works',
        'crawler_works_jobs' => 'Crawler Jobs',
        'permissions' => 'Permissions',
        'operations' => 'Operations',
        'contexts' => 'Contexts',
        'pexcel' => 'Pexcels',
        'company' => 'Company',
        'forum' => 'Q&A',
    ],


    /***********************************************************************
     * |-----------------------------------------------------------------------
     * | ORDERS
     * |-----------------------------------------------------------------------
     * |
     */
    'order' => [
        'name' => 'Order',
        'id' => 'ID',
        'no-selected' => 'No selected',
        'by-asc' => 'ASC',
        'by-desc' => 'DESC',
    ],

    'sex' => [
        1 => 'Female',
        2 => 'Male',
        3 => 'Other',
    ],
    'banned' => [
        1 => 'Yes',
        2 => 'No',
    ],
    'active' => [
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
        'trash' => 'Trash',
        'restore' => 'Restore',
        'edit-profile' => 'Edit profile',
        'upload-avatar' => 'Update avatar',
        'update-avatar' => 'Update avatar',
        'search' => 'Search',
        'save' => 'Save',
        'delete-in-trash' => 'Trash',
        'delete-forever' => 'Delete forever',
    ],


    /*
    |-----------------------------------------------------------------------
    | Hint
    |-----------------------------------------------------------------------
    | The list of hint
    |
    */
    'hint' => [
        'delete-forever' => 'Delete forever',
        'delete-in-trash' => 'Delete in trash',
        'deleted' => 'In trash',
        'available' => 'Available',
        'inactive' => 'Inactive'
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
        'upload-user' => 'Upload',
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
        'permission_keyword' => 'Keyword',
        'permission_name' => 'Tên quyền sử dụng',
        'permission_description' => 'Mô tả về quyền sử dụng',
        'diary_mon' => 'Email',
        'email' => 'Email',
        'start_date' => 'Ngày đầu tuần',
        'end_date' => 'Ngày cuối tuần',
        'first_name' => 'Họ lót',
        'last_name' => 'Tên',
        'full_name' => 'Full name',
        'active' => 'Active',
        'last_login' => 'Last login',
        'sorting' => 'Sorting',
        'sex' => 'Giới tính',
        'category' => 'Danh mục',
        'code' => 'User code',
        'group' => 'Group',
        'permission-name' => 'Permission name',
        'login-data' => 'Login data',
        'password' => 'Password',
        'change-password' => 'Change password',
        'confirm-password' => 'Xác nhận lại mật khẩu',
        'confirm-change-password' => 'Confirm change password',
        'banned' => 'Banned',
        'user-profile' => 'User profile',
        'new-password' => 'Mật khẩu mới',
        'user-data' => 'Thông tin tài khoản',
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
        'order' => 'Order',
        'id' => 'ID',
        'keyword' => 'Keyword',
        'counter' => '#',
    ],


    /***********************************************************************
     * |-----------------------------------------------------------------------
     * | MESSAGES
     * |-----------------------------------------------------------------------
     * |
     */
    'messages' => [
        'message-last-login' => 'not logged yet.',
        'user-delete' => 'Are you sure to delete this item?',
        'user-restore' => 'Are you sure to restore this item?',
        'permission-not-found' => 'No permissions found.',
        'empty-data' => 'Empty data',
        'captcha-error' => 'Captcha không đúng, vui lòng kiểm tra lại'
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
        'keyword' => 'Từ khóa',
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
     * | SORTING
     * |-----------------------------------------------------------------------
     * |
     */
    'errors' => [
        'has_errors' => 'Có lỗi xảy ra',
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
        'permission_description' => 'Permission description',
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
        'counters' => 'Có <b>:number</b> items',
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

];
