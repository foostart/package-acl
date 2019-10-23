<?php namespace Foostart\Acl\Authentication\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {
    use ValidatesRequests;
    
    public $breadcrumb_1 = [];
    public $breadcrumb_2 = [];
    public $breadcrumb_3 = [];
    
    public $data_view = [];
    
    public function __construct() {
        /**
         * Breadcrumb
         */
        //1
        $this->breadcrumb_1 = [
            'url' => url('/'.request()->segment(1)),
        ];
        //2
        if (request()->segment(1)) {
            $this->breadcrumb_2 = [
                'url' => $this->breadcrumb_1['url'].'/'.request()->segment(2),
            ];
        }
        //3
        if (request()->segment(2)) {
            $this->breadcrumb_3 = [
                'url' =>$this->breadcrumb_2['url'].'/'.request()->segment(3),
            ];
        }
        
    }
}