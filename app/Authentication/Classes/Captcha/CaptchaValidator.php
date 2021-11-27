<?php namespace Foostart\Acl\Authentication\Classes\Captcha;
/**
 * Class CaptchaValidator
 *
 * @author Foostart foostart.com@gmail.com
 */
abstract class CaptchaValidator implements CaptchaValidatorInterface
{
    protected $error_message = "The captcha is not valid, please try again.";

    public function validateCaptcha($attribute, $value)
    {
        return $value == $this->getValue();
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->error_message;
    }

    abstract public function getValue();

    abstract public function getImageSrcTag();
}
