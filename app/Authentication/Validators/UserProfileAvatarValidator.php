<?php  namespace Foostart\Acl\Authentication\Validators;

use Foostart\Acl\Library\Validators\AbstractValidator;

/**
 * Class UserProfileAvatarValidator
 *
 * @author Foostart foostart.com@gmail.com
 */
class UserProfileAvatarValidator extends AbstractValidator
{
    protected static $rules = [
        "avatar" => ['image','required', 'max:4000']
    ];
} 