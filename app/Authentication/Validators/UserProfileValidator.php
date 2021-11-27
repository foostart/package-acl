<?php namespace Foostart\Acl\Authentication\Validators;

use Event;
use Foostart\Acl\Library\Validators\AbstractValidator;

class UserProfileValidator extends AbstractValidator
{
    protected static $rules = array(
        "first_name" => "max:50",
        "last_name" => "max:50",
        "code" => "max:25",
        "phone" => "max:20",
        "vat" => "max:20",
        "state" => "max:20",
        "city" => "max:50",
        "country" => "max:50",
        "sex" => "max:1",
        "address" => "max:100",
        'category_id' => 'max:99999',
    );
}