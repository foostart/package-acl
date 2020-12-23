<?php  namespace Foostart\Acl\Authentication\Models;

/**
 * Class ProfileTypeField
 *
 * @author Foostart foostart.com@gmail.com
 */
class ProfileFieldType extends BaseModel
{
    protected $table = "profile_field_type";

    protected $fillable = ["description"];

    public function profile_field()
    {
        return $this->hasMany('Foostart\Acl\Authentication\Models\ProfileField');
    }
} 