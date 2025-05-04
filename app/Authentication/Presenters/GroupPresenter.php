<?php namespace Foostart\Acl\Authentication\Presenters;
/**
 * Class GroupPresenter
 *
 * @author Foostart foostart.com@gmail.com
 */

use Foostart\Acl\Library\Presenters\AbstractPresenter;
use Foostart\Acl\Authentication\Presenters\Traits\PermissionTrait;

class GroupPresenter extends AbstractPresenter
{
    use PermissionTrait;
}
