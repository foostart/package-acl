<?php  namespace Foostart\Acl\Authentication\Validators;

use Foostart\Acl\Library\Validators\AbstractValidator;

class UserProfileUserValidator extends AbstractValidator{

    protected static $rules = array(
            "password" => ["confirmed", "min:6"],
    );
} 