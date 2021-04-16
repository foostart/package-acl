<?php  namespace Foostart\Acl\Authentication\Controllers;

/**
 * Class UserController
 *
 * @author Foostart foostart.com@gmail.com
 */
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Foostart\Acl\Authentication\Exceptions\PermissionException;
use Foostart\Acl\Authentication\Exceptions\ProfileNotFoundException;
use Foostart\Acl\Authentication\Helpers\DbHelper;
use Foostart\Acl\Authentication\Models\UserProfile;
use Foostart\Acl\Authentication\Presenters\UserPresenter;
use Foostart\Acl\Authentication\Services\UserProfileService;
use Foostart\Acl\Authentication\Validators\UserProfileAvatarValidator;
use Foostart\Acl\Library\Exceptions\NotFoundException;
use Foostart\Acl\Authentication\Models\User;
use Foostart\Acl\Authentication\Helpers\FormHelper;
use Foostart\Acl\Authentication\Exceptions\UserNotFoundException;
use Foostart\Acl\Authentication\Validators\UserValidator;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;
use Foostart\Acl\Authentication\Validators\UserProfileValidator;
use View, Redirect, App, Config;
use Foostart\Acl\Authentication\Interfaces\AuthenticateInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Foostart\Acl\Library\Form\FormModel;

class UserController extends Controller {
    /**
     * @var \Foostart\Acl\Authentication\Repository\SentryUserRepository
     */
    protected $user_repository;
    protected $user_validator;
    /**
     * @var \Foostart\Acl\Authentication\Helpers\FormHelper
     */
    protected $form_helper;
    protected $profile_repository;
    protected $profile_validator;
    /**
     * @var use Foostart\Acl\Authentication\Interfaces\AuthenticateInterface;
     */
    protected $auth;
    protected $register_service;
    protected $custom_profile_repository;

    protected $authentication_helper;

    public function __construct(UserValidator $v, FormHelper $fh, UserProfileValidator $vp, AuthenticateInterface $auth)
    {
        parent::__construct();
        $this->user_repository = App::make('user_repository');
        $this->user_validator = $v;

        $this->f = new FormModel($this->user_validator, $this->user_repository);
        $this->form_helper = $fh;
        $this->profile_validator = $vp;
        $this->profile_repository = App::make('profile_repository');
        $this->auth = $auth;
        $this->register_service = App::make('register_service');
        $this->custom_profile_repository = App::make('custom_profile_repository');
        
        /**
         * Breadcrumb
         */
        $this->breadcrumb_1['label'] = 'Admin';
        $this->breadcrumb_2['label'] = 'Users';

    }

    /**
     * Get list of users in system
     * @param Request $request
     * @return view page
     */
    public function getList(Request $request)
    {
        /**
         * Breadcrumb
         */
        $this->breadcrumb_3 = NULL;
       $user_leader = $this->user_repository->isLeader();
        $users = $this->user_repository->all($request->except(['page']));
        
        // display view
        $this->data_view = array_merge($this->data_view, array(
            "users" => $users, 
            "request" => $request,
            'breadcrumb_1' => $this->breadcrumb_1,
            'breadcrumb_2' => $this->breadcrumb_2,
            'breadcrumb_3' => $this->breadcrumb_3,
        ));
        return View::make('package-acl::admin.user.list')->with($this->data_view);
    }

    public function editUser(Request $request)
    {
        /**
         * Breadcrumb
         */
        $this->breadcrumb_3['label'] = 'Edit';
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
        // display view
        $this->data_view = array_merge($this->data_view, array(
            "user" => $user, 
            "presenter" => $presenter,
            'breadcrumb_1' => $this->breadcrumb_1,
            'breadcrumb_2' => $this->breadcrumb_2,
        ));
        return View::make('package-acl::admin.user.edit')->with($this->data_view);
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

        return View::make('package-acl::admin.user.profile')->with([
                                                                                          'user_profile'   => $user_profile,
                                                                                          "custom_profile" => $custom_profile_repo
                                                                                  ]);
    }

    /**
     * Update user info
     * @param  Request  $request
     *
     * @return mixed
     */
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

        return View::make('package-acl::admin.user.self-profile')
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
            return View::make('package-acl::client.auth.signup')->with($data_view);
        }

        return View::make('package-acl::client.auth.signup');
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
        return $email_confirmation_enabled ? View::make('package-acl::client.auth.signup-email-confirmation') : View::make('package-acl::client.auth.signup-success');
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
            return View::make('package-acl::client.auth.email-confirmation')->withErrors($this->register_service->getErrors());
        }
        return View::make('package-acl::client.auth.email-confirmation');
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
        return View::make('package-acl::client.auth.captcha-image')
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
     * Create directory for backup language if not exits
     * @date B102B-13/03/2019
     * @author Kang
     * @return view
     */
    public function lang(Request $request) {
        
        /**
         * Breadcrumb
         */
        $this->breadcrumb_3['label'] = 'Edit';

        $is_valid_request = $this->isValidRequest($request);

        // get list of languages
        // create directory backup for each language
        $langs = config('package-acl.langs');
        $lang_paths = [];
        $package_path = realpath(base_path('vendor/foostart/package-acl'));

        if (!empty($langs) && is_array($langs)) {
            foreach ($langs as $key => $value) {
                $lang_paths[$key] = realpath(base_path('resources/lang/'.$key.'/acl-admin.php'));
                $key_backup = $package_path.'/storage/backup/lang/'.$key;

                if (!file_exists($key_backup)) {
                    mkdir($key_backup, 0755    , true);
                }
            }
        }

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
                file_put_contents($lang_backup.'/'.$key.'/acl-admin-'.date('YmdHis',time()).'.php', $content);
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

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'request' => $request,
            'backups' => $backups,
            'langs'   => $langs,
            'lang_contents' => $lang_contents,
            'lang' => $lang,
            'breadcrumb_1' => $this->breadcrumb_1,
            'breadcrumb_2' => $this->breadcrumb_2,
            'breadcrumb_3' => $this->breadcrumb_3,
        ));
        return View::make('package-acl::admin.acl-lang')->with($this->data_view);
    }
}
