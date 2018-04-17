<?php  namespace LaravelAcl\Authentication\Controllers;

/**
 * Class UserController
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use LaravelAcl\Authentication\Exceptions\PermissionException;
use LaravelAcl\Authentication\Exceptions\ProfileNotFoundException;
use LaravelAcl\Authentication\Helpers\DbHelper;
use LaravelAcl\Authentication\Models\UserProfile;
use LaravelAcl\Authentication\Presenters\UserPresenter;
use LaravelAcl\Authentication\Services\UserProfileService;
use LaravelAcl\Authentication\Validators\UserProfileAvatarValidator;
use LaravelAcl\Library\Exceptions\NotFoundException;
use LaravelAcl\Authentication\Models\User;
use LaravelAcl\Authentication\Helpers\FormHelper;
use LaravelAcl\Authentication\Exceptions\UserNotFoundException;
use LaravelAcl\Authentication\Validators\UserValidator;
use LaravelAcl\Library\Exceptions\JacopoExceptionsInterface;
use LaravelAcl\Authentication\Validators\UserProfileValidator;
use View, Redirect, App, Config;
use LaravelAcl\Authentication\Interfaces\AuthenticateInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LaravelAcl\Library\Form\FormModel;

class UserController extends Controller {
    /**
     * @var \LaravelAcl\Authentication\Repository\SentryUserRepository
     */
    protected $user_repository;
    protected $user_validator;
    /**
     * @var \LaravelAcl\Authentication\Helpers\FormHelper
     */
    protected $form_helper;
    protected $profile_repository;
    protected $profile_validator;
    /**
     * @var use LaravelAcl\Authentication\Interfaces\AuthenticateInterface;
     */
    protected $auth;
    protected $register_service;
    protected $custom_profile_repository;

    protected $authentication_helper;

    public function __construct(UserValidator $v, FormHelper $fh, UserProfileValidator $vp, AuthenticateInterface $auth)
    {
        $this->user_repository = App::make('user_repository');
        $this->user_validator = $v;

        $this->f = new FormModel($this->user_validator, $this->user_repository);
        $this->form_helper = $fh;
        $this->profile_validator = $vp;
        $this->profile_repository = App::make('profile_repository');
        $this->auth = $auth;
        $this->register_service = App::make('register_service');
        $this->custom_profile_repository = App::make('custom_profile_repository');

    }

    /**
     * Get list of users in system
     * @param Request $request
     * @return view page
     */
    public function getList(Request $request)
    {
       $user_leader = $this->user_repository->isLeader();
        $users = $this->user_repository->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.user.list')->with(["users" => $users, "request" => $request]);
    }

    public function editUser(Request $request)
    {
        try
        {
            $user_leader = $this->user_repository->isLeader();
            $user = $this->user_repository->find($request->get('id'));

            if (!$this->user_repository->canUpdate($user)) {

                return Redirect::route("users.list")->withErrors('cant update');
            }

        } catch(JacopoExceptionsInterface $e)
        {
            $user = new User;
        }
        $presenter = new UserPresenter($user);

        return View::make('laravel-authentication-acl::admin.user.edit')->with(["user" => $user, "presenter" => $presenter]);
    }

    public function postEditUser(Request $request)
    {
        $id = $request->get('id');

        DbHelper::startTransaction();
        try
        {
            $user = $this->f->process($request->all());
            $this->profile_repository->attachEmptyProfile($user);
        } catch(JacopoExceptionsInterface $e)
        {
            DbHelper::rollback();
            $errors = $this->f->getErrors();
            // passing the id incase fails editing an already existing item
            return Redirect::route("users.edit", $id ? ["id" => $id] : [])->withInput()->withErrors($errors);
        }

        DbHelper::commit();

        return Redirect::route('users.edit', ["id" => $user->id])
                       ->withMessage(Config::get('acl_messages.flash.success.user_edit_success'));
    }

    public function deleteUser(Request $request)
    {
        try
        {
            $this->f->delete($request->all());
        } catch(JacopoExceptionsInterface $e)
        {
            $errors = $this->f->getErrors();
            return Redirect::route('users.list')->withErrors($errors);
        }
        return Redirect::route('users.list')
                       ->withMessage(Config::get('acl_messages.flash.success.user_delete_success'));
    }

    public function addGroup(Request $request)
    {
        $user_id = $request->get('id');
        $group_id = $request->get('group_id');

        try
        {
            $this->user_repository->addGroup($user_id, $group_id);
        } catch(JacopoExceptionsInterface $e)
        {
            return Redirect::route('users.edit', ["id" => $user_id])
                           ->withErrors(new MessageBag(["name" => Config::get('acl_messages.flash.error.user_group_not_found')]));
        }
        return Redirect::route('users.edit', ["id" => $user_id])
                       ->withMessage(Config::get('acl_messages.flash.success.user_group_add_success'));
    }

    public function deleteGroup(Request $request)
    {
        $user_id = $request->get('id');
        $group_id = $request->get('group_id');

        try
        {
            $this->user_repository->removeGroup($user_id, $group_id);
        } catch(JacopoExceptionsInterface $e)
        {
            return Redirect::route('users.edit', ["id" => $user_id])
                           ->withErrors(new MessageBag(["name" => Config::get('acl_messages.flash.error.user_group_not_found')]));
        }
        return Redirect::route('users.edit', ["id" => $user_id])
                       ->withMessage(Config::get('acl_messages.flash.success.user_group_delete_success'));
    }

    public function editPermission(Request $request)
    {
        // prepare input
        $input = $request->all();
        $operation = $request->get('operation');
        $this->form_helper->prepareSentryPermissionInput($input, $operation);
        $id = $request->get('id');

        try
        {
            $obj = $this->user_repository->update($id, $input);
        } catch(JacopoExceptionsInterface $e)
        {
            return Redirect::route("users.edit")->withInput()
                           ->withErrors(new MessageBag(["permissions" => Config::get('acl_messages.flash.error.user_permission_not_found')]));
        }
        return Redirect::route('users.edit', ["id" => $obj->id])
                       ->withMessage(Config::get('acl_messages.flash.success.user_permission_add_success'));
    }

    public function editProfile(Request $request)
    {
        $user_id = $request->get('user_id');

        try
        {
            $user_profile = $this->profile_repository->getFromUserId($user_id);
        } catch(UserNotFoundException $e)
        {
            return Redirect::route('users.list')
                           ->withErrors(new MessageBag(['model' => Config::get('acl_messages.flash.error.user_user_not_found')]));
        } catch(ProfileNotFoundException $e)
        {
            $user_profile = new UserProfile(["user_id" => $user_id]);
        }
        $custom_profile_repo = App::makeWith('custom_profile_repository', [$user_profile->id]);

        return View::make('laravel-authentication-acl::admin.user.profile')->with([
                                                                                          'user_profile'   => $user_profile,
                                                                                          "custom_profile" => $custom_profile_repo
                                                                                  ]);
    }

    public function postEditProfile(Request $request)
    {
        $input = $request->all();
        $service = new UserProfileService($this->profile_validator);
        try
        {
            $service->processForm($input);
        } catch(JacopoExceptionsInterface $e)
        {
            $errors = $service->getErrors();
            return Redirect::back()
                           ->withInput()
                           ->withErrors($errors);
        }
        return Redirect::back()
                       ->withInput()
                       ->withMessage(Config::get('acl_messages.flash.success.user_profile_edit_success'));
    }

    public function editOwnProfile(Request $request)
    {
        $logged_user = $this->auth->getLoggedUser();

        $custom_profile_repo = App::makeWith('custom_profile_repository', [$logged_user->user_profile()->first()->id]);

        return View::make('laravel-authentication-acl::admin.user.self-profile')
                   ->with([
                                  "user_profile"   => $logged_user->user_profile()
                                                                  ->first(),
                                  "custom_profile" => $custom_profile_repo
                          ]);
    }

    /**
     * Signup page
     * @param Request $request
     * @return sign up page
     */
    public function signup(Request $request) {
        $data_view = array(
            'request' => $request,
        );

        $enable_captcha = Config::get('acl_base.captcha_signup');

        if ($enable_captcha) {

            $captcha = App::make('captcha_validator');
            $data_view = array_merge($data_view, array(
                'captcha' => $captcha
            ));
            return View::make('laravel-authentication-acl::client.auth.signup')->with($data_view);
        }

        return View::make('laravel-authentication-acl::client.auth.signup');
    }

    /**
     *
     * @param Request $request
     * @return page sign up after submit
     */
    public function postSignup(Request $request)
    {
        $service = App::make('register_service');

        try
        {
            $service->register($request->all());
        } catch(JacopoExceptionsInterface $e)
        {
            return Redirect::route('user.signup')->withErrors($service->getErrors())->withInput();
        }

        return Redirect::route("user.signup-success");
    }

    public function signupSuccess(Request $request)
    {
        $email_confirmation_enabled = Config::get('acl_base.email_confirmation');
        return $email_confirmation_enabled ? View::make('laravel-authentication-acl::client.auth.signup-email-confirmation') : View::make('laravel-authentication-acl::client.auth.signup-success');
    }

    public function emailConfirmation(Request $request)
    {
        $email = $request->get('email');
        $token = $request->get('token');

        try
        {
            $this->register_service->checkUserActivationCode($email, $token);
        } catch(JacopoExceptionsInterface $e)
        {
            return View::make('laravel-authentication-acl::client.auth.email-confirmation')->withErrors($this->register_service->getErrors());
        }
        return View::make('laravel-authentication-acl::client.auth.email-confirmation');
    }

    public function addCustomFieldType(Request $request)
    {
        $description = $request->get('description');
        $user_id = $request->get('user_id');

        try
        {
            $this->custom_profile_repository->addNewType($description);
        } catch(PermissionException $e)
        {
            return Redirect::route('users.profile.edit', ["user_id" => $user_id])
                           ->withErrors(new MessageBag(["model" => $e->getMessage()]));
        }

        return Redirect::route('users.profile.edit', ["user_id" => $user_id])
                       ->with('message', Config::get('acl_messages.flash.success.custom_field_added'));
    }

    public function deleteCustomFieldType(Request $request)
    {
        $id = $request->get('id');
        $user_id = $request->get('user_id');

        try
        {
            $this->custom_profile_repository->deleteType($id);
        } catch(ModelNotFoundException $e)
        {
            return Redirect::route('users.profile.edit', ["user_id" => $user_id])
                           ->withErrors(new MessageBag(["model" => Config::get('acl_messages.flash.error.custom_field_not_found')]));
        } catch(PermissionException $e)
        {
            return Redirect::route('users.profile.edit', ["user_id" => $user_id])
                           ->withErrors(new MessageBag(["model" => $e->getMessage()]));
        }

        return Redirect::route('users.profile.edit', ["user_id" => $user_id])
                       ->with('message', Config::get('acl_messages.flash.success.custom_field_removed'));
    }

    public function changeAvatar(Request $request)
    {
        $user_id = $request->get('user_id');
        $profile_id = $request->get('user_profile_id');

        // validate input
        $validator = new UserProfileAvatarValidator();
        if(!$validator->validate($request->all()))
        {
            return Redirect::route('users.profile.edit', ['user_id' => $user_id])
                           ->withInput()->withErrors($validator->getErrors());
        }

        // change picture
        try
        {
            $this->profile_repository->updateAvatar($profile_id);
        } catch(NotFoundException $e)
        {
            return Redirect::route('users.profile.edit', ['user_id' => $user_id])->withInput()
                           ->withErrors(new MessageBag(['avatar' => Config::get('acl_messages.flash.error.')]));
        }

        return Redirect::route('users.profile.edit', ['user_id' => $user_id])
                       ->withMessage(Config::get('acl_messages.flash.success.avatar_edit_success'));
    }

    public function refreshCaptcha()
    {
        return View::make('laravel-authentication-acl::client.auth.captcha-image')
                   ->with(['captcha' => App::make('captcha_validator')]);
    }

    /**
     * Check valid token
     * @param Request $request
     * @return boolean
     */
    public function isValidRequest(Request $request) {
        $flag = TRUE;
        $valid_token = csrf_token();

        $token = $request->get('_token');

        if (!strcmp($valid_token, $token) == 0) {

            $flag = FALSE;

        }
        return $flag;
    }

    /**
     *
     * @return type
     */
    public function lang(Request $request) {

        $is_valid_request = $this->isValidRequest($request);

        // display view
        $langs = config('package-acl.langs');
        $lang_paths = [];

        if (!empty($langs) && is_array($langs)) {
            foreach ($langs as $key => $value) {
                $lang_paths[$key] = realpath(base_path('resources/lang/'.$key.'/jacopo-admin.php'));
            }
        }


        $package_path = realpath(base_path('vendor/jacopo/laravel-authentication-acl'));

        $lang_backup = realpath($package_path.'/storage/backup/lang');
        $lang = $request->get('lang')?$request->get('lang'):'en';
        $lang_contents = [];

        if ($version = $request->get('v')) {
            //load backup lang
            $group_backups = base64_decode($version);
            $group_backups = empty($group_backups)?[]: explode(';', $group_backups);

            foreach ($group_backups as $group_backup) {
                $_backup = explode('=', $group_backup);
                $lang_contents[$_backup[0]] = file_get_contents($_backup[1]);
            }

        } else {
            //load current lang
            foreach ($lang_paths as $key => $lang_path) {
                $lang_contents[$key] = file_get_contents($lang_path);
            }
        }

        if ($request->isMethod('post') && $is_valid_request) {

            //create backup of current config
            foreach ($lang_paths as $key => $value) {
                $content = file_get_contents($value);

                //format file name sample-admin-YmdHis.php
                file_put_contents($lang_backup.'/'.$key.'/jacopo-admin-'.date('YmdHis',time()).'.php', $content);
            }


            //update new lang
            foreach ($langs as $key => $value) {
                $content = $request->get($key);
                file_put_contents($lang_paths[$key], $content);
            }

        }

        //get list of backup langs
        $backups = [];
        foreach ($langs as $key => $value) {
            $backups[$key] = array_reverse(glob($lang_backup.'/'.$key.'/*'));
        }

        $data_view = [
            'request' => $request,
            'backups' => $backups,
            'langs'   => $langs,
            'lang_contents' => $lang_contents,
            'lang' => $lang,
        ];

        return View::make('laravel-authentication-acl::admin.acl-lang')->with($data_view);
    }
}
