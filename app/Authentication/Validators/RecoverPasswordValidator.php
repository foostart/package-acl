<?php namespace LaravelAcl\Authentication\Validators;

use Config;
use LaravelAcl\Library\Validators\AbstractValidator;

class RecoverPasswordValidator extends AbstractValidator {

    protected static $messages = [
        "mail_recover" => "cant found email"
    ];

    protected static $rules = [
        "email" => ["required", "email", "mail_recover"]
    ];

    public function __construct() {
        $enable_captcha = Config::get('acl_base.captcha_signup');
        if ($enable_captcha) {
            $this->addCaptchaRule();
        }
    }

    /**
     * Validate captcha
     */
    protected function addCaptchaRule() {
        static::$rules["captcha_text"] = "captcha";
    }

}