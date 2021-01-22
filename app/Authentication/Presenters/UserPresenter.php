<?php  namespace Foostart\Acl\Authentication\Presenters;
/**
 * Class UserPresenter
 *
 * @author Foostart foostart.com@gmail.com
 */
use Foostart\Acl\Authentication\Presenters\Traits\PermissionTrait;
use Foostart\Acl\Library\Presenters\AbstractPresenter;

class UserPresenter extends AbstractPresenter
{
    use PermissionTrait;
} 