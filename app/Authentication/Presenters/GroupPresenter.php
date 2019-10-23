<?php  namespace Foostart\Acl\Authentication\Presenters;
/**
 * Class GroupPresenter
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */
use Foostart\Acl\Authentication\Presenters\Traits\PermissionTrait;
use Foostart\Acl\Library\Presenters\AbstractPresenter;

class GroupPresenter extends AbstractPresenter
{
    use PermissionTrait;
} 