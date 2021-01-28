<?php  namespace Foostart\Acl\Authentication\Controllers;
/**
 * Class GroupController
 *
 * @author Foostart foostart.com@gmail.com
 */
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Foostart\Acl\Authentication\Presenters\GroupPresenter;
use Foostart\Acl\Library\Form\FormModel;
use Foostart\Acl\Authentication\Helpers\FormHelper;
use Foostart\Acl\Authentication\Models\Group;
use Foostart\Acl\Authentication\Exceptions\UserNotFoundException;
use Foostart\Acl\Authentication\Validators\GroupValidator;
use Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface;
use View, Redirect, App, Config;

class GroupController extends Controller
{
    /**
     * @var \Foostart\Acl\Authentication\Repository\SentryGroupRepository
     */
    protected $group_repository;
    /**
     * @var \Foostart\Acl\Authentication\Validators\GroupValidator
     */
    protected $group_validator;
    /**
     * @var FormHelper
     */
    protected $form_model;

    public function __construct(GroupValidator $v, FormHelper $fh)
    {
        parent::__construct();
        $this->group_repository = App::make('group_repository');
        $this->group_validator = $v;
        $this->f = new FormModel($this->group_validator, $this->group_repository);
        $this->form_model = $fh;
        
        /**
         * Breadcrumb
         */
        $this->breadcrumb_1['label'] = 'Admin';
        $this->breadcrumb_2['label'] = 'Groups';
    }

    public function getList(Request $request)
    {
        /**
         * Breadcrumb
         */
        $this->breadcrumb_3 = NULL;
        $groups = $this->group_repository->all($request->all());
        
        // display view
        $this->data_view = array_merge($this->data_view, array(
            "groups" => $groups, 
            "request" => $request,
            'breadcrumb_1' => $this->breadcrumb_1,
            'breadcrumb_2' => $this->breadcrumb_2,
            'breadcrumb_3' => $this->breadcrumb_3,
        ));
        return View::make('package-acl::admin.group.list')->with($this->data_view);
    }

    public function editGroup(Request $request)
    {
        /**
         * Breadcrumb
         */
        $this->breadcrumb_3['label'] = 'Edit';
        try
        {
            $obj = $this->group_repository->find($request->get('id'));
        }
        catch(UserNotFoundException $e)
        {
            $obj = new Group;
        }
        $presenter = new GroupPresenter($obj);
        
        // display view
        $this->data_view = array_merge($this->data_view, array(
            "group" => $obj, 
            "presenter" => $presenter,
            'breadcrumb_1' => $this->breadcrumb_1,
            'breadcrumb_2' => $this->breadcrumb_2,
            'breadcrumb_3' => $this->breadcrumb_3,
        ));
        return View::make('package-acl::admin.group.edit')->with($this->data_view);
    }

    public function postEditGroup(Request $request)
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
            return Redirect::route("groups.edit", $id ? ["id" => $id]: [])->withInput()->withErrors($errors);
        }
        return Redirect::route('groups.edit',["id" => $obj->id])->withMessage(Config::get('acl_messages.flash.success.group_edit_success'));
    }

    public function deleteGroup(Request $request)
    {
        try
        {
            $this->f->delete($request->all());
        }
        catch(JacopoExceptionsInterface $e)
        {
            $errors = $this->f->getErrors();
            return Redirect::route('groups.list')->withErrors($errors);
        }
        return Redirect::route('groups.list')->withMessage(Config::get('acl_messages.flash.success.group_delete_success'));
    }

    public function editPermission(Request $request)
    {
        // prepare input
        $input = $request->all();
        $operation = $request->get('operation');
        $this->form_model->prepareSentryPermissionInput($input, $operation);
        $id = $request->get('id');

        try
        {
            $obj = $this->group_repository->update($id, $input);
        }
        catch(JacopoExceptionsInterface $e)
        {
            return Redirect::route("users.groups.edit")->withInput()->withErrors(new MessageBag(["permissions" => Config::get('acl_messages.flash.error.group_permission_not_found')]));
        }
        return Redirect::route('groups.edit',["id" => $obj->id])->withMessage(Config::get('acl_messages.flash.success.group_permission_edit_success'));
    }
}
