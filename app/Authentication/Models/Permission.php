<?php namespace Foostart\Acl\Authentication\Models;
/**
 * Class Permission
 *
 * @author Foostart foostart.com@gmail.com
 */
class Permission extends BaseModel
{
    protected $table = "permission";

    protected $fillable = [
        'category_id',
        'name',
        "permission",
        "protected",
        'description',
    ];

    protected $guarded = ["id"];

    /**
     * Prepend a prefix for  permission mainly to force it to
     * associative array for Sentry
     * @param $value
     */
    public function setPermissionAttribute($value)
    {
        if (!empty($value)) $this->attributes["permission"] = ($value[0] != "_") ? "_{$value}" : $value;
    }
}
