<?php namespace Foostart\Acl\Library\Repository;
/**
 * Class EloquentBaseRepository
 *
 * @author Foostart foostart.com@gmail.com
 */

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Foostart\Acl\Library\Exceptions\NotFoundException;
use Foostart\Acl\Library\Repository\Interfaces\BaseRepositoryInterface;
use Event;
use Illuminate\Support\Facades\Schema;

class EloquentBaseRepository implements BaseRepositoryInterface
{
    /**
     * The model: needs to be eloquent model
     * @var mixed
     */
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Create a new object
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a new object
     * @param id
     * @param array $data
     * @return mixed
     * @throws \Foostart\Acl\Library\Exceptions\NotFoundException
     */
    public function update($id, array $data)
    {
        $obj = $this->find($id);
        Event::dispatch('repository.updating', [$obj]);
        $obj->update($data);
        return $obj;
    }

    /**
     * Deletes a new object
     * @param $id
     * @return mixed
     * @throws \Foostart\Acl\Library\Exceptions\NotFoundException
     */
    public function delete($id)
    {
        $obj = $this->find($id);
        Event::dispatch('repository.deleting', [$obj]);
        return $obj->delete();
    }

    /**
     * Force deletes list of new object
     * @param $id
     * @return mixed
     * @throws \Foostart\Acl\Library\Exceptions\NotFoundException
     */
    public function deleteForce($id)
    {
        $obj = $this->find($id);
        Event::dispatch('repository.deleting', [$obj]);
        return $obj->forceDelete();
    }

    /**
     * Restore object
     * @param $id
     * @return mixed
     * @throws \Foostart\Acl\Library\Exceptions\NotFoundException
     */
    public function restore($id)
    {
        $obj = $this->find($id);
        Event::dispatch('repository.restore', [$obj]);
        return $obj->restore();
    }

    /**
     * Find a model by his id
     * @param $id
     * @return mixed
     * @throws \Foostart\Acl\Library\Exceptions\NotFoundException
     */
    public function find($id)
    {
        try {
            $model = $this->model->withTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException;
        }

        return $model;
    }

    /**
     * Obtains all models
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Truncate table
     */
    public function truncate() {
        Schema::disableForeignKeyConstraints();
        $this->model->truncate();
        Schema::enableForeignKeyConstraints();
    }
}
