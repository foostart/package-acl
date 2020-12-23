<?php namespace Foostart\Acl\Authentication\Exceptions;
/**
 * Class AuthenticationErrorException
 *
 * @author Foostart foostart.com@gmail.com
 */

use Exception;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;

class AuthenticationErrorException extends Exception implements JacopoExceptionsInterface {}