<?php namespace Foostart\Acl\Authentication\Validators;

use Event;
use Foostart\Acl\Library\Validators\AbstractValidator;

class GroupValidator  extends AbstractValidator
{
    protected static $rules = array(
        "name" => ["required"],
    );

    public function __construct()
    {
        Event::listen('validating', function($input)
        {
            static::$rules["name"][] = "unique:groups,name,{$input['id']}";
        });
    }
}