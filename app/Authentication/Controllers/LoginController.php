<?php namespace Foostart\Acl\Authentication\Controllers;

use Socialite;
use Illuminate\Http\Request;

use App, Redirect;

class LoginController extends Controller
{
    public $google = [
        'name',
        'email',
        'avatar',
    ];

    /**
     * Redirect the user to the Google authentication page
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();

        $data = $this->getData('google', $user);

        return $this->registerBySocial($data);
    }

    public function getData($vendor, $info) {
        $data = [];
        foreach ($this->$vendor as $item) {

            $data[$item] = $info->$item;
        }
        //generate password
        
        return $data;
    }

    public function registerBySocial($data){
        $register_service = App::make('register_service');

        try {

            $user = $register_service->saveRegisterBySocial($data);

        } catch(JacopoExceptionsInterface $e) {

            return Redirect::route('user.signup')->withErrors($service->getErrors())->withInput();

        }
        return Redirect::route("home");
    }
}