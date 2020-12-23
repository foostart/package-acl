<?php namespace Foostart\Acl\Authentication\Classes;

/**
 * Class SentryAuthenticator
 * Sentry authenticate implementation
 *
 * @author Foostart foostart.com@gmail.com
 */
use Illuminate\Support\MessageBag;
use Foostart\Acl\Authentication\Exceptions\AuthenticationErrorException;
use Foostart\Acl\Authentication\Exceptions\UserNotFoundException;
use Foostart\Acl\Authentication\Interfaces\AuthenticateInterface;
use App;
use Event;

class SentryAuthenticator implements AuthenticateInterface
{

    protected $errors;
    protected $sentry;

    protected  $plang_admin = 'acl-admin';
    protected  $plang_front = 'acl-front';

    public function __construct()
    {
        $this->sentry = App::make('sentry');
        $this->errors = new MessageBag();

    }

    public function check()
    {
        if( ! $this->sentry->check()) return false;

        if($this->sentry->getUser()->banned)
        {
            $this->logout();
            return false;
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(array $credentials, $remember = false)
    {
        Event::dispatch('service.authenticating', [$credentials, $remember]);

        try
        {
            $user = $this->sentry->authenticate($credentials, $remember);
        } catch(\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $this->errors->add('login', trans($this->plang_front.'.error.login-error-required-field'));
        } catch(\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->errors->add('login', trans($this->plang_front.'.error.login-error-failed'));
        } catch(\Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            $this->errors->add('login', trans($this->plang_front.'.error.login-error-not-active'));
        } catch(\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $this->errors->add('login', trans($this->plang_front.'.error.login-error-required-password'));
        } catch(\Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            $this->errors->add('login', trans($this->plang_front.'.error.login-error-many-attempts'));
        }
        if($this->foundAnyErrors())
        {
            $this->checkForBannedUser($user);
        }

        if(!$this->errors->isEmpty()) throw new AuthenticationErrorException;

        Event::dispatch('service.authenticated', [$credentials, $remember, $user]);
    }

    /**
     * {@inheritdoc}
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * {@inheritdoc}
     */
    public function loginById($id, $remember = false)
    {
        try
        {
            $user = $this->sentry->findUserById($id);
        } catch(\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->errors->add('login', 'Utente non trovato.');
        }

        if($this->foundAnyErrors())
        {
            try
            {
                $this->sentry->login($user, $remember);
            } catch(\Cartalyst\Sentry\Users\UserNotActivatedException $e)
            {
                $this->errors->add('login', 'Utente non attivo.');
            }

            $this->checkForBannedUser($user);
        }

        return $this->errors->isEmpty() ? true : false;
    }

    /**
     * {@inheritdoc}
     */
    public function logout()
    {
        Event::dispatch('service.delogging');
        $this->sentry->logout();
        Event::dispatch('service.delogged');
    }

    /**
     * {@inheritdoc}
     */
    public function getUser($email)
    {
        try
        {
            $user = $this->sentry->findUserByLogin($email);
        } catch(\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            throw new UserNotFoundException($e->getMessage());
        }
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getActivationToken($email)
    {
        $user = $this->getUser($email);

        return $user->getActivationCode();
    }

    public function getUserById($id)
    {
        return $this->sentry->findUserById($id);
    }

    public function getLoggedUser()
    {
        return $this->sentry->getUser();
    }

    /**
     * @param $user
     */
    private function checkForBannedUser($user)
    {
        if($user->banned)
        {
            $this->errors->add('login', 'This user is banned.');
            $this->sentry->logout();
        }
    }

    /**
     * {@inheritdoc}
     * @throws \Foostart\Acl\Authentication\Exceptions\UserNotFoundException
     */
    public function getToken($email)
    {
        $user = $this->getUser($email);

        return $user->getResetPasswordCode();
    }

    /**
     * @return bool
     */
    private function foundAnyErrors()
    {
        return $this->errors->isEmpty();
    }

    /**
     * Customize function
     * Authentication user account
     * @param array $account
     * @return \Cartalyst\Sentry\Users\UserInterface
     * @date 14/07/2018
     * @add S1TT
     */
    public function authUser(array $account, $is_set_token = true, $length = 55) {
        return $this->sentry->findByCredentials($account, $is_set_token, $length);
    }



    /**
     * Finds a user by the given token api code.
     *
     * @param  string  $token_api
     * @return \Cartalyst\Sentry\Users\UserInterface
     * @throws \RuntimeException
     * @throws \Cartalyst\Sentry\Users\UserNotFoundException
     * @date 14/07/2018
     * @location S1TT
     */
    public function findUserByTokenApiCode($token_api)
    {
        return $this->sentry->findUserByTokenApiCode($token_api);
    }

    public function removeTokenByUser($user) {
        return $this->sentry->removeTokenByUser($user);
    }
}
