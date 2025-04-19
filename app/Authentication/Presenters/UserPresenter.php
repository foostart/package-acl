<?php namespace Foostart\Acl\Authentication\Presenters;
/**
 * Class UserPresenter
 *
 * @author Foostart foostart.com@gmail.com
 */

use Cartalyst\Sentry\Groups\Eloquent\Provider as GroupProvider;
use Cartalyst\Sentry\Hashing\NativeHasher;
use Cartalyst\Sentry\Throttling\Eloquent\Provider as ThrottleProvider;
use Cartalyst\Sentry\Users\Eloquent\Provider as UserProvider;
use Foostart\Acl\Authentication\Presenters\Traits\PermissionTrait;
use Foostart\Acl\Library\Presenters\AbstractPresenter;

class UserPresenter extends AbstractPresenter
{
    use PermissionTrait;
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->getThrottle();
    }

    /**
     * Get throttle user
     */
    public function getThrottle() {
        $user_id = $this->resource->id;
        $this->userProvider = new UserProvider(new NativeHasher);
        $this->groupProvider = new GroupProvider;
        $this->throttleProvider = new ThrottleProvider($this->userProvider);
        try {
            $throttle = $this->throttleProvider->findByUserId($user_id);
            if (!empty($throttle)) {
                $this->resource->suspended = $throttle->isSuspended();
            }
        } catch (\Throwable $e) {
            //User is not throttled
        }

    }
}
