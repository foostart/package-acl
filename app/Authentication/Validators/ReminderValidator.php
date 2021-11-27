<?php namespace Foostart\Acl\Authentication\Validators;

use Foostart\Acl\Library\Validators\AbstractValidator;

class ReminderValidator extends AbstractValidator
{
    protected static $rules = array(
        "password" => ["required", "min:6"],
    );
}