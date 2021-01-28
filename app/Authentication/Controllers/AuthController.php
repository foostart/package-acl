<?php namespace Foostart\Acl\Authentication\Controllers;

use Illuminate\Http\Request;
use Sentry, View, Redirect, App, Config;
use Foostart\Acl\Authentication\Validators\ReminderValidator;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;
use Foostart\Acl\Library\Exceptions\ValidationException;
use Foostart\Acl\Authentication\Services\ReminderService;

use Foostart\Acl\Authentication\Validators\RecoverPasswordValidator;

class AuthController extends Controller {

    protected $authenticator;
    protected $reminder;
    protected $reminder_validator;

    public function __construct(ReminderService $reminder, ReminderValidator $reminder_validator)
    {
        $this->authenticator = App::make('authenticator');
        $this->reminder = $reminder;
        $this->reminder_validator = $reminder_validator;
    }

    /**
     * User login
     * @return login page
     */
    public function getClientLogin(Request $request)
    {
        //User loged
        if ($this->authenticator->check()) {
            return Redirect::to(Config::get('acl_base.user_login_redirect_url'));
        }

        $data_view = [
            'request' => $request,
        ];

        //Show captcha
        $enable_captcha = Config::get('acl_base.captcha_login');

        if ($enable_captcha) {
            $captcha = App::make('captcha_validator');
            $data_view = array_merge($data_view, array(
                'captcha' => $captcha
            ));
        }

        return View::make('package-acl::client.auth.login')->with($data_view);
    }

    public function getAdminLogin()
    {
        if ($this->authenticator->check()) {
            return Redirect::to(Config::get('acl_base.admin_login_redirect_url'));
        }
        return view('package-acl::admin.auth.login');
    }

    public function postAdminLogin(Request $request)
    {
        list($email, $password, $remember) = $this->getLoginInput($request);

        try
        {
            $this->authenticator->authenticate(array(
                                                "email" => $email,
                                                "password" => $password
                                             ), $remember);
        }
        catch(JacopoExceptionsInterface $e)
        {
            $errors = $this->authenticator->getErrors();
            return redirect()->route("user.admin.login")->withInput()->withErrors($errors);
        }

        return Redirect::to(Config::get('acl_base.admin_login_redirect_url'));
    }

    public function postClientLogin(Request $request)
    {
        list($email, $password, $remember, $captcha) = $this->getLoginInput($request);

        try
        {
            //Show captcha
            $enable_captcha = Config::get('acl_base.captcha_login');
            if ($enable_captcha) {

                $captchaValidator = App::make('captcha_validator');
                $flag = $captchaValidator->validateCaptcha($request->all(), $captcha);

                if (!$flag) {
                    $errors = $captchaValidator->getErrorMessage();
                    throw new ValidationException($errors);
                }

            }
            $this->authenticator->authenticate(array(
                                                    "email" => $email,
                                                    "password" => $password
                                               ), $remember);
        }
        catch(JacopoExceptionsInterface $e)
        {

            if (!isset($errors)) {
                $errors = $this->authenticator->getErrors();
            }
          
            return redirect()->route("user.login")->withInput()->withErrors($errors);
        }

        return Redirect::to(Config::get('acl_base.user_login_redirect_url'));
    }

    /**
     * Logout utente
     *
     * @return string
     */
    public function getLogout()
    {
        $this->authenticator->logout();

        return redirect('/');
    }

    /**
     * Recupero password
     */
    public function getReminder(Request $request)
    {
        $data_view = [
            'request' => $request
        ];

        $enable_captcha = Config::get('acl_base.captcha_signup');

        if ($enable_captcha) {

            $captcha = App::make('captcha_validator');
            $data_view = array_merge($data_view, array(
                'captcha' => $captcha
            ));

            return view('package-acl::client.auth.reminder', $data_view);
        }

        return view('package-acl::client.auth.reminder', $data_view);
    }

    /**
     * Invio token per set nuova password via mail
     *
     * @return mixed
     */
    public function postReminder(Request $request) {

        $validator_recovery = new RecoverPasswordValidator();
        $params = $request->all();

        if (!$validator_recovery->validate($params)) {
            $errors = $validator_recovery->getErrors();
            return redirect()->route("user.recovery-password")->withErrors($errors);

        } else {
            $email = $request->get('email');

            try {
                $this->reminder->send($email);
                return redirect()->route("user.reminder-success");
            } catch (JacopoExceptionsInterface $e) {
                $errors = $this->reminder->getErrors();
                return redirect()->route("user.recovery-password")->withErrors($errors);
            }
        }
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function getChangePassword(Request $request) {

        $email = $request->get('email');
        $token = $request->get('token');

        return view("package-acl::client.auth.changepassword", array("email" => $email, "token" => $token) );
    }

    public function postChangePassword(Request $request)
    {
        $email = $request->get('email');
        $token = $request->get('token');
        $password = $request->get('password');

        if (! $this->reminder_validator->validate($request->all()) )
        {
          return redirect()->route("user.change-password")->withErrors($this->reminder_validator->getErrors())->withInput();
        }

        try
        {
            $this->reminder->reset($email, $token, $password);
        }
        catch(JacopoExceptionsInterface $e)
        {
            $errors = $this->reminder->getErrors();
            return redirect()->route("user.change-password")->withErrors($errors);
        }

        return redirect()->route("user.change-password-success");

    }

    /**
     * @return array
     */
    private function getLoginInput(Request $request)
    {
        $email    = $request->get('email');
        $password = $request->get('password');
        $remember = $request->get('remember');
        $captcha = $request->get('captcha_text');

        return array($email, $password, $remember, $captcha);
    }
}