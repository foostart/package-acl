<?php  namespace Foostart\Acl\Authentication\Controllers;

use View;

class DashboardController extends Controller{

    public function __construct() {
        parent::__construct();
        /**
         * Breadcrumb
         */
        $this->breadcrumb_1['label'] = 'Admin';
        $this->breadcrumb_2['label'] = 'Dashboard';
    }

    public function base()
    {
        /**
         * Breadcrumb
         */
        $this->breadcrumb_3 = NULL;
        
                
        // display view
        $this->data_view = array_merge($this->data_view, array(
            'breadcrumb_1' => $this->breadcrumb_1,
            'breadcrumb_2' => $this->breadcrumb_2,
            'breadcrumb_3' => $this->breadcrumb_3,
        ));
        return View::make('package-acl::admin.dashboard.default')->with($this->data_view);
    }
    
} 