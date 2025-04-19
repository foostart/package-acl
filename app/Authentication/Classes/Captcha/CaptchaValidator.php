<?php namespace Foostart\Acl\Authentication\Classes\Captcha;
/**
 * Class CaptchaValidator
 *
 * @author Foostart foostart.com@gmail.com
 */
abstract class CaptchaValidator implements CaptchaValidatorInterface
{
    protected $error_message;

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

    public function setErrorMessage($message = '') {
        $this->error_message =  trans('acl-admin.messages.captcha-error');
        if (!empty($message)) {
            $this->error_message = $message;
        }

    }

    abstract public function getValue();

    abstract public function getImageSrcTag();
}
