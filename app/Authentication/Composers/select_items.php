<?php
use LaravelAcl\Authentication\Helpers\FormHelper;

use Foostart\Category\Helpers\SortTable;

/*
|-----------------------------------------------------------------------
| Permissions
|-----------------------------------------------------------------------
|
*/
View::composer(['laravel-authentication-acl::admin.user.edit',
                'laravel-authentication-acl::admin.group.edit'], function ($view) {

    $fh = new FormHelper();
    $values_permission = $fh->getSelectValuesPermission();
    $view->with('permission_values', $values_permission);

});


/*
|-----------------------------------------------------------------------
| Groups
|-----------------------------------------------------------------------
|
*/
View::composer(['laravel-authentication-acl::admin.user.list',
                'laravel-authentication-acl::admin.group.edit',
                'laravel-authentication-acl::admin.user.edit',
                'laravel-authentication-acl::admin.user.search'], function ($view){

    //List of groups
    $fh = new FormHelper();
    $values_group = $fh->getSelectValuesGroups();
    $view->with('group_values', $values_group);
});