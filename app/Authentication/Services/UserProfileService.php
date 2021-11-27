<?php namespace Foostart\Acl\Authentication\Services;

/**
 * Class UserProfileService
 *
 * @author Foostart foostart.com@gmail.com
 */

use App;
use Illuminate\Support\MessageBag;
use Foostart\Acl\Authentication\Exceptions\PermissionException;
use Foostart\Acl\Authentication\Validators\UserProfileUserValidator;
use Foostart\Acl\Authentication\Validators\UserProfileValidator;
use Foostart\Acl\Library\Exceptions\InvalidException;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;
use Foostart\Acl\Library\Form\FormModel;
use Illuminate\Support\Arr;

class UserProfileService
{
    /**
     * Profile repository
     */
    protected $profile_repository;
    /**
     * @var \Foostart\Acl\Authentication\Validators\UserProfileValidator
     */
    protected $validator_profile;
    /**
     * @var FormModel
     */
    protected $form_model_profile;
    /**
     * User repository
     */
    protected $user_repository;
    /**
     * @var \Foostart\Acl\Authentication\Validators\UserProfileUserValidator
     */
    protected $validator_user;
    /**
     * @var FormModel
     */
    protected $form_model_user;
    /**
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    protected $custom_profile_field_prefix = "custom_profile_";

    function __construct($validator_profile, $form_model_profile = null, $validator_user = null, $form_model_user = null)
    {
        // profile formModel
        $this->profile_repository = App::make('profile_repository');
        $this->validator_profile = $validator_profile ? $validator_profile : new UserProfileValidator;
        $this->form_model_profile = $form_model_profile ?: new FormModel($this->validator_profile, $this->profile_repository);
        // user formModel
        $this->user_repository = App::make('user_repository');
        $this->validator_user = $validator_user ?: new UserProfileUserValidator();
        $this->form_model_user = $form_model_user ?: new FormModel($this->validator_user, $this->user_repository);
        $this->form_model_user->setIdName('user_id');
    }

    public function processForm($input)
    {
        $this->checkProfileEditPermission($input);

        $this->updateUserBaseData($input);

        $user_profile = $this->updateUserProfile($input);
        $this->saveCustomProfileFields($input, $user_profile);

        return $user_profile;
    }

    /**
     * @param $input
     * @return mixed
     * @throws \Foostart\Acl\Library\Exceptions\InvalidException
     */
    protected function updateUserProfile($input)
    {
        try {
            $user_profile = $this->form_model_profile->process($input);

            return $user_profile;
        } catch (JacopoExceptionsInterface $e) {
            $this->errors = $this->form_model_profile->getErrors();
            throw new InvalidException;
        }

        return $user_profile;
    }

    /**
     * @param $input
     * @throws \Foostart\Acl\Authentication\Exceptions\PermissionException
     */
    protected function checkProfileEditPermission($input)
    {
        $auth_helper = App::make('authentication_helper');
        if (!$auth_helper->checkProfileEditPermission($input["user_id"])) {
            $this->errors = new MessageBag(["model" => "You don't have the permission to edit other user profiles."]);
            throw new PermissionException;
        }
    }

    /**
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $input
     * @param $user_profile
     */
    protected function saveCustomProfileFields($input, $user_profile)
    {
        $custom_profile_repository = App::makeWith('custom_profile_repository', [$user_profile->user_id]);
        foreach ($input as $input_key => $value) {
            if (($profile_field_type_id_position = $this->isCustomFieldKey($input_key)) !== false) {
                $profile_field_type_id = $this->extractCustomFieldId($input_key,
                    $profile_field_type_id_position);
                $custom_profile_repository->setField($profile_field_type_id, $value);
            }
        }
    }

    /**
     * @param $input_key
     * @return int
     */
    protected function isCustomFieldKey($input_key)
    {
        return strpos($input_key, $this->custom_profile_field_prefix);
    }

    /**
     * @param $input_key
     * @param $profile_field_type_id_position
     * @return string
     */
    protected function extractCustomFieldId($input_key, $profile_field_type_id_position)
    {
        return substr($input_key, $profile_field_type_id_position + strlen($this->custom_profile_field_prefix));
    }

    /**
     * @param $input
     * @return mixed
     * @throws \Foostart\Acl\Library\Exceptions\InvalidException
     */
    private function updateUserBaseData($input)
    {
        try {
            if (!empty($input['password']) || !empty($input['password_confirmation'])) {
                $this->form_model_user->process(Arr::only($input, ['password', 'password_confirmation', 'user_id']));
            }
        } catch (JacopoExceptionsInterface $e) {
            $this->errors = $this->form_model_user->getErrors();
            throw new InvalidException;
        }
    }
}
