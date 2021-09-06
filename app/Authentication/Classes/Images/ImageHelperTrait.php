<?php namespace Foostart\Acl\Authentication\Classes\Images;

use Image;
use Input;
use Foostart\Acl\Library\Exceptions\NotFoundException;

/**
 * Trait ImageHelperTrait
 *
 * @author Foostart foostart.com@gmail.com
 */
trait ImageHelperTrait
{

    public static function getPathFromInput($input_name)
    {
        if (Input::hasFile($input_name)) {
            return $path = Input::file($input_name)->getRealPath();
        } else {
            throw new NotFoundException('File non found.');
        }
    }

    /**
     * Fetch an image given a path
     */
    public static function getBinaryData($size, $input_name)
    {
        if (!isset($size)) {
            $size = 170;
        }
        return Image::make(static::getPathFromInput($input_name))->fit($size)->encode();
    }

}
