<?php namespace Foostart\Acl\Authentication\Exceptions;
/**
 * Class PermissionException
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */

use Exception;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;

class PermissionException extends Exception implements JacopoExceptionsInterface {}