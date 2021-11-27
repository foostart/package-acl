<?php namespace Foostart\Acl\Authentication\Validators;

use Event;
use Foostart\Acl\Library\Validators\AbstractValidator;

class PermissionValidator extends AbstractValidator
{
    protected static $rules = array(
        "name" => ["required", "max:255"],
        "permission" => ["required", "max:255"],
    );

    public function __construct()
    {
        Event::listen('validating', function ($input) {
            static::$rules["permission"][] = "unique:permission,permission,{$input['id']}";
        });
    }
}
