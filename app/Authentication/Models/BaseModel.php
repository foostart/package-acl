<?php namespace Foostart\Acl\Authentication\Models;
/**
 * Class BaseModel
 *
 * @author Foostart foostart.com@gmail.com
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;
}
