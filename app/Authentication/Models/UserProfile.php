<?php  namespace Foostart\Acl\Authentication\Models;

use Foostart\Acl\Authentication\Presenters\UserProfilePresenter;

/**
 * Class UserProfile
 *
 * @author Foostart foostart.com@gmail.com
 */

class UserProfile extends BaseModel
{
    protected $table = "user_profile";

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'vat',
        'state',
        'city',
        'country',
        'code',
        'address',
        'avatar',
        'sex',
        'category_id',
        'level_id',
    ];
    protected $context_key;
    
    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo('Foostart\Acl\Authentication\Models\User', "user_id");
    }

    public function profile_field()
    {
        return $this->hasMany('Foostart\Acl\Authentication\Models\ProfileField');
    }

    public function getAvatarAttribute()
    {
        return isset($this->attributes['avatar']) ? base64_encode($this->attributes['avatar']) : null;
    }

    public function presenter()
    {
        return new UserProfilePresenter($this);
    }
}