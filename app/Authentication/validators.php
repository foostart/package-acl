<?php
// mail validator
Validator::extend('mail_signup', 'LaravelAcl\Authentication\Validators\UserSignupEmailValidator@validateEmailUnique');
Validator::extend('mail_recover', 'LaravelAcl\Authentication\Validators\UserSignupEmailValidator@validateEmailRecover');

// captcha validator
use LaravelAcl\Authentication\Classes\Captcha\GregWarCaptchaValidator;
$captcha_validator = App::make('captcha_validator');
Validator::extend('captcha', 'LaravelAcl\Authentication\Classes\Captcha\GregWarCaptchaValidator@validateCaptcha', $captcha_validator->getErrorMessage() );