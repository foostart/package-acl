<?php namespace Foostart\Acl\Authentication\Exceptions;
/**
 * Class ProfileNotFoundException
 *
 * @author Foostart foostart.com@gmail.com
 */

use Exception;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;

class ProfileNotFoundException extends Exception implements JacopoExceptionsInterface {}