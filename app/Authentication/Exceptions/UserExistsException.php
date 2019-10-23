<?php namespace Foostart\Acl\Authentication\Exceptions;
/**
 * Class UserExistsException
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */

use Exception;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;

class UserExistsException extends Exception implements JacopoExceptionsInterface {}