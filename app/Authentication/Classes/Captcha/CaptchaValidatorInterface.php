<?php
namespace Foostart\Acl\Authentication\Classes\Captcha;

/**
 * Class CaptchaValidator
 *
 * @author Foostart foostart.com@gmail.com
 */
interface CaptchaValidatorInterface
{
    public function validateCaptcha($attribute, $value);

    public function getValue();

    /**
     * @return mixed
     */
    public function getErrorMessage();

    public function getImageSrcTag();
}