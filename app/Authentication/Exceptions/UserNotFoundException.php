<?php namespace Foostart\Acl\Authentication\Exceptions;
/**
 * Class UserNotFoundException
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */

use Exception;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;

class UserNotFoundException extends Exception implements JacopoExceptionsInterface {}