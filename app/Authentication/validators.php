<?php
// mail validator
Validator::extend('mail_signup', 'LaravelAcl\Authentication\Validators\UserSignupEmailValidator@validateEmailUnique');
// captcha validator
use LaravelAcl\Authentication\Classes\Captcha\GregWarCaptchaValidator;
$captcha_validator = App::make('captcha_validator');
Validator::extend('captcha', 'LaravelAcl\Authentication\Classes\Captcha\GregWarCaptchaValidator@validateCaptcha', $captcha_validator->getErrorMessage() );