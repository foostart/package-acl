<?php namespace Foostart\Acl\Authentication\Exceptions;
/**
 * Class PermissionException
 *
 * @author Foostart foostart.com@gmail.com
 */

use Exception;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;

class PermissionException extends Exception implements JacopoExceptionsInterface {}