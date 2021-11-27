<?php namespace Foostart\Acl\Authentication\Repository\Interfaces;
/**
 * Interface UserRepositoryInterface
 *
 * @author Foostart foostart.com@gmail.com
 */
interface UserRepositoryInterface
{

    /**
     * Activates a user
     * @param integer id
     * @return mixed
     */
    public function activate($id);

    /**
     * @param $group_id
     * @param $user_id
     * @return mixed
     */
    public function addGroup($user_id, $group_id);

    /**
     * @param $group_id
     * @param $user_id
     * @return mixed
     */
    public function removeGroup($user_id, $group_id);

}
