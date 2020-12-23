<?php  namespace Foostart\Acl\Authentication\Interfaces;
/**
 * Interface MenuCollectionInterface
 *
 * @author Foostart foostart.com@gmail.com
 */
interface MenuCollectionInterface
{
    /**
     * Obtain all the menu items
     * @return \Foostart\Acl\Authentication\Classes\MenuItem
     */
    public function getItemList();

    /**
     * Obtain the menu items that the current user can access
     * @return mixed
     */
    public function getItemListAvailable();

} 