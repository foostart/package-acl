<?php  namespace Foostart\Acl\Authentication\Services;

use Config;
use DB;
use Event;
use Illuminate\Support\Facades\App;
use Illuminate\Support\MessageBag;
use Foostart\Acl\Authentication\Exceptions\TokenMismatchException;
use Foostart\Acl\Authentication\Exceptions\UserExistsException;
use Foostart\Acl\Authentication\Exceptions\UserNotFoundException;
use Foostart\Acl\Authentication\Helpers\DbHelper;
use Foostart\Acl\Authentication\Validators\UserSignupValidator;
use Foostart\Acl\Library\Exceptions\ValidationException;
use Illuminate\Support\Arr;

/**
 * Class UserRegisterService
 *
 * @author Foostart foostart.com@gmail.com
 */
class UserRegisterService
{
    /**
     * @var \Foostart\Acl\Authentication\Repository\Interfaces\UserRepositoryInterface
     */
    protected $user_repository;
    /**
     * @var \Foostart\Acl\Authentication\Repository\Interfaces\UserProfileRepositoryInterface
     */
    protected $profile_repository;
    /**
     * @var \Foostart\Acl\Authentication\Validators\UserSignupValidator
     */
    protected $user_signup_validator;
    /**
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;
    /**
     * If email activation is enabled
     *
     * @var boolean
     */
    protected $activation_enabled;

    public function __construct(UserSignupValidator $v = null)
    {
        $this->user_repository = App::make('user_repository');
        $this->profile_repository = App::make('profile_repository');
        $this->user_signup_validator = $v ? $v : new UserSignupValidator;
        $this->activation_enabled = Config::get('acl_base.email_confirmation');
        Event::listen('service.activated',
                      'Foostart\Acl\Authentication\Services\UserRegisterService@sendActivationEmailToClient');
    }


    /**
     * @param array $input
     * @return mixed
     */
    public function register(array $input)
    {
        Event::dispatch('service.registering', [$input]);
        $this->validateInput($input);

        $input['activated'] = $this->getDefaultActivatedState();
        $user = $this->saveDbData($input);

        $this->sendRegistrationMailToClient($input);

        Event::dispatch('service.registered', [$input, $user]);

        return $user;
    }


    /**
     *
     * @param array $input list of user info
     * @loc T7 DT MD QN
     * @date 10:10 27/01/2019
     * @author Kang
     * @return type
     */
    public function saveRegisterBySocial(array $input) {

        //Get user by email
        try {
            $user = $this->user_repository->findByLogin($input['email']);
        } catch(UserNotFoundException $e) {
            $user = $this->saveDbData($input);
        }

        return $user;
    }

    /**
     * @param array $input
     * @throws \Foostart\Acl\Library\Exceptions\ValidationException
     */
    protected function validateInput(array $input)
    {
        if(!$this->user_signup_validator->validate($input))
        {
            $this->errors = $this->user_signup_validator->getErrors();
            throw new ValidationException;
        }
    }

    /**
     * @param array $input
     * @return mixed $user
     */
    protected function saveDbData(array $input)
    {
        DbHelper::startTransaction();
        try
        {
            $user = $this->user_repository->create($input);
            $this->profile_repository->create($this->createProfileInput($input, $user));
        } catch(UserExistsException $e)
        {
            DbHelper::rollback();
            $this->errors = new MessageBag(["model" => "User already exists."]);
            throw new UserExistsException;
        }
        DbHelper::commit();

        return $user;
    }

    protected function getDefaultActivatedState()
    {
        return Config::get('acl_base.email_confirmation') ? false : true;
    }

    /**
     * @param $mailer
     * @param $user
     */
    public function sendRegistrationMailToClient($input)
    {
        $view_file = $this->activation_enabled ? "package-acl::admin.mail.registration-waiting-client" : "package-acl::admin.mail.registration-confirmed-client";

        $mailer = App::make('jmailer');

        // send email to client
        $mailer->sendTo($input['email'], [
                                               "email"      => $input["email"],
                                               "password"   => $input["password"],
                                               "first_name" => $input["first_name"],
                                               "token"      => $this->activation_enabled ? App::make('authenticator')->getActivationToken($input["email"]) : ''
                                       ],
                        Config::get('acl_messages.email.user_registration_request_subject'),
                        $view_file);
    }


    /**
     * Send activation email to the client if it's getting activated
     *
     * @param $obj
     */
    public function sendActivationEmailToClient($user)
    {
        $mailer = App::make('jmailer');
        // if i activate a deactivated user
        $mailer->sendTo($user->email, ["email" => $user->email],
                        Config::get('acl_messages.email.user_registraction_activation_subject'),
                        "package-acl::admin.mail.registration-activated-client");
    }

    /**
     * @param $email
     * @param $token
     * @throws \Foostart\Acl\Authentication\Exceptions\UserNotFoundException
     * @throws \Foostart\Acl\Authentication\Exceptions\TokenMismatchException
     */
    public function checkUserActivationCode($email, $token)
    {
        $token_msg = "The given token/email are invalid.";

        try
        {
            $user = $this->user_repository->findByLogin($email);
        } catch(UserNotFoundException $e)
        {
            $this->errors = new MessageBag(["token" => $token_msg]);
            throw new UserNotFoundException;
        }
        if($user->activation_code != $token)
        {
            $this->errors = new MessageBag(["token" => $token_msg]);
            throw new TokenMismatchException;
        }

        $this->user_repository->activate($email);
        Event::dispatch('service.activated', $user);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    protected function getToken()
    {
        return csrf_token();
    }

    /**
     * @param array $input
     * @param       $user
     * @return array
     */
    private function createProfileInput(array $input, $user)
    {
        return array_merge(["user_id" => $user->id],
            Arr::except($input, ["email", "password", "activated"]));
    }
}
