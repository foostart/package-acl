<?php namespace Foostart\Acl\Authentication\Exceptions;
/**
 * Class UserNotFoundException
 *
 * @author Foostart foostart.com@gmail.com
 */

use Exception;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;

class UserNotFoundException extends Exception implements JacopoExceptionsInterface {}