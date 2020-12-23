<?php  namespace Foostart\Acl\Authentication\Repository\Interfaces;
/**
 * Interface UserProfileRepositoryInterface
 *
 * @author Foostart foostart.com@gmail.com
 */
interface UserProfileRepositoryInterface
{
    /**
     * Obtains the profile from the user_id
     * @param $user_id
     * @return mixed
     */
    public function getFromUserId($user_id);
}