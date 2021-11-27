<?php

use Illuminate\Session\TokenMismatchException;

/*
  |--------------------------------------------------------------------------
  | Public side (no auth required)
  |--------------------------------------------------------------------------
  |
*/

/**
 * User login and logout
 */
Route::group(['middleware' => ['web']], function () {
    // by Facebook, Google
    Route::get('login/google', [
        'as' => 'user.login.google',
        'uses' => 'Foostart\Acl\Authentication\Controllers\LoginController@redirectToProvider',
    ]);
    Route::get('login/google/callback', [
        'as' => 'user.login.google.callback',
        'uses' => 'Foostart\Acl\Authentication\Controllers\LoginController@handleProviderCallback',
    ]);

    Route::get('/admin/login', [
        "as" => "user.admin.login",
        "uses" => 'Foostart\Acl\Authentication\Controllers\AuthController@getAdminLogin'
    ]);
    Route::get('/login', [
        "as" => "user.login",
        "uses" => 'Foostart\Acl\Authentication\Controllers\AuthController@getClientLogin'
    ]);
    Route::get('/user/logout', [
        "as" => "user.logout",
        "uses" => 'Foostart\Acl\Authentication\Controllers\AuthController@getLogout'
    ]);
    Route::post('/user/login', [
        "uses" => 'Foostart\Acl\Authentication\Controllers\AuthController@postAdminLogin',
        "as" => "user.login.process"
    ]);
    Route::post('/login', [
        "uses" => 'Foostart\Acl\Authentication\Controllers\AuthController@postClientLogin',
        "as" => "user.login"
    ]);

    /**
     * Password recovery
     */
    Route::get('/user/change-password', [
        "as" => "user.change-password",
        "uses" => 'Foostart\Acl\Authentication\Controllers\AuthController@getChangePassword'
    ])->middleware(['can_see']);

    Route::get('/user/recovery-password', [
        "as" => "user.recovery-password",
        "uses" => 'Foostart\Acl\Authentication\Controllers\AuthController@getReminder'
    ]);
    Route::post('/user/change-password/', [
        'uses' => 'Foostart\Acl\Authentication\Controllers\AuthController@postChangePassword',
        "as" => "user.reminder.process"
    ]);

    Route::get('/user/change-password-success', [
            "uses" => function () {
                return view('package-acl::client.auth.change-password-success');
            },
            "as" => "user.change-password-success"
        ]
    );
    Route::post('/user/reminder', [
        'uses' => 'Foostart\Acl\Authentication\Controllers\AuthController@postReminder',
        "as" => "user.reminder"
    ]);
    Route::get('/user/reminder-success', [
        "uses" => function () {
            return view('package-acl::client.auth.reminder-success');
        },
        "as" => "user.reminder-success"
    ]);

    /**
     * User signup
     */
    Route::post('/user/signup', [
        'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@postSignup',
        "as" => "user.signup.process"
    ]);
    Route::get('/user/signup', [
        'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@signup',
        "as" => "user.signup"
    ]);
    Route::post('captcha-ajax', [
        "before" => "captcha-ajax",
        'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@refreshCaptcha',
        "as" => "user.captcha-ajax.process"
    ]);
    Route::get('/user/email-confirmation', [
        'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@emailConfirmation',
        "as" => "user.email-confirmation"
    ]);
    Route::get('/user/signup-success', [
        "uses" => 'Foostart\Acl\Authentication\Controllers\UserController@signupSuccess',
        "as" => "user.signup-success"
    ]);

    /*
      |--------------------------------------------------------------------------
      | Admin side (auth required)
      |--------------------------------------------------------------------------
      |
      */
    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {
        /**
         * dashboard
         */
        Route::get('/admin/users/dashboard', [
            'as' => 'dashboard.default',
            'uses' => 'Foostart\Acl\Authentication\Controllers\DashboardController@base'
        ]);
        Route::get('/admin/users', [
            'as' => 'dashboard.default',
            'uses' => 'Foostart\Acl\Authentication\Controllers\DashboardController@base'
        ]);
        Route::get('/admin', [
            'as' => 'admin.home',
            'uses' => 'Foostart\Acl\Authentication\Controllers\DashboardController@base'
        ]);

        /**
         * user
         */
        Route::get('/admin/users', [
            'as' => 'users.list',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@getList'
        ]);
        Route::get('/admin/users/edit', [
            'as' => 'users.edit',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@editUser'
        ]);
        Route::post('/admin/users/edit', [
            'as' => 'users.edit',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@postEditUser'
        ]);
        Route::get('/admin/users/delete', [
            'as' => 'users.delete',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@deleteUser'
        ]);
        Route::get('/admin/users/restore', [
            'as' => 'users.restore',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@restoreUser'
        ]);
        Route::post('/admin/users/groups/add', [
            'as' => 'users.groups.add',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@addGroup'
        ]);
        Route::post('/admin/users/groups/delete', [
            'as' => 'users.groups.delete',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@deleteGroup'
        ]);

        Route::post('/admin/users/editpermission', [
            'as' => 'users.edit.permission',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@editPermission'
        ]);
        Route::get('/admin/users/profile/edit', [
            'as' => 'users.profile.edit',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@editProfile'
        ]);
        Route::post('/admin/users/profile/edit', [
            'as' => 'users.profile.edit',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@postEditProfile'
        ]);
        Route::post('/admin/users/profile/addField', [
            'as' => 'users.profile.addfield',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@addCustomFieldType'
        ]);
        Route::post('/admin/users/profile/deleteField', [
            'as' => 'users.profile.deletefield',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@deleteCustomFieldType'
        ]);
        Route::post('/admin/users/profile/avatar', [
            'as' => 'users.profile.changeavatar',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@changeAvatar'
        ]);
        Route::post('/admin/users/profile/selfavatar', [
            'as' => 'users.profile.changeselfavatar',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@changeSelfAvatar'
        ]);
        Route::get('/admin/users/profile/self', [
            'as' => 'users.selfprofile.edit',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@editOwnProfile'
        ]);

        Route::get('/admin/users/lang', [
            'as' => 'users.lang',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@lang'
        ]);

        Route::post('/admin/users/lang', [
            'as' => 'users.lang',
            'uses' => 'Foostart\Acl\Authentication\Controllers\UserController@lang'
        ]);

        /**
         * groups
         */
        Route::get('/admin/groups', [
            'as' => 'groups.list',
            'uses' => 'Foostart\Acl\Authentication\Controllers\GroupController@getList'
        ]);
        Route::get('/admin/groups/edit', [
            'as' => 'groups.edit',
            'uses' => 'Foostart\Acl\Authentication\Controllers\GroupController@editGroup'
        ]);
        Route::post('/admin/groups/edit', [
            'as' => 'groups.edit',
            'uses' => 'Foostart\Acl\Authentication\Controllers\GroupController@postEditGroup'
        ]);
        Route::get('/admin/groups/delete', [
            'as' => 'groups.delete',
            'uses' => 'Foostart\Acl\Authentication\Controllers\GroupController@deleteGroup'
        ]);
        Route::get('/admin/groups/restore', [
            'as' => 'groups.restore',
            'uses' => 'Foostart\Acl\Authentication\Controllers\GroupController@restoreGroup'
        ]);
        Route::post('/admin/groups/editpermission', [
            'as' => 'groups.edit.permission',
            'uses' => 'Foostart\Acl\Authentication\Controllers\GroupController@editPermission'
        ]);

        /**
         * permissions
         */
        Route::get('/admin/permissions', [
            'as' => 'permissions.list',
            'uses' => 'Foostart\Acl\Authentication\Controllers\PermissionController@getList'
        ]);
        Route::get('/admin/permissions/edit', [
            'as' => 'permissions.edit',
            'uses' => 'Foostart\Acl\Authentication\Controllers\PermissionController@editPermission'
        ]);
        Route::post('/admin/permissions/edit', [
            'as' => 'permissions.edit',
            'uses' => 'Foostart\Acl\Authentication\Controllers\PermissionController@postEditPermission'
        ]);
        Route::get('/admin/permissions/delete', [
            'as' => 'permissions.delete',
            'uses' => 'Foostart\Acl\Authentication\Controllers\PermissionController@deletePermission'
        ]);
        Route::get('/admin/permissions/restore', [
            'as' => 'permissions.restore',
            'uses' => 'Foostart\Acl\Authentication\Controllers\PermissionController@restorePermission'
        ]);
    });
});

//////////////////// Automatic error handling //////////////////////////
//if(Config::get('acl_base.handle_errors'))
//{
//    App::error(function (RuntimeException $exception, $code)
//    {
//        switch($code)
//        {
//            case '404':
//                return view('package-acl::client.exceptions.404');
//                break;
//            case '401':
//                return view('package-acl::client.exceptions.401');
//                break;
//            case '500':
//                return view('package-acl::client.exceptions.500');
//                break;
//        }
//    });
//    App::error(function (TokenMismatchException $exception)
//    {
//        return view('package-acl::client.exceptions.500');
//    });
//}
