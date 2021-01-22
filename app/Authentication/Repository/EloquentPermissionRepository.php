<?php namespace Foostart\Acl\Authentication\Repository;
/**
 * Class EloquentPermissionRepository
 *
 * @author Foostart foostart.com@gmail.com
 */
use Foostart\Acl\Authentication\Exceptions\PermissionException;
use Foostart\Acl\Authentication\Models\Permission;
use Foostart\Acl\Library\Repository\EloquentBaseRepository;
use Event, App;

class EloquentPermissionRepository extends EloquentBaseRepository
{
    protected $group_repo;
    protected $user_repo;

    protected $config_reader;

    public function __construct($config_reader = null)
    {
        $this->group_repo = App::make('group_repository');
        $this->user_repo = App::make('user_repository');
        $this->config_reader = $config_reader ? $config_reader : App::make('config');

        Event::listen(['repository.deleting','repository.updating'], '\Foostart\Acl\Authentication\Repository\EloquentPermissionRepository@checkIsNotAssociatedToAnyUser');
        Event::listen(['repository.deleting','repository.updating'], '\Foostart\Acl\Authentication\Repository\EloquentPermissionRepository@checkIsNotAssociatedToAnyGroup');

        return parent::__construct(new Permission);
    }

    /**
     * @param $obj
     * @throws \Foostart\Acl\Authentication\Exceptions\PermissionException
     */
    public function checkIsNotAssociatedToAnyGroup($permission_obj)
    {
        $all_groups = $this->group_repo->all();
        $this->validateIfPermissionIsInCollection($permission_obj, $all_groups);
    }

    /**
     * @param $permission_obj
     * @throws \Foostart\Acl\Authentication\Exceptions\PermissionException
     */
    public function checkIsNotAssociatedToAnyUser($permission_obj)
    {
        $all_users = $this->user_repo->all();
        $this->validateIfPermissionIsInCollection($permission_obj, $all_users);
    }

    /**
     * @param $permission
     * @param $collection
     * @throws \Foostart\Acl\Authentication\Exceptions\PermissionException
     */
    private function validateIfPermissionIsInCollection($permission, $collection)
    {
        foreach ($collection as $collection_item)
        {
            $perm = $this->permissionsToArray($collection_item->permissions);
            if (! empty($perm) && is_array($perm) && array_key_exists($permission->permission, $perm)) throw new PermissionException;
        }
    }

    private function permissionsToArray($permissions)
    {
        if ( ! $permissions)
        {
            return array();
        }

        if (is_array($permissions))
        {
            return $permissions;
        }

        if ( ! $_permissions = json_decode($permissions, true))
        {
            throw new \InvalidArgumentException("Cannot JSON decode permissions [$permissions].");
        }

        return $_permissions;
    }

        /**
     * Obtains all models
     *
     * @override
     * @param array $search_filters
     * @return mixed
     */
    public function all(array $search_filters = [], $permission_repository_search = NULL)
    {
        /**
         * ORGINAL CODE
         */
        /*
        $q = new Permission();
        $q = $this->applySearchFilters($search_filters, $q);

        $results_per_page = $this->config_reader->get('acl_base.permissions_per_page');

        return $q->paginate($results_per_page);
         *
         */

        $per_page = $this->config_reader->get('acl_base.permissions_per_page');
        $permission_repository_search = $permission_repository_search ? $permission_repository_search : new PermissionRepositorySearchFilter($per_page);
        return $permission_repository_search->all($search_filters);
    }

    /**
     * @param array $search_filters
     * @param       $q
     * @return mixed
     */
    protected function applySearchFilters(array $search_filters, $q)
    {
        //description
        if(isset($search_filters['description']) && $search_filters['description'] !== '') {
            $q = $q->where('description', 'LIKE', "%{$search_filters['description']}%");
        }
        //category
        if(isset($search_filters['category_id']) && $search_filters['category_id'] !== '') {
            $q = $q->where('category_id', $search_filters['category_id']);
        }
        return $q;
    }
}