<?php  namespace Foostart\Acl\Authentication\Classes\CustomProfile;
/**
 * Class customProfileFormHelper
 *
 * @author Foostart foostart.com@gmail.com
 */
class customProfileFormHelper 
{
    protected $custom_profile_repository;

    public function __construct($custom_profile = null)
    {
        $this->custom_profile_repository = $custom_profile ? $custom_profile : new CustomProfileRepository();
    }
    
} 