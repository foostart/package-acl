<?php namespace Foostart\Acl\Authentication\Exceptions;
/**
 * Class UseTokenMismatchExceptionrExistsException
 *
 * @author Foostart foostart.com@gmail.com
 */

use Exception;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;

class TokenMismatchException extends Exception implements JacopoExceptionsInterface {}