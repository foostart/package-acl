<?php  namespace Foostart\Acl\Authentication\Models;
/**
 * Class Group
 *
 * @author Foostart foostart.com@gmail.com
 */
use Cartalyst\Sentry\Groups\Eloquent\Group as SentryGroup;

class Group extends SentryGroup
{
    protected $guarded = ["id"];

    protected $fillable = ["name", "permissions", "protected"];
} 