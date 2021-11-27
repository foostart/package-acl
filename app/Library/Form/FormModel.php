<?php namespace Foostart\Acl\Library\Form;
/**
 * Class FormModel
 *
 * Class to save form data associated to a model
 *
 * @author Foostart foostart.com@gmail.com
 */

use Foostart\Acl\Library\Validators\ValidatorInterface;
use Foostart\Acl\Library\Exceptions\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Foostart\Acl\Library\Exceptions\NotFoundException;
use Foostart\Acl\Authentication\Exceptions\PermissionException;
use Event;
use Foostart\Acl\Library\Constants\FoostartConstant;

class FormModel implements FormInterface
{

    /**
     * Validator
     * @var \Foostart\Acl\Library\Validators\ValidatorInterface
     */
    protected $v;
    /**
     * Repository used to handle data
     * @var
     */
    protected $r;
    /**
     * Name of the model id field
     * @var string
     */
    protected $id_field_name = "id";
    protected $ids_field_name = "ids";
    /**
     * Validaton errors
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    public function __construct(ValidatorInterface $validator, $repository)
    {
        $this->v = $validator;
        $this->r = $repository;
    }

    /**
     * Process the input and calls the repository
     * @param array $input
     * @throws \Foostart\Acl\Library\Exceptions\JacopoExceptionsInterface
     */
    public function process(array $input)
    {
        if ($this->v->validate($input)) {
            Event::dispatch("form.processing", array($input));
            return $this->callRepository($input);
        } else {
            $this->errors = $this->v->getErrors();
            throw new ValidationException;
        }
    }

    /**
     * Calls create or update depending on giving or not the id
     * @param $input
     * @throws \Foostart\Acl\Library\Exceptions\NotFundException
     */
    protected function callRepository($input)
    {
        if ($this->isUpdate($input)) {
            try {
                $obj = $this->r->update($input[$this->id_field_name], $input);
            } catch (ModelNotFoundException $e) {
                $this->errors = new MessageBag(array("model" => "Element not found."));
                throw new NotFoundException();
            } catch (PermissionException $e) {
                $this->errors = new MessageBag(array("model" => "You don't have the permission to edit this item. Does the item is associated to other elements? if so delete the associations first."));
                throw new PermissionException();
            }
        } else {
            try {
                $obj = $this->r->create($input);
            } catch (NotFoundException $e) {
                $this->errors = new MessageBag(array("model" => $e->getMessage()));
                throw new NotFoundException();
            }
        }

        return $obj;
    }

    /**
     * Check if the operation is update or create
     * @param $input
     * @return booelan $update update=true create=false
     */
    protected function isUpdate($input)
    {
        return (isset($input[$this->id_field_name]) && !empty($input[$this->id_field_name]));
    }
    /**
     * Check valid token
     * @param Request $request
     * @return boolean
     */
    public function isValidRequest(array $input)
    {
        $flag = TRUE;
        $valid_token = csrf_token();

        $token = isset($input['_token']) ? $input['_token'] : null;

        if (!strcmp($valid_token, $token) == 0) {

            $flag = FALSE;

        }
        return $flag;
    }

    /**
     * Run delete on the repository
     * @param $input
     * @throws \Foostart\Acl\Library\Exceptions\NotFoundException
     * @todo test with exceptions
     */
    public function delete(array $input)
    {
        $delete_type = isset($input['del-forever']) ? 'delete-forever' : 'delete-trash';
        $id = isset($input[$this->id_field_name]) ? $input[$this->id_field_name] : null;
        $ids =isset($input[$this->ids_field_name]) ? $input[$this->ids_field_name] : [];

        $is_valid_request = $this->isValidRequest($input);

        if ($is_valid_request && (!empty($id) || !empty($ids))) {

            $ids = !empty($id) ? [$id] : $ids;

            foreach ($ids as $id) {

                if (!empty($id)) {
                    try {
                        if ($delete_type == 'delete-trash') {
                            $this->r->delete($id);
                        } else {
                            $this->r->deleteForce($id);
                        }
                    } catch (ModelNotFoundException $e) {
                        $this->errors = new MessageBag(array("model" => "Element does not exists."));
                        throw new NotFoundException();
                    } catch (PermissionException $e) {
                        $this->errors = new MessageBag(array("model" => "Cannot delete this item, please check that the item is not already associated to any other element, in that case remove the association first."));
                        throw new PermissionException();
                    }
                } else {
                    $this->errors = new MessageBag(array("model" => "Id not given"));
                    throw new NotFoundException();
                }

            }

        } else {
            $this->errors = new MessageBag(array("model" => "Id not given"));
            throw new NotFoundException();
        }
    }

    /**
     * Restore on the repository
     * @param $input
     * @throws \Foostart\Acl\Library\Exceptions\NotFoundException
     * @todo test with exceptions
     */
    public function restore(array $input)
    {
        $id = isset($input[$this->id_field_name]) ? $input[$this->id_field_name] : null;
        $ids =isset($input[$this->ids_field_name]) ? $input[$this->ids_field_name] : [];

        $is_valid_request = $this->isValidRequest($input);
        $ids = !empty($id) ? [$id] : $ids;

        if ($is_valid_request && !empty($ids)) {

            foreach ($ids as $id) {

                if (!empty($id)) {
                    try {
                        $this->r->restore($id);

                    } catch (ModelNotFoundException $e) {
                        $this->errors = new MessageBag(array("model" => "Element does not exists."));
                        throw new NotFoundException();
                    } catch (PermissionException $e) {
                        $this->errors = new MessageBag(array("model" => "Cannot restore this item, please check that the item is not already associated to any other element, in that case remove the association first."));
                        throw new PermissionException();
                    }
                } else {
                    $this->errors = new MessageBag(array("model" => "Id not given"));
                    throw new NotFoundException();
                }

            }

        } else {
            $this->errors = new MessageBag(array("model" => "Id not given"));
            throw new NotFoundException();
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param string $id_name
     */
    public function setIdName($id_name)
    {
        $this->id_field_name = $id_name;
    }

    /**
     * @return string
     */
    public function getIdName()
    {
        return $this->id_field_name;
    }
}
