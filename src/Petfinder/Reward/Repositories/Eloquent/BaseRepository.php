<?php

namespace Petfinder\Reward\Repositories\Eloquent;


use Closure;
use Exception;
use User;
use Crypt;
use Petfinder\Reward\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;

/**
 * Class BaseRepository
 *
 * @package Petfinder\Reward\Repositories\Eloquent
 */

abstract class BaseRepository implements BaseRepositoryInterface
{

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $fieldSearchable = array();

    /**
     * @var \Closure
     */
    protected $userFilter = false;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
        $this->boot();
    }

    /**
     *
     */
    public function boot()
    {

    }

    /**
     * @throws RepositoryException
     */
    public function resetModel()
    {
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Query Scope
     *
     * @param \Closure $scope
     * @return $this
     */
    public function scopeQuery(\Closure $scope){
        $this->scopeQuery = $scope;
        return $this;
    }

    /**
     * Retrieve all data of modal
     *
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {

        if ($this->userFilter) {
            $userId  = User::users('id');

            $results = $this->model->whereUserId($userId)->get($columns);
        } else {
            $results = $this->model->all($columns);
        }


        $this->resetModel();

        return $results;
    }

    /**
     * Retrieve all data of modal
     *
     * @param array $columns
     * @return mixed
     */
    public function json($columns = array('*'))
    {

        if ($this->userFilter) {
            $userId  = User::users('id');

            $results = $this->model->whereUserId($userId)->all($columns)->toArray();
        } else {
            $results = $this->model->all($columns)->toArray();
        }

        $this->resetModel();

        return $results;
    }

    /**
     * Retrieve all data of modal, paginated
     * @param null $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = null, $columns = array('*'))
    {
        $limit = is_null($limit) ? config('modal.pagination.limit', 15) : $limit;

        if ($this->userFilter) {
            $userId  = User::users('id');

            $results = $this->model->whereUserId($userId)->paginate($limit, $columns);
        } else {
            $results = $this->model->paginate($limit, $columns);
        }

        $this->resetModel();

        return $results;
    }

    /**
     * Retrieve data of modal, as key value
     * @param null $limit
     * @param array $columns
     * @return mixed
     */
    public function lists($val, $key = null)
    {
        $results = $this->model->lists($val, $key);
        $this->resetModel();
        return $results;
    }

    /**
     * Find data by id
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $id     = $this->decrypt($id);

        $model  = $this->model->find($id, $columns);
        $this->resetModel();
        return $model;
    }

    /**
     * Find data by id and return new instance if not found.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findOrNew($id, $columns = array('*'))
    {
        $model = $this->model->findOrNew($id, $columns);
        $this->resetModel();
        return $model;
    }

    /**
     * Find data by slug field
     *
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBySlug($slug, $columns = array('*'))
    {
        $model = $this->model->whereSlug($slug)->first($columns);
        $this->resetModel();
        return $model;
    }

    /**
     * Find data by field and value
     *
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findByField($field, $value = null, $columns = array('*'))
    {
        $model = $this->model->where($field,'=',$value)->get($columns);
        $this->resetModel();
        return $model;
    }

    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findWhere( array $where , $columns = array('*'))
    {

        foreach ($where as $field => $value) {
            if ( is_array($value) ) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field,$condition,$val);
            } else {
                $this->model = $this->model->where($field,'=',$value);
            }
        }

        $model = $this->model->get($columns);
        $this->resetModel();

        return $model;
    }

    /**
     * Find data by multiple values in one field
     *
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     */
    public function findWhereIn( $field, array $values, $columns = array('*'))
    {
        $model = $this->model->whereIn($field, $values)->get($columns);
        $this->resetModel();
        return $model;
    }

    /**
     * Find data by excluding multiple values in one field
     *
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     */
    public function findWhereNotIn( $field, array $values, $columns = array('*'))
    {
        $model = $this->model->whereNotIn($field, $values)->get($columns);
        $this->resetModel();
        return $model;
    }

    /**
     * Save a new entity in modal
     *
     * @throws ValidatorException
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {

        $model = $this->model->newInstance();
        $attributes['user_id']  = User::users('id');
        $model->fill($attributes);
        $model->save();
        $this->resetModel();

        return $model;
    }

    /**
     * Update a entity in modal by id
     *
     * @throws ValidatorException
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $id     = $this->decrypt($id);
        $model  = $this->model->findOrFail($id);
        $model->fill($attributes);
        $model->save();

        $this->resetModel();

        return $model;
    }

    /**
     * Delete a entity in modal by id
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $id     = $this->decrypt($id);
        return $this->model->destroy($id);

        $this->resetModel();

        return $model->delete();
    }

    /**
     * Sets the order of the next query.
     *
     * @param string $column
     * @param string $order
     *
     * @return void
     */
    public function orderBy($column, $order = 'ASC')
    {
        $this->model = $this->model -> orderBy($column, $order);
        return $this;
    }

    /**
     * Add where condition for next query.
     *
     * @param string $column
     * @param string $operator
     * @param string $value
     *
     * @return void
     */
    public function where($column, $operator, $value)
    {

        $this->model = $this->model -> where($column, $operator, $value);
        return $this;
    }

    /**
     * Add orWhere condition for next query.
     *
     * @param string $column
     * @param string $operator
     * @param string $value
     *
     * @return void
     */
    public function orWhere($column, $operator, $value)
    {

        $this->model = $this->model -> orWhere($column, $operator, $value);
        return $this;
    }

    /**
     * Add whereBetween condition for next query.
     *
     * @param string $column
     * @param array $value
     *
     * @return void
     */
    public function whereBetween($column, array $value)
    {

        $this->model = $this->model -> whereBetween($column, $value);
        return $this;
    }

    /**
     * Add whereNotBetween condition for next query.
     *
     * @param string $column
     * @param array $value
     *
     * @return void
     */
    public function whereNotBetween($column, array $value)
    {

        $this->model = $this->model -> whereNotBetween($column, $value);
        return $this;
    }

    /**
     * Add whereIn condition for next query.
     *
     * @param string $column
     * @param array $value
     *
     * @return void
     */
    public function whereIn($column, array $value)
    {

        $this->model = $this->model -> whereIn($column, $value);
        return $this;
    }

    /**
     * Add whereNotIn condition for next query.
     *
     * @param string $column
     * @param array $value
     *
     * @return void
     */
    public function whereNotIn($column, array $value)
    {

        $this->model = $this->model -> whereNotIn($column, $value);
        return $this;
    }

    /**
     * Add whereNull condition for next query.
     *
     * @param string $column
     *
     * @return void
     */
    public function whereNull($column)
    {

        $this->model = $this->model -> whereNull($column);
        return $this;
    }

    /**
     * Add whereNotNull condition for next query.
     *
     * @param string $column
     *
     * @return void
     */
    public function whereNotNull($column)
    {

        $this->model = $this->model -> whereNotNull($column);
        return $this;
    }

    /**
     * Load relations
     *
     * @param array|string $relations
     * @return $this
     */
    public function with($relations)
    {
        $this->model = $this->model->with($relations);
        return $this;
    }

    /**
     * Set hidden fields
     *
     * @param array $fields
     * @return $this
     */
    public function hidden(array $fields)
    {
        $this->model->setHidden($fields);
        return $this;
    }

    /**
     * Set visible fields
     *
     * @param array $fields
     * @return $this
     */
    public function visible(array $fields)
    {
        $this->model->setVisible($fields);
        return $this;
    }

    /**
     * Get the decrypted value
     *
     * @param int $id
     * @return $id
     */
    private function decrypt($id)
    {
        if(is_numeric($id)) return $id;

        try {
            return  Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return $id;
        }
    }

    /**
     * Set user filter variable
     *
     * @param bool $bool
     * @return void
     */
    public function setUserFilter($bool = true)
    {
        $this -> userFilter = $bool;
    }


}
