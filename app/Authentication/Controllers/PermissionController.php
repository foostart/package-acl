<?php namespace Foostart\Acl\Authentication\Controllers;
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

    }

    public function getList(Request $request)
    {
        $objs = $this->r->all($request->all());

        // display view
        $this->data_view = array_merge($this->data_view, array(
            "permissions" => $objs,
            "request" => $request,
        ));
        return View::make('package-acl::admin.permission.list')->with($this->data_view);
    }

    public function editPermission(Request $request)
    {
        /**
         * Breadcrumb
         */
        $this->breadcrumb_3['label'] = 'Edit';

        try {
            $obj = $this->r->find($request->get('id'));
        } catch (JacopoExceptionsInterface $e) {
            $obj = new Permission;
        }

        // display view
        $this->data_view = array_merge($this->data_view, array(
            "permission" => $obj,
            'request' => $request
        ));
        return View::make('package-acl::admin.permission.edit')->with($this->data_view);
    }

    public function postEditPermission(Request $request)
    {
        $id = $request->get('id');

        try {
            $obj = $this->f->process($request->all());
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            // passing the id incase fails editing an already existing item
            return Redirect::route("permissions.edit", $id ? ["id" => $id] : [])->withInput()->withErrors($errors);
        }

        return Redirect::route("permissions.edit", ["id" => $obj->id])->withMessage(Config::get('acl_messages.flash.success.permission_permission_edit_success'));
    }

    /**
     * Delete permission
     * @param Request $request
     * @return mixed
     */
    public function deletePermission(Request $request)
    {
        try {
            $this->f->delete($request->all());

        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route('permissions.list')->withErrors($errors);
        }
        return Redirect::route('permissions.list')->withMessage(Config::get('acl_messages.flash.success.permission_permission_delete_success'));
    }
}
