<?php  namespace Foostart\Acl\Authentication\Repository;

/**
 * Class UserRepositorySearchFilter
 *
 * @author Foostart foostart.com@gmail.com
 */
use App;
use DB;
use Illuminate\Pagination\Paginator;

class UserRepositorySearchFilter
{
    public static $multiple_ordering_separator = ",";

    private $per_page;
    private $user_table_name = "users";
    private $user_groups_table_name = "users_groups";
    private $groups_table_name = "groups";
    private $profile_table_name = "user_profile";
    private $valid_ordering_fields = ["first_name", "last_name", "email", "last_login", "activated", "name", 'id'];

    //Check filter name is valid
    private $valid_fields_filter = ['email', 'full_name', 'first_name', 'last_name', 'sex', 'category_id', 'code', 'activated', 'banned', 'group_id', 'order_by', 'ordering', 'user_leader', 'id'];

    protected $user_leader;
    public function __construct($per_page = 5, $user_leader = null)
    {
        $this->per_page = $per_page;
        $this->user_leader = $user_leader;
    }

    /**
     * @param array $input_filter
     * @return mixed|void
     */
    public function all(array $input_filter = [])
    {
        $q = $this->createTableJoins();

        $q = $this->applySearchFilters($input_filter, $q);

        $q = $this->applyOrderingFilter($input_filter, $q);

        $q = $this->createAllSelect($q);


        return $q->paginate($this->per_page);
    }

    /**
     * @return mixed
     */
    private function createTableJoins()
    {
        $q = DB::connection();
        $q = $q->table($this->user_table_name)
               ->leftJoin($this->profile_table_name, $this->user_table_name . '.id', '=', $this->profile_table_name . '.user_id')
               ->leftJoin($this->user_groups_table_name, $this->user_table_name . '.id', '=', $this->user_groups_table_name . '.user_id')
               ->leftJoin($this->groups_table_name, $this->user_groups_table_name . '.group_id', '=', $this->groups_table_name . '.id');

        return $q;
    }

    /**
     * @param array $input_filter
     * @param       $q
     * @param       $user_table
     * @param       $profile_table
     * @pram        $group_table
     * @return mixed
     */
    private function applySearchFilters(array $input_filter = null, $q)
    {
        if($this->isSettedInputFilter($input_filter))
        {
            foreach($input_filter as $column => $value)
            {
                if($this->isValidFilterValue($value))
                {
                    $column = $column.'';
                    switch($column)
                    {
                        case 'activated':
                            if (!empty($value)) {
                                $q = $q->where($this->user_table_name . '.activated', '=', $value);
                            }
                            break;
                        case 'banned':
                            if (!empty($value)) {
                                $q = $q->where($this->user_table_name . '.banned', '=', $value);
                            }
                            break;
                        case 'email':
                            if (!empty($value)) {
                               $q = $q->where($this->user_table_name . '.email', 'LIKE', "%{$value}%");
                            }
                            break;
                        case 'first_name':
                            if (!empty($value)) {
                                $q = $q->where($this->profile_table_name . '.first_name', 'LIKE', "%{$value}%");
                            }
                            break;
                        case 'last_name':
                            if (!empty($value)) {
                                $q = $q->where($this->profile_table_name . '.last_name', 'LIKE', "%{$value}%");
                            }
                            break;
                        case 'sex':
                            if (!is_null($value)) {
                                $q = $q->where($this->profile_table_name . '.sex', '=', $value);
                            }
                            break;
                        case 'category_id':
                            if (!is_null($value)) {
                                $q = $q->where($this->profile_table_name . '.category_id', '=', $value);
                            }
                            break;
                        case 'code':
                            if (!empty($value)) {
                                $q = $q->where($this->profile_table_name . '.code', '=', $value);
                            }
                            break;
                        case 'group_id':
                            if (!empty($value)) {
                                $q = $q->where($this->groups_table_name . '.id', '=', $value);
                            }
                            break;
                        case 'full_name':
                            if (!empty($value)) {
                                $q = $q->where(function($q) use ($value) {
                                    $q->where($this->profile_table_name . '.first_name', 'LIKE', "%{$value}%")
                                    ->orWhere($this->profile_table_name . '.last_name','LIKE', "%{$value}%");
                                });
                            }
                            break;
                        default:
                            break;
                    }
                }
            }//end for
        }

        if ($this->user_leader) {
            if ($this->user_leader->category_id_childs) {
                $q = $q->whereIn($this->profile_table_name . '.category_id', $this->user_leader->category_id_childs);
            }
        }
        return $q;
    }

    /**
     * Prevent attacher for changing column name
     * @param array $input_filter
     * @return array list of valid filter
     */
    private function isSettedInputFilter(array &$input_filter)
    {
        $valid_fields = array();
        foreach ($input_filter as $field => $value) {
            if (in_array($field, $this->valid_fields_filter)) {
                $valid_fields[$field] = $value;
            }
        }
        $input_filter = $valid_fields;

        return $valid_fields;
    }

    /**
     * @param $value
     * @return bool
     */
    private function isValidFilterValue($value)
    {
        return $value !== '';
    }

    /**
     * @param array $input_filter
     * @param       $q
     * @return mixed
     */
    private function applyOrderingFilter(array $input_filter, $q)
    {
        if($this->isNotGivenAnOrderingFilter($input_filter)) return $q;

        foreach($this->makeOrderingFilterArray($input_filter) as $field => $ordering)
           if($this->isValidOrderingField($field)) $q = $this->orderByField($field, $this->guessOrderingType($ordering), $q);

        return $q;
    }

    private function orderByField($field, $ordering, $q)
    {
        return $q->orderBy($field, $ordering);
    }

    /**
     * @param array $input_filter
     * @return bool
     */
    private function isNotGivenAnOrderingFilter(array $input_filter)
    {
        return empty($input_filter['order_by'])||empty($input_filter['ordering']);
    }

    /**
     * @param array $input_filter
     * @return array
     */
    private function makeOrderingFilterArray(array $input_filter)
    {
        $order_by = explode(static::$multiple_ordering_separator, $input_filter["order_by"]);
        $ordering = explode(static::$multiple_ordering_separator, $input_filter["ordering"]);

        return array_combine($order_by, $ordering);
    }

    /**
     * @param $filter
     * @return bool
     */
    public function isValidOrderingField($ordering_field)
    {
        return in_array($ordering_field, $this->valid_ordering_fields);
    }

    /**
     * @param array $input_filter
     * @return string
     */
    private function guessOrderingType($ordering)
    {
        return ($ordering == 'desc') ? 'DESC' : 'ASC';
    }

    /**
     * @param $q
     * @return mixed
     */
    private function createAllSelect($q)
    {
        $q = $q->select(
               $this->user_table_name . '.*',
               $this->profile_table_name . '.first_name',
               $this->profile_table_name . '.last_name',
               $this->profile_table_name . '.code',
               $this->groups_table_name . '.name'
        );

        return $q;
    }

    /**
     * @param int $per_page
     */
    public function setPerPage($per_page)
    {
        $this->per_page = $per_page;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->per_page;
    }
}