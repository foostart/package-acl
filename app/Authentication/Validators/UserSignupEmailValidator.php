<?php  namespace Foostart\Acl\Authentication\Validators;
/**
 * Class UserSignupEmailValidator
 *
 * @author Foostart foostart.com@gmail.com
 */
use Illuminate\Support\Facades\Request;
use Foostart\Acl\Authentication\Exceptions\UserNotFoundException;
use Foostart\Acl\Library\Validators\AbstractValidator;
use App, Session, Config;

class UserSignupEmailValidator extends AbstractValidator
{
    public function validateEmailUnique($attribute, $value, $parameters)
    {
        $repository = App::make('user_repository');
        try
        {
            $user = $repository->findByLogin($value);
        }
        catch(UserNotFoundException $e)
        {
            return true;
        }


        if($user->activated)
        {
            return false;
        }

        // if email confirmation is disabled we dont send email again
        if(! Config::get('acl_base.email_confirmation') ) return false;

        // send email

        $this->resendConfirmationEmail();
        // set session message
        Session::flash('message', "We sent you again the mail confirmation. Please check your inbox.");
        return false;
    }

    public function validateEmailRecover($attribute, $value, $parameters)
    {
        $repository = App::make('user_repository');
        try
        {
            $user = $repository->findByLogin($value);
        }
        catch(UserNotFoundException $e)
        {
            return false;
        }

        return true;
    }



    /**
     */
    protected function resendConfirmationEmail()
    {
        $data = Request::all();
        $data['password'] = 'Cannot decipher password, please use password recovery after if it\'s needed.';

        App::make('register_service')->sendRegistrationMailToClient($data);
    }
}