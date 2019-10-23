<?php namespace Foostart\Acl\Authentication\Exceptions;
/**
 * Class AuthenticationErrorException
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */

use Exception;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;

class AuthenticationErrorException extends Exception implements JacopoExceptionsInterface {}