<?php namespace Foostart\Acl\Authentication\Exceptions;
/**
 * Class ProfileNotFoundException
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */

use Exception;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;

class ProfileNotFoundException extends Exception implements JacopoExceptionsInterface {}