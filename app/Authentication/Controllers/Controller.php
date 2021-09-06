<?php namespace Foostart\Acl\Authentication\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use ValidatesRequests;
    public $breadcrumbs = [];

    public $data_view = [];

    public function __construct()
    {
        // Set url to breadcrumb
        $pathInfo = request()->getPathInfo();
        $segments = explode('/', $pathInfo);

        foreach ($segments as $index => $segment) {
            if ($index === 0) {
                $this->breadcrumbs[] = [
                    'url' => url('/' )
                ];
            } else {
                $this->breadcrumbs[] = [
                    'url' => $this->breadcrumbs[$index-1]['url'] . '/' . $segment,
                    'label' => trans('acl-admin.breadcrumbs.'.$segment)
                ];
            }
        }
        unset($this->breadcrumbs[0]);


        // Set data view
        $this->data_view = array_merge($this->data_view,[
            'breadcrumbs' => $this->breadcrumbs,
            'pagination_view' => 'pagination::bootstrap-4',
            'params' => request()->all(),
        ]);
    }
}
