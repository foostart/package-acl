<?php
// mail validator
Validator::extend('mail_signup', 'Foostart\Acl\Authentication\Validators\UserSignupEmailValidator@validateEmailUnique');
Validator::extend('mail_recover', 'Foostart\Acl\Authentication\Validators\UserSignupEmailValidator@validateEmailRecover');

// captcha validator
use Foostart\Acl\Authentication\Classes\Captcha\GregWarCaptchaValidator;
$captcha_validator = App::make('captcha_validator');
Validator::extend('captcha', 'Foostart\Acl\Authentication\Classes\Captcha\GregWarCaptchaValidator@validateCaptcha', $captcha_validator->getErrorMessage() );