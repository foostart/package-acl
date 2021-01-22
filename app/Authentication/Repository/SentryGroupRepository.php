<?php  namespace Foostart\Acl\Authentication\Repository;
/**
 * Class GroupRepository
 *
 * @author Foostart foostart.com@gmail.com
 */
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Foostart\Acl\Library\Repository\Interfaces\BaseRepositoryInterface;
use Foostart\Acl\Authentication\Models\Group;
use Foostart\Acl\Authentication\Exceptions\UserNotFoundException as NotFoundException;
use App, Event;
use Cartalyst\Sentry\Groups\GroupNotFoundException;

class SentryGroupRepository implements BaseRepositoryInterface
{
    /**
     * Sentry instance
     * @var
     */
    protected $sentry;

    protected $config_reader;

    public function __construct($config_reader = null)
    {
        $this->sentry = App::make('sentry');
        $this->config_reader = $config_reader ? $config_reader : App::make('config');
    }

    /**
     * Create a new object
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->sentry->createGroup($data);
    }

    /**
     * Update a new object
     *
     * @param       id
     * @param array $data
     * @return mixed
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
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $obj = $this->find($id);
        Event::dispatch('repository.deleting', [$obj]);
        return $obj->delete();
    }

    /**
     * Find a model by his id
     *
     * @param $id
     * @return mixed
     * @throws \Foostart\Acl\Authentication\Exceptions\UserNotFoundException
     */
    public function find($id)
    {
        try
        {
            $group = $this->sentry->findGroupById($id);
        }
        catch(GroupNotFoundException $e)
        {
            throw new NotFoundException;
        }

        return $group;
    }

    /**
     * Obtains all models
     *
     * @override
     * @param array $search_filters
     * @return mixed
     */
    public function all(array $search_filters = [], $group_repository_search = null)
    {
        $per_page = $this->config_reader->get('acl_base.groups_per_page');
        $group_repository_search = $group_repository_search ? $group_repository_search : new GroupRepositorySearchFilter($per_page);
        return $group_repository_search->all($search_filters);

    }
}