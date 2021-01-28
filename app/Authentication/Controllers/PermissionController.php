<?php  namespace Foostart\Acl\Authentication\Controllers;
/**
 * Class PermissionController
 *
 * @author Foostart foostart.com@gmail.com
 */
use Illuminate\Http\Request;
use Foostart\Acl\Library\Form\FormModel;
use Foostart\Acl\Authentication\Models\Permission;
use Foostart\Acl\Authentication\Validators\PermissionValidator;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;
use View, Redirect, App, Config;

class PermissionController extends Controller
{
    /**
     * @var \Foostart\Acl\Authentication\Repository\PermissionGroupRepository
     */
    protected $r;
    /**
     * @var \Foostart\Acl\Authentication\Validators\PermissionValidator
     */
    protected $v;

    public function __construct(PermissionValidator $v)
    {
        parent::__construct();
        $this->r = App::make('permission_repository');
        $this->v = $v;
        $this->f = new FormModel($this->v, $this->r);
        
        /**
         * Breadcrumb
         */
        $this->breadcrumb_1['label'] = 'Admin';
        $this->breadcrumb_2['label'] = 'Permissions';
    }

    public function getList(Request $request)
    {
        /**
         * Breadcrumb
         */
        $this->breadcrumb_3 = NULL;
        
        $objs = $this->r->all($request->all());

        // display view
        $this->data_view = array_merge($this->data_view, array(
            "permissions" => $objs, 
            "request" => $request,
            'breadcrumb_1' => $this->breadcrumb_1,
            'breadcrumb_2' => $this->breadcrumb_2,
            'breadcrumb_3' => $this->breadcrumb_3,
        ));
        return View::make('package-acl::admin.permission.list')->with($this->data_view);
    }

    public function editPermission(Request $request)
    {
        /**
         * Breadcrumb
         */
        $this->breadcrumb_3['label'] = 'Edit';
        
        try
        {
            $obj = $this->r->find($request->get('id'));
        }
        catch(JacopoExceptionsInterface $e)
        {
            $obj = new Permission;
        }

        // display view
        $this->data_view = array_merge($this->data_view, array(
            "permission" => $obj,
            'breadcrumb_1' => $this->breadcrumb_1,
            'breadcrumb_2' => $this->breadcrumb_2,
            'breadcrumb_3' => $this->breadcrumb_3,
        ));
        return View::make('package-acl::admin.permission.edit')->with($this->data_view);
    }

    public function postEditPermission(Request $request)
    {
        $id = $request->get('id');

        try
        {
            $obj = $this->f->process($request->all());
        }
        catch(JacopoExceptionsInterface $e)
        {
            $errors = $this->f->getErrors();
            // passing the id incase fails editing an already existing item
            return Redirect::route("permissions.edit", $id ? ["id" => $id]: [])->withInput()->withErrors($errors);
        }

        return Redirect::route("permissions.edit",["id" => $obj->id])->withMessage(Config::get('acl_messages.flash.success.permission_permission_edit_success'));
    }

    public function deletePermission(Request $request)
    {
        try
        {
            $this->f->delete($request->all());
        }
        catch(JacopoExceptionsInterface $e)
        {
            $errors = $this->f->getErrors();
            return Redirect::route('permissions.list')->withErrors($errors);
        }
        return Redirect::route('permissions.list')->withMessage(Config::get('acl_messages.flash.success.permission_permission_delete_success'));
    }
}