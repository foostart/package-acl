<?php namespace Foostart\Acl\Authentication\Repository;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Foostart\Acl\Authentication\Classes\Images\ImageHelperTrait;
use Foostart\Acl\Authentication\Exceptions\UserNotFoundException;
use Foostart\Acl\Authentication\Exceptions\ProfileNotFoundException;
use Foostart\Acl\Authentication\Models\User;
use Foostart\Acl\Authentication\Models\UserProfile;
use Foostart\Acl\Authentication\Repository\Interfaces\UserProfileRepositoryInterface;
use Foostart\Acl\Library\Repository\EloquentBaseRepository;
use Foostart\Acl\Library\Repository\Interfaces\BaseRepositoryInterface;

/**
 * Class EloquentUserProfileRepository
 *
 * @author Foostart foostart.com@gmail.com
 */
class EloquentUserProfileRepository extends EloquentBaseRepository implements UserProfileRepositoryInterface
{
    use ImageHelperTrait;

    /**
     * We use the user profile as a model
     */
    public function __construct()
    {
        return parent::__construct(new UserProfile);
    }

    public function getFromUserId($user_id)
    {
        // checks if the user exists
        try {
            User::findOrFail($user_id);
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException;
        }
        // gets the profile
        $profile = $this->model->where('user_id', '=', $user_id)
            ->get();

        // check if the profile exists
        if ($profile->isEmpty()) throw new ProfileNotFoundException;

        return $profile->first();
    }

    public function updateAvatar($id, $input_name = "avatar")
    {
        $model = $this->find($id);
        $model->update([
            "avatar" => static::getBinaryData('170', $input_name)
        ]);
    }

    /**
     * Create user profile
     * @param $user
     * @return mixed|void
     */
    public function attachEmptyProfile($user)
    {
        // Check existing user
        if ($this->hasAlreadyAnUserProfile($user)) return;
        $user_profile = [];
        // User id
        if (!empty($user->id)) {
            $user_profile['user_id'] = $user->id;
        }
        // First name
        if (!empty($user->first_name)) {
            $user_profile['first_name'] = $user->first_name;
        }
        // Last name
        if (!empty($user->last_name)) {
            $user_profile['last_name'] = $user->last_name;
        }

        // Create user profile
        return $this->create($user_profile);
    }

    /**
     * @param $user
     * @return mixed
     */
    protected function hasAlreadyAnUserProfile($user)
    {
        return $user->user_profile()->count();
    }
}
