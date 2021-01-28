<?php
use Foostart\Acl\Authentication\Helpers\FormHelper;

use Foostart\Category\Helpers\SortTable;

/*
|-----------------------------------------------------------------------
| Permissions
|-----------------------------------------------------------------------
|
*/
View::composer(['package-acl::admin.user.edit',
                'package-acl::admin.group.edit'], function ($view) {

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
View::composer(['package-acl::admin.user.list',
                'package-acl::admin.group.edit',
                'package-acl::admin.user.edit',
                'package-acl::admin.user.search'], function ($view){

    //List of groups
    $fh = new FormHelper();
    $values_group = $fh->getSelectValuesGroups();
    $view->with('group_values', $values_group);
});